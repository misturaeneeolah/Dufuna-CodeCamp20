<?php

use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

$app = AppFactory::create();

$app->group('/api', function (RouteCollectorProxy $group) {
    // Get All Users
    $group->get('/users', UserController::class.':index');
    //Get one users
    $group->get('/users/{id}', UserController::class.':show');
    // Create A user
    $group->post('/users',  UserController::class.':create');
    //Update a record
    $group->put('/users/{id}', UserController::class.':update')
        ->add(new JsonBodyParserMiddleware());
    // Delete a user
    $group->delete('/users/{id}', UserController::class .':delete');
});





