<?php

declare(strict_types=1);

namespace App\Entities;

class FeatureTask extends Task
{
    public function calculateComplexity(): int
    {
        return match ($this->priority) {
            'high', 'critical' => 8,
            'medium' => 5,
            default => 3,
        };
    }
}
