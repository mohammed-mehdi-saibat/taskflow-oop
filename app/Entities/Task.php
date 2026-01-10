<?php

declare(strict_types=1);

namespace App\Entities;

use App\Interfaces\Assignable;
use App\Interfaces\Commentable;
use App\Interfaces\Prioritizable;

abstract class Task implements Assignable, Commentable, Prioritizable
{
    protected int $id;
    protected string $title;
    protected string $description;
    protected string $status = 'todo';
    protected ?TeamMember $assignee = null;
    protected string $priority = 'medium';
    protected array $comments = [];

    public function __construct(int $id, string $title, string $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public function assignTo(TeamMember $member): void
    {
        $this->assignee = $member;
    }

    public function getAssignee(): ?TeamMember
    {
        return $this->assignee;
    }

    public function isAssigned(): bool
    {
        return $this->assignee !== null;
    }

    public function unassign(): void
    {
        $this->assignee = null;
    }

    public function setPriority(string $priority): void
    {
        $this->priority = $priority;
    }

    public function getPriority(): string
    {
        return $this->priority;
    }

    public function isCritical(): bool
    {
        return $this->priority === 'critical';
    }

    public function addComment(string $content, TeamMember $author): void
    {
        $this->comments[] = [
            'author' => $author->getUsername(),
            'content' => $content,
            'date' => date('Y-m-d H:i:s')
        ];
    }

    public function getComments(): array
    {
        return $this->comments;
    }

    public function getLatestComment(): string
    {

        if (!empty($this->comments)) {
            return $this->comments[count($this->comments) - 1]['content'];
        }
        return 'No comments yet';
    }

    abstract public function calculateComplexity(): int;
}
