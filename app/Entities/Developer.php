<?php

declare(strict_types=1);

namespace App\Entities;

// use App\Entities\TeamMember;

class Developer extends TeamMember
{
    public function canCreateProject(): bool
    {
        return false;
    }
    public function canAssignTasks(): bool
    {
        return false;
    }
}
