<?php

namespace App\Entities;

abstract class TeamMember
{
    protected int $id;
    protected string $username;
    protected string $email;
    protected string $passwordHash;
    protected string $role;
    protected int $teamId;
    protected string $createdAt;

    public function __construct(int $id, string $username, string $email, string $password, string $role, int $teamId)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;
        $this->teamId = $teamId;
        $this->setPassword($password);
        $this->createdAt = date('Y-m-d H:i:s');
    }

    public function setPassword(string $password): void
    {
        $this->passwordHash = password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->passwordHash);
    }

    abstract public  function canCreateProject(): bool;
    abstract public  function canAssignTasks(): bool;

    public function getUSername(): string
    {

        return $this->username;
    }
    public function getRole(): string
    {
        return $this->role;
    }
    public function getTeamId(): int
    {
        return $this->teamId;
    }
    public function getId(): int
    {
        return $this->id;
    }
}
