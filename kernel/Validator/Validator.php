<?php

namespace App\Kernel\Validator;

class Validator implements ValidatorInterface
{
    private array $errors = [];

    private array $data = [];

    private array $validated = [];

    public function validated(): array
    {
        return $this->validated;
    }

    public function validate(array $data, array $rules): bool
    {
        $this->validated = [];
        $this->errors = [];
        $this->data = $data;

        foreach ($rules as $key => $rule) {
            $rules = $rule;
            foreach ($rules as $rule) {
                $rule = explode(':', $rule);

                $ruleName = $rule[0];
                $ruleValue = $rule[1] ?? null;

                $error = $this->validateRule($key, $ruleName, $ruleValue);

                if ($error) {
                    $this->errors[$key][] = $error;
                }
            }
            $this->validated[$key] = $data[$key];
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    private function validateRule(string $key, string $ruleName, string $ruleValue = null): string|false
    {
        $value = $this->data[$key];

        switch ($ruleName) {
            case 'required':
                if (! $value) {
                    return "Поле $key обязательно для заполнения!";
                }
                break;
            case 'min':
                if (strlen($value) < $ruleValue) {
                    return "В поле $key должно быть не менее $ruleValue символов";
                }
                break;
            case 'max':
                if (strlen($value) > $ruleValue) {
                    return "В поле $key должно быть не более $ruleValue символов";
                }
                break;
            case 'email':
                if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return "Поле $key должно содержать валидный email";
                }
                break;
            case 'confirmed':
                if ($this->data["{$key}_confirmation"] !== $value) {
                    return "Поле $key не подтверждено";
                }
                break;
        }

        return false;
    }
}
