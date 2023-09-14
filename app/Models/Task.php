<?php

namespace App\Models;

use App\Enums\PriorityType;
use App\Enums\StatusType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'priority', 'due_date', 'order'];

    protected $casts = [
        'status' => StatusType::class,
        'priority' => PriorityType::class,
    ];

    protected $appends = ['is_overdue', 'two_days_left'];

    public function isOverdue(): Attribute
    {
        return Attribute::get(fn () => $this->due_date
            && Carbon::now()->greaterThan(Carbon::parse($this->due_date))
            && $this->status !== StatusType::DONE
        );
    }

    public function twoDaysLeft(): Attribute
    {
        return Attribute::get(fn () => $this->due_date
            && Carbon::now()->diffInDays(Carbon::parse($this->due_date)) <= 2
            && $this->status !== StatusType::DONE
        );
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function ($builder) {
            $builder->orderBy('order');
        });

        static::creating(function ($task) {
            $maxOrder = static::where('status', $task->status)
                ->where('project_id', $task->project->id)
                ->max('order');
            $task->order = $maxOrder !== null ? $maxOrder + 1 : 0;
        });
    }
}
