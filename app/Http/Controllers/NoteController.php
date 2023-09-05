<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Http\Requests\ProjectRequest;
use App\Models\MindMap;
use App\Models\Note;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class NoteController extends Controller
{
    public function index(Project $project): Response
    {
        $project->loadMissing('notes');
        return Inertia::render('Project/ShowNotes', compact('project'));
    }

    public function store(Project $project, NoteRequest $request): RedirectResponse
    {
        $note = new Note($request->validated());
        $note->project()->associate($project);
        $note->save();

        return back()->with('success');
    }
    public function update(Project $project, Note $note, NoteRequest $request): RedirectResponse
    {
        $note->fill($request->validated());
        $note->save();

        return back()->with('success');
    }
    public function destroy(Project $project, Note $note): RedirectResponse
    {
        $note->delete();

        return back()->with('success');
    }
}
