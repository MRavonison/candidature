<?php

require "vendor/autoload.php";

session_start();

$app = new \Slim\App([

    'settings' => [
        'displayErrorDetails' => true
    ]
]);

require ("app/container.php");

// routes redirection vers les pages ex: loginHome est la fonction ce trouvant dans LoginController

$app->get('/', App\Controllers\LoginController::class . ':loginHome')->setName('home');

$app->get('/deconnexion', App\Controllers\LoginController::class . ':logoutHome')->setName('deco');

$app->get('/tab', App\Controllers\TabController::class . ':tabHome')->setName('tab');

$app->get('/admin',App\Controllers\AdminController::class . ':adminHome')->setName('admin');

$app->get('/auth', App\Controllers\TabController::class . ':getauth')->setName('auth');
$app->post('/auth', App\Controllers\TabController::class . ':postauth');

$app->get('/user', App\Controllers\UserController::class . ':userHome')->setName('user');

$app->get('/userProfile', App\Controllers\UserController::class . ':userProfileView')->setName('userProfile');

$app->get('/createuser', App\Controllers\TabController::class . ':getcreateuser')->setName('createuser');
$app->post('/createuser', App\Controllers\TabController::class . ':postcreateuser');

$app->get('/createtask', App\Controllers\TabController::class . ':getcreatetask')->setName('createtask');
$app->post('/createtask', App\Controllers\TabController::class . ':postcreatetask');

$app->run();