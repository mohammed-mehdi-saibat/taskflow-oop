<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Entities\TeamMember;

interface Commentable
{
    public function addComment(string $content, TeamMember $author): void;
    public function getComments(): array;
    public function getLatestComment(): string;
}
