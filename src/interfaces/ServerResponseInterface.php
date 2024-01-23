<?php

declare(strict_types=1);

namespace UtilityCore\Interfaces;

interface ServerResponseInterface
{
    public static function getResponse(int $code, string $message = null): void;
    public static function respondServerError(
        string $message = 'Internal Server Error'
    ): void;
    public static function respondNotFound(string $message = 'Not Found'): void;
    public static function respondForbidden(
        string $message = 'Forbidden'
    ): void;
    public static function respondOk(string $message = 'OK'): void;
}
