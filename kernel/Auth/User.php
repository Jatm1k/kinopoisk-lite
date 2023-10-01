<?php

namespace App\Kernel\Auth;

class User
{
    public function __construct(
        private int $id,
        private string $name,
        private string $email,
        private string $password,
        private int $is_admin,
        private string $created_at,
        private string $updated_at,
    ) {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function createdAt(): ?string
    {
        return $this->created_at;
    }

    public function updatedAt(): ?string
    {
        return $this->updated_at;
    }
}
