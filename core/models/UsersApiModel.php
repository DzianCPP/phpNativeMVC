<?php

namespace core\models;

use core\GorestCurlBuilder;
use OpenApi\Attributes as OA;

 #[OA\Info(
        title: "gorest API",
        description: "Free REST API service",
        version: "2.0")
]
class UsersApiModel implements ModelInterface
{
    private GorestCurlBuilder $gorestCurlBuilder;

    public function __construct()
    {
        $this->gorestCurlBuilder = new GorestCurlBuilder();
    }

    #[OA\Get(
        path: "/public/v2/users",
        summary: "get list of users",
        responses: [
            new OA\Response(response: 200, description: "OK"),
            new OA\Response(response: 400, description: "Bad request"),
            new OA\Response(response: 404, description: "Requested resource not found"),
            new OA\Response(response: 405, description: "Method not allowed"),
            new OA\Response(response: 429, description: "Too many requests"),
            new OA\Response(response: 500, description: "Internal server error")
        ],

        security: [
            new OA\SecurityScheme(
                securityScheme: "bearerAuth",
                type: "http",
                scheme: "bearer"
            )
        ]
    )]

    public function getUsers(array $columnValue = []): array
    {
        $result = $this->gorestCurlBuilder->executeCurl(method: "GET", id: $columnValue['value']);
        return json_decode($result, true);
    }

    #[OA\Post(
        path: "/public/v2/users",
        summary: "create new user",
        responses: [
            new OA\Response(response: 200, description: "OK"),
            new OA\Response(response: 201, description: "A resource was successfully created"),
            new OA\Response(response: 400, description: "Bad request"),
            new OA\Response(response: 401, description: "Authentication failed"),
            new OA\Response(response: 404, description: "Requested resource not found"),
            new OA\Response(response: 405, description: "Method not allowed"),
            new OA\Response(response: 422, description: "Data validation failed"),
            new OA\Response(response: 429, description: "Too many requests"),
            new OA\Response(response: 500, description: "Internal server error")
        ],

        security: [
            new OA\SecurityScheme(
                securityScheme: "bearerAuth",
                type: "http",
                scheme: "bearer"
            )
        ],

        parameters: [
            
        ]
    )]

    public function create(): bool
    {
        $newUserInfo = file_get_contents("php://input");

        $gorest_response = $this->gorestCurlBuilder->executeCurl(method: "POST", json_body: $newUserInfo);

        if ($gorest_response === false) {
            return false;
        }

        return true;
    }

    public function delete(array $columnValues = [], string $column = "", mixed $value = NULL): bool
    {
        $result = $this->gorestCurlBuilder->executeCurl(method: "DELETE", id: $value);

        if (!$result) {
            return false;
        }

        return true;
    }

    public function update(array $newInfo): bool
    {
        $result = $this->gorestCurlBuilder->executeCurl(method: "PATCH", json_body: json_encode($newInfo), id: $newInfo['id']);

        if ($result === false) {
            return false;
        }

        return true;
    }
}
