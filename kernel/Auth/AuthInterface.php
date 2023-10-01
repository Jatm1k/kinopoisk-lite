<?php

namespace App\Kernel\Auth;

interface AuthInterface
{
    public function attempt(string $login, string $password): bool;

    public function logout(): void;

    public function check(): bool;

    public function user(): ?User;

    public function table(): string;

    public function login(): string;

    public function password(): string;

    public function sessionField(): string;
}
