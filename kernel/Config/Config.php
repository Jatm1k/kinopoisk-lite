<?php

namespace App\Kernel\Config;

class Config implements ConfigInterface
{
    public function get(string $key, $default = null): mixed
    {
        [$file, $key] = explode('.', $key);

        $filePath = APP_PATH."/config/$file.php";

        if (! file_exists($filePath)) {
            return $default;
        }

        $config = require $filePath;

        return $config[$key] ?? $default;
    }
}
