<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ProjectsPageController extends Controller
{
    public function index(): Response
    {
        $user = auth()->user();
        $projects = $user->projects;
        return Inertia::render('Project/Index', compact('projects'));
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        $project = new Project($request->validated());
        $project->user_id = auth()->id();
        $project->save();

        return back()->with('success', 'Project Created with Success!');
    }

    public function update(Project $project, ProjectRequest $request): RedirectResponse
    {
        $project->fill($request->validated());
        $project->save();

        return back()->with('success', 'Project Updated with Success!');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return back()->with('success', 'Project Deleted with Success!');
    }

    public function showHome(Project $project): Response
    {
        return Inertia::render('Project/ShowHome', compact('project'));
    }

    public function showTasks(Project $project): Response
    {
        return Inertia::render('Project/ShowTasks', compact('project'));
    }

    public function showMindMap(Project $project): Response
    {
        return Inertia::render('Project/ShowMindMap', compact('project'));
    }

    public function showNotes(Project $project): Response
    {
        return Inertia::render('Project/ShowNotes', compact('project'));
    }

    public function showEvents(Project $project): Response
    {
        return Inertia::render('Project/ShowEvents', compact('project'));
    }

    public function showMaterials(Project $project): Response
    {
        return Inertia::render('Project/ShowMaterials', compact('project'));
    }
}
