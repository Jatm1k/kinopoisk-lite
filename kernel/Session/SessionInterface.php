<?php

namespace App\Kernel\Session;

interface SessionInterface
{
    public function set(string $key, $value): void;

    public function get(string $key, $default = null): mixed;

    public function getFlash(string $key, $default = null): mixed;

    public function has($key): bool;

    public function remove($key): void;

    public function destroy(): void;
}
