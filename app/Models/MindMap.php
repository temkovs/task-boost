<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MindMap extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MindMap::class, 'parent_id', 'id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MindMap::class, 'parent_id', 'id');
    }
}
