<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MindMap extends Model
{
    use HasFactory;

    protected $fillable = ['mind_map'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
