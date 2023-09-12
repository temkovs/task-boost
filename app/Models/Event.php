<?php

namespace App\Models;

use App\Enums\Color;
use App\Http\Requests\EventRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public static function createEvent(EventRequest $request, Project $project)
    {
        DB::transaction(function () use ($request, $project) {
            $event = new Event($request->validated());
            $event->project()->associate($project);
            $event->save();

            return $event;
        });
    }
}
