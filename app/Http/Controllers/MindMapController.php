<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MindMapController extends Controller
{
    public function index(Project $project): Response
    {
        $project->loadMissing('mindMap');
        return Inertia::render('Project/ShowMindMap', compact('project'));
    }

    public function store(Project $project, Request $request): RedirectResponse
    {
        $mindMapData = $project->mindMap()->firstOrNew([]);
        $mindMapData->mind_map = $request->input('mind_map');
        if (!$mindMapData->exists) {
            $mindMapData->project()->associate($project);
        }
        $mindMapData->save();
        return back()->with('success');
    }
}
