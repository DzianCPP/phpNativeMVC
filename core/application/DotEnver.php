<?php

namespace core\application;

use Dotenv\Dotenv;

class DotEnver
{
    public static function getDotEnv(): bool
    {
        if (!file_exists(DOCKER_PATH . ".env")) {
            echo "Internal server error";
            http_response_code(500);
            return false;
        }

        $dotenv = Dotenv::createImmutable(DOCKER_PATH);
        $dotenv->safeLoad();

        return true;
    }
}
