<?php

declare(strict_types=1);

namespace UtilityCore\Controllers;

use Exception;
use UtilityCore\Interfaces\ServerResponseInterface;

class ServerResponse implements ServerResponseInterface
{
    public static function getResponse(int $code, string $message = null): void
    {
        switch ($code) {
            case 500:
                (!$message) ? self::respondServerError() : self::respondServerError($message);
                break;
            case 404:
                (!$message) ? self::respondNotFound() : self::respondNotFound($message);
                break;
            case 403:
                (!$message) ? self::respondForbidden() : self::respondForbidden($message);
                break;
            case 200:
                (!$message) ? self::respondOk() : self::respondOk($message);
                break;

            default:
                throw new Exception(
                    "The code `$code` does not have any response associated with
                    it"
                );
        }
    }

    public static function respondServerError(
        string $message = 'Internal Server Error'
    ): void {
        http_response_code(500);
        echo "<h1>$message</h1>";
        exit;
    }

    public static function respondNotFound(string $message = 'Not Found'): void
    {
        http_response_code(404);
        echo "<h1>$message</h1>";
        exit;
    }

    public static function respondForbidden(string $message = 'Forbidden'): void
    {
        http_response_code(403);
        echo "<h1>$message</h1>";
        exit;
    }

    public static function respondOk(string $message = 'OK'): void
    {
        http_response_code(200);
        echo "<h1>$message</h1>";
        exit;
    }
}
