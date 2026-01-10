<?php

declare(strict_types=1);

namespace App\Entities;

class BugTask extends Task
{
    public function calculateComplexity(): int
    {
        return match ($this->priority) {
            'critical' => 13,
            'high' => 8,
            'medium' => 5,
            default => 3,
        };
    }
}
