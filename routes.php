<?php
use App\Controllers\Frontend\HomeController;
use App\Controllers\Frontend\UserController;

$router->controller( '/', HomeController::class );
$router->controller( '/user', UserController::class );
