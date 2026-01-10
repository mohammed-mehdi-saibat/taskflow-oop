<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Entities\TeamMember;


interface Prioritizable
{
    public function setPriority(string $priority): void;
    public function getPriority(): string;
    public function isCritical(): bool;
}
