<?php

use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

$app = AppFactory::create();

$app->group('/api', function (RouteCollectorProxy $group) {
    // Get all Users
    $group->get('/users', UserController::class.':index');
    // Get one user
    $group->get('/users/{id}', UserController::class.':show');
    // Create a user
    $group->post('/users',  UserController::class.':create');
    // Update a user
    $group->put('/users/{id}', UserController::class.':update')
        ->add(new JsonBodyParserMiddleware());
    // Delete a user
    $group->delete('/users/{id}', UserController::class .':delete');
});