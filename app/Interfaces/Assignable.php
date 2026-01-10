<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Entities\TeamMember;

interface Assignable
{
    public function assignTo(TeamMember $member): void;
    public function getAssignee(): ?TeamMember;
    public function isAssigned(): bool;
    public function unassign(): void;
}
