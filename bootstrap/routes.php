<?php

use core\controllers\AppController;
use core\controllers\UserController;

return [
    '' => [
        'controller' => AppController::class,
        'action' => 'index',
        'method' => 'GET'
    ],

    '/' => [
        'controller' => AppController::class,
        'action' => 'index',
        'method' => 'GET'
    ],

    'public' => [
        'controller' => AppController::class,
        'action' => 'index',
        'method' => 'GET'
    ],

    'user/create' => [
        'controller' => UserController::class,
        'action' => 'create',
        'method' => 'POST'
    ],

    'user/new' => [
        'controller' => UserController::class,
        'action' => 'new',
        'method' => 'GET'
    ],

    'notfound' => [
        'controller' => AppController::class,
        'action' => 'notFound',
        'method' => 'GET'
    ],

    'user' => [
        'controller' => UserController::class,
        'action' => 'showOne',
        'method' => 'GET'
    ],

    'users' => [
        'controller' => UserController::class,
        'action' => 'show',
        'method' => 'get'
    ],

    'user/edit' => [
        'controller' => UserController::class,
        'action' => 'editUser',
        'method' => 'get'
    ],

    'user/delete' => [
        'controller' => UserController::class,
        'action' => 'delete',
        'method' => 'delete'
    ],

    'user/update' => [
        'controller' => UserController::class,
        'action' => 'update',
        'method' => 'put'
    ],

    'user/id' => [
        'controller' => UserController::class,
        'action' => 'showById',
        'method' => 'get',
    ],

    'test' => [
        'controller' => AppController::class,
        'action' => 'test',
        'method' => 'get'
    ]
];
