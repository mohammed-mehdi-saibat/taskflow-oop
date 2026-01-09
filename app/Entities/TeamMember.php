<?php

namespace App\Entities;

abstract class TeamMember
{
    protected int $id;
    protected string $username;
    protected string $email;
    protected string $passwordHash;
    protected string $role = 'developer';
    protected int $teamId;
    protected string $createdAt;

    public function __construct(int $id, string $username, string $email, string $password, string $role = 'Developer', int $teamId)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
    }
}
