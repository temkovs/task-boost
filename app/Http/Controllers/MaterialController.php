<?php

namespace App\Http\Controllers;

use App\Http\Requests\Material\StoreMaterialRequest;
use App\Http\Requests\Material\UpdateMaterialRequest;
use App\Http\Requests\MaterialRequest;
use App\Http\Requests\ProjectRequest;
use App\Models\Material;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class MaterialController extends Controller
{
    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Project $project): Response
    {
        $this->authorize('view', $project);

        $meta = [
            'title' => 'Images',
        ];

        $project->loadMissing('materials');
        return Inertia::render('Project/ShowMaterials', compact('project', 'meta'));
    }

    public static function calculateFilename($file, $folder, $alternative = true): array
    {
        $filename = Str::uuid().'.'.($file->getClientOriginalExtension() ? : 'jpg');

        return [
            $folder ? "{$folder}/{$filename}" : $filename,
            $alternative ? ($folder ? "{$folder}/alt_{$filename}" : $filename) : null,
        ];
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Project $project, StoreMaterialRequest $request): RedirectResponse
    {
        $this->authorize('manage', $project);

        $fileName = self::calculateFilename($request->file('file'), $project->title);

        Storage::put($fileName[0], file_get_contents($request->file('file')));

        $material = new Material([
            'path' => $fileName[0],
            'file_name' => $request->file_name,
        ]);

        $material->project()->associate($project);
        $material->save();

        return back()->with('success');
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Project $project, Material $material, UpdateMaterialRequest $request): RedirectResponse
    {
        $this->authorize('manage', $project);

        $material->fill($request->validated());
        $material->save();

        return back()->with('success');
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Project $project, Material $material): RedirectResponse
    {
        $this->authorize('manage', $project);

        $material->delete();

        return back()->with('success');
    }
}
