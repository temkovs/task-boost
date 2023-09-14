<?php

namespace App\Http\Controllers;

use App\Enums\Color;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class EventController extends Controller
{
    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, Project $project): Response
    {
        $meta = [
            'title' => 'Events',
        ];

        $mode = $request->get('mode', 'month');
        $start = $request->get('start', date('Y-m-d', strtotime('first day of this month')));
        $end = $request->get('end', date('Y-m-d', strtotime('last day of this month')));

        $events = Event::query()
            ->where('project_id', '=', $project->id)
            ->select('id', 'title', 'description', 'start_date', 'end_date', 'start_time', 'end_time', 'attendees', 'color', 'location')
            ->with('project')
            ->where('start_date', '>=', $start)
            ->where('start_date', '<=', $end)
            ->get();

        $selectedDate = $start;

        if ($mode === 'month') {
            $selectedDate = date('Y-m-d', strtotime('+1 week', strtotime($start)));
        }

        return Inertia::render('Project/ShowEvents', compact('project','events', 'selectedDate', 'mode', 'meta'));
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(EventRequest $request, Project $project): RedirectResponse
    {
        Event::createEvent($request, $project);

        return back()->with('success');
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Project $project, Event $event, EventRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($event, $request, $project) {
            $event->project()->associate($project);
            $event->update($request->validated());
        });

        return back()->with('success');
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Project $project, Event $event): RedirectResponse
    {
        $event->delete();

        return back()->with('success');
    }
}
