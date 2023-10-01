<?php

namespace App\Kernel\Auth;

use App\Kernel\Config\ConfigInterface;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Session\SessionInterface;

class Auth implements AuthInterface
{
    public function __construct(
        private DatabaseInterface $db,
        private SessionInterface $session,
        private ConfigInterface $config,
    ) {
    }

    public function attempt(string $login, string $password): bool
    {
        $user = $this->db->first($this->table(), [$this->login() => $login]);

        if (! $user) {
            return false;
        }

        if (! password_verify($password, $user[$this->password()])) {
            return false;
        }

        $this->session->set($this->sessionField(), $user['id']);

        return true;
    }

    public function logout(): void
    {
        $this->session->remove($this->sessionField());
    }

    public function check(): bool
    {
        return $this->session->has($this->sessionField());
    }

    public function user(): ?User
    {
        if (! $this->check()) {
            return null;
        }
        $user = $this->db->first($this->table(), ['id' => $this->session->get($this->sessionField())]);

        if ($user) {
            return new User(
                $user['id'],
                $user['name'],
                $user[$this->login()],
                $user[$this->password()],
                $user['is_admin'],
                $user['created_at'],
                $user['updated_at'],
            );
        }

        return null;
    }

    public function table(): string
    {
        return $this->config->get('auth.table', 'users');
    }

    public function login(): string
    {
        return $this->config->get('auth.login', 'login');
    }

    public function password(): string
    {
        return $this->config->get('auth.password', 'password');
    }

    public function sessionField(): string
    {
        return $this->config->get('auth.session_field', 'user_id');
    }
}
