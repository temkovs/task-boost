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
    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Project $project): Response
    {
        $this->authorize('view', $project);

        $meta = [
            'title' => 'Notes',
        ];

        $project->loadMissing('notes');
        return Inertia::render('Project/ShowNotes', compact('project', 'meta'));
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Project $project, NoteRequest $request): RedirectResponse
    {
        $this->authorize('manage', $project);

        $note = new Note($request->validated());
        $note->project()->associate($project);
        $note->save();

        return back()->with('success');
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Project $project, Note $note, NoteRequest $request): RedirectResponse
    {
        $this->authorize('manage', $project);

        $note->fill($request->validated());
        $note->save();

        return back()->with('success');
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Project $project, Note $note): RedirectResponse
    {
        $this->authorize('manage', $project);

        $note->delete();

        return back()->with('success');
    }
}
