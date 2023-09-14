<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    public function index(Project $project): Response
    {
        $meta = [
            'title' => 'Tasks',
        ];

        $project->loadMissing('tasks');

        return Inertia::render('Project/ShowTasks', compact('project', 'meta'));
    }

    public function store(TaskRequest $request, Project $project): RedirectResponse
    {
        $task = new Task($request->validated());
        $task->project()->associate($project);
        $task->save();

        return back()->with('success');
    }

    public function update(Project $project, Task $task, TaskRequest $request): RedirectResponse
    {
        $task->fill($request->validated());
        $task->save();

        return back()->with('success');
    }

    public function move(Request $request, Project $project, Task $task)
    {
        $oldIndex = $task->order;
        $newIndex = $request->newIndex;
        $destinationStatus = $request->destinationStatus;

        if ($destinationStatus === null) {
            $destinationStatus = $task->status;
        }

        // Retrieve the tasks in the source and destination columns
        $sourceTasks = Task::where('status', $task->status)->orderBy('order')->get();
        $destinationTasks = Task::where('status', $destinationStatus)->orderBy('order')->get();

        if ($destinationStatus == $task->status) {
            // Task moved within the same column
            $this->reorderWithinColumn(
                $sourceTasks,
                $task,
                $oldIndex,
                $newIndex
            );
        } else {
            // Task moved to a different column
            $this->moveToDifferentColumn(
                $sourceTasks,
                $task,
                $oldIndex,
                $destinationTasks,
                $newIndex,
                $destinationStatus
            );
        }

        return back()->with('success');
    }

    private function reorderWithinColumn($tasks, $taskToMove, $oldIndex, $newIndex)
    {
        // Remove the task from its old position
        $tasks->splice($oldIndex, 1);

        // Insert the task at its new position
        $tasks->splice($newIndex, 0, [$taskToMove]);

        // Update the order of tasks in the same column
        foreach ($tasks as $index => $task) {
            $task->update(['order' => $index]);
        }
    }

    private function moveToDifferentColumn($sourceTasks, $taskToMove, $oldIndex, $destinationTasks, $newIndex, $destinationStatus)
    {
        // Remove the task from the source column
        $sourceTasks->splice($oldIndex, 1);

        // Determine the correct new order for the task in the destination column
        $newOrder = $newIndex;

        // If the task is placed at the beginning, make space for it and set its order to 0
        if ($newIndex === 0) {
            // Increment the order of all tasks in the destination column
            foreach ($destinationTasks as $index => $task) {
                $task->update(['order' => $index + 1]);
            }
            $newOrder = 0; // Place the task at the beginning
        } else {
            // If the task is placed in the middle or at the end, adjust the order of tasks in the destination column
            $this->reorderDestinationColumn($destinationTasks, $newOrder, $taskToMove->id);
        }

        // Insert the task into the destination column
        $destinationTasks->splice($newOrder, 0, [$taskToMove]);

        // Update the order and status of tasks in both columns
        foreach ($sourceTasks as $index => $task) {
            $task->update(['order' => $index]);
        }

        foreach ($destinationTasks as $index => $task) {
            $task->update(['order' => $index, 'status' => $destinationStatus]);
        }
    }

    private function reorderDestinationColumn($tasks, $newOrder, $excludeTaskId = null)
    {
        // Adjust the order of tasks in the destination column
        foreach ($tasks as $index => $task) {
            if ($index >= $newOrder) {
                if ($task->id !== $excludeTaskId) {
                    $task->update(['order' => $index + 1]);
                }
            }
        }
    }

    public function destroy(Project $project, Task $task): RedirectResponse
    {
        $task->delete();

        return back()->with('success');
    }
}
