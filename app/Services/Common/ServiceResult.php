<?php

namespace App\Services\Common;

class ServiceResult
{
    public bool $isError = false;
    public array $errors = [];
    public string $message = '';
    public mixed $data = null;
    public int $status = 200;

    public static function createErrorResult(
        string $message = '',
        array  $errors = [],
        mixed  $data = null,
        int    $status = 400
    ): self
    {
        $result = new self();
        $result->isError = true;
        $result->errors = $errors;
        $result->message = $message;
        $result->data = $data;
        $result->status = $status;

        return $result;
    }

    public static function createSuccessResult($data = null, $status = 200): self
    {
        $result = new self();
        $result->isError = false;
        $result->data = $data;
        $result->status = $status;

        return $result;
    }
}
