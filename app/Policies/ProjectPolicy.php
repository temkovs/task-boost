<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    public function view(User $user, Project $project): bool
    {
        return $user->id === $project->user->id;
    }

    public function manage(User $user, Project $project): bool
    {
        return $user->id === $project->user->id;
    }
}
