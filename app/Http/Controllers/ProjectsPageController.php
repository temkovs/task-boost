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
        return Inertia::render('Projects', compact('projects'));
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
}
