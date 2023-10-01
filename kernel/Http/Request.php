<?php

namespace App\Kernel\Http;

use App\Kernel\Upload\UploadedFile;
use App\Kernel\Upload\UploadedFileInterface;
use App\Kernel\Validator\ValidatorInterface;

class Request implements RequestInterface
{
    private ValidatorInterface $validator;

    public function __construct(
        public readonly array $get,
        public readonly array $post,
        public readonly array $server,
        public readonly array $files,
        public readonly array $cookies,
    ) {
    }

    public static function createFromGlobals(): static
    {
        return new static(
            $_GET,
            $_POST,
            $_SERVER,
            $_FILES,
            $_COOKIE
        );
    }

    public function uri(): string
    {
        return strtok($this->server['REQUEST_URI'], '?');
    }

    public function method(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function input(string $key, $default = null): mixed
    {
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }

    public function file(string $key): ?UploadedFileInterface
    {
        $file = $this->files[$key];
        if (! isset($file)) {
            return null;
        }

        return new UploadedFile(
            $file['name'],
            $file['type'],
            $file['tmp_name'],
            $file['error'],
            $file['size'],
        );
    }

    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    public function validate(array $rules): bool
    {
        $data = [];

        foreach ($rules as $key => $rule) {
            $data[$key] = $this->input($key) ?? $this->file($key);
        }

        return $this->validator->validate($data, $rules);
    }

    public function validated(): array
    {
        return $this->validator->validated();
    }

    public function errors(): array
    {
        return $this->validator->errors();
    }
}
