<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'file_name'];

    protected $appends = ['full_source'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function fullSource(): Attribute
    {
        $value = Str::of($this->path)->startsWith('http')
            ? $this->path
            : Storage::url($this->path);

        return Attribute::get(fn () => $value);
    }

    protected static function boot()
    {
        parent::boot();
        self::deleted(function (Material $material) {
            Storage::delete($material->path);
        });
    }
}
