<?php

namespace core\models;

use core\GorestCurlBuilder;
use OpenApi\Attributes as OA;

#[
    OA\Info(
        title: "gorest API",
        description: "Free REST API service",
        termsOfService: "https://gorest.co.in/",
        version: "2.0"
    )
]

#[OA\Server(url: "https://gorest.co.in", description: "gorest API server")]

#[OA\Components(
    securitySchemes: [
        new OA\SecurityScheme(
            securityScheme: "bearerAuth",
            type: "http",
            scheme: "bearer",
            bearerFormat: "JWT"
        )
    ],
    requestBodies: [
        new OA\RequestBody(
            request: "postUser",
            description: "body to create a new user",
            required: true,
            content: [
                new OA\JsonContent(
                    type: "string",
                    properties: [
                        new OA\Property(property: "email", type: "string", description: "Email of the user"),
                        new OA\Property(property: "name", type: "string", description: "Full name of the user"),
                        new OA\Property(property: "gender", type: "string", description: "Gender of the user", required: ["male", "female"]),
                        new OA\Property(property: "status", type: "string", description: "Status of the user", required: ["active", "inactive"])
                    ]
                )
            ]
        ),
        new OA\RequestBody(
            request: "patchUser",
            description: "body to patch a user",
            required: true,
            content: [
                new OA\JsonContent(
                    type: "string",
                    properties: [
                        new OA\Property(property: "email", type: "string", description: "Email of the user"),
                        new OA\Property(property: "name", type: "string", description: "Full name of the user"),
                        new OA\Property(property: "gender", type: "string", description: "Gender of the user", required: ["male", "female"]),
                        new OA\Property(property: "status", type: "string", description: "Status of the user", required: ["active", "inactive"])
                    ]
                )
            ]
        )
    ]
)]

class UsersApiModel implements ModelInterface
{
    private $gorestCurlBuilder;
    private int $createdUserId;

    public function __construct(GorestCurlBuilder $gorestCurlBuilder)
    {
        $this->gorestCurlBuilder = $gorestCurlBuilder;
    }

    #[OA\Get(
        path: "/public/v2/users/",
        summary: "get list of users",
        operationId: "getListOfUsers",
        security: [
            new OA\SecurityScheme(ref: "#/components/securitySchemes/bearerAuth", securityScheme: "bearerAuth")
        ],
        responses: [
            new OA\Response(response: 200, description: "OK"),
            new OA\Response(response: 400, description: "Bad request"),
            new OA\Response(response: 404, description: "Requested resource not found"),
            new OA\Response(response: 405, description: "Method not allowed"),
            new OA\Response(response: 429, description: "Too many requests"),
            new OA\Response(response: 500, description: "Internal server error")
        ]
    )]

    #[OA\Get(
        path: "/public/v2/users/{id}",
        summary: "get one user",
        operationId: "getOneUser",
        security: [
            new OA\SecurityScheme(ref: "#/components/securitySchemes/bearerAuth", securityScheme: "bearerAuth")
        ],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                description: "User ID to receive only one user",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(response: 200, description: "OK"),
            new OA\Response(response: 400, description: "Bad request"),
            new OA\Response(response: 404, description: "Requested resource not found"),
            new OA\Response(response: 405, description: "Method not allowed"),
            new OA\Response(response: 429, description: "Too many requests"),
            new OA\Response(response: 500, description: "Internal server error")
        ]
    )]

    public function get(int|string $value = NULL): array
    {
        $result = $this->gorestCurlBuilder->executeCurl(method: "GET", id: $value);
        if ($value != NULL) {
        return [json_decode($result, true)];
        }

        return json_decode($result, true);
    }

    #[OA\Post(
        path: "/public/v2/users",
        summary: "create new user",
        operationId: "createUser",
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
        requestBody: new OA\RequestBody(ref: "#/components/requestBodies/postUser"),
        security: [
            new OA\SecurityScheme(ref: "#/components/securitySchemes/bearerAuth", securityScheme: "bearerAuth")
        ]
        )]

    public function create(string $newRecordInfo = NULL): bool
    {
        $result = $this->gorestCurlBuilder->executeCurl(method: "POST", json_body: $newRecordInfo);
        if ($this->responseBad($result)) {
            return false;
        }

        $this->setCreatedUserId($result);

        return true;
    }

    #[OA\Delete(
        path: "/public/v2/users/{id}",
        summary: "delete user",
        operationId: "deleteUser",
        responses: [
            new OA\Response(response: 200, description: "OK"),
            new OA\Response(response: 204, description: "No content"),
            new OA\Response(response: 400, description: "Bad request"),
            new OA\Response(response: 401, description: "Authentication failed"),
            new OA\Response(response: 404, description: "Requested resource not found"),
            new OA\Response(response: 405, description: "Method not allowed"),
            new OA\Response(response: 422, description: "Data validation failed"),
            new OA\Response(response: 429, description: "Too many requests"),
            new OA\Response(response: 500, description: "Internal server error")
        ],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                description: "User ID to delete",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        security: [
            new OA\SecurityScheme(ref: "#/components/securitySchemes/bearerAuth", securityScheme: "bearerAuth")
        ]
    )]

    public function delete(int ...$ids): bool
    {
        foreach ($ids as $id) {
            $result = $this->gorestCurlBuilder->executeCurl(method: "DELETE", id: $id);
            if ($this->responseBad($result)) {
                return false;
            }
        }

        return true;
    }

    #[OA\Patch(
        path: "/public/v2/users/{id}",
        summary: "delete user",
        operationId: "patchUser",
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
            new OA\SecurityScheme(ref: "#/components/securitySchemes/bearerAuth", securityScheme: "bearerAuth")
        ],
        requestBody: new OA\RequestBody(ref: "#/components/requestBodies/patchUser"),
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                description: "User ID to patch",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
    )]

    public function update(array $newInfo): bool
    {
        $result = $this->gorestCurlBuilder->executeCurl(method: "PATCH", json_body: json_encode($newInfo), id: $newInfo['id']);

        if ($this->responseBad($result)) {
            return false;
        }

        return true;
    }

    private function responseBad($response): bool
    {
        $badResponses = ["400", "401", "404", "405", "422", "429", "500"];
        $responseLine = $this->getResponseFirstLine($response);
        foreach($badResponses as $badResponse) {
            if (str_contains($responseLine, $badResponse)) {
                return true;
            }
        }

        return false;
    }

    private function getResponseFirstLine(string $response): string
    {
        return substr($response, 0, strpos($response, "\n", 0));
    }

    private function setCreatedUserId(string $response): void
    {
        $response = substr($response, strpos($response, "location", 0));
        $response = substr($response, 0, strpos($response, "\n", 0));
        $slashpos = strrpos($response, "/", 0) + 1;
        $response = (int)substr($response, $slashpos);
        $this->createdUserId = $response;
    }

    public function getCreatedUserId(): int
    {
        return $this->createdUserId;
    }
}
