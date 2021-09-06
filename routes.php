<?php
use App\Controllers\Backend\DashboardController;
use App\Controllers\Frontend\HomeController;
use App\Controllers\Frontend\ProductController;
use App\Controllers\Frontend\UserController;
use function App\Helper\redirect;

$router->filter( 'auth', function () {
    if ( !isset( $_SESSION['user'] ) ) {
        $_SESSION['message_error'] = 'You are not logedin';
        return redirect( 'login' );
        exit();
    }

} );

$router->controller( '/', HomeController::class );
$router->controller( '/product', ProductController::class );

$router->group( ['before' => 'auth', 'prefix' => 'dashboard'], function ( $router ) {

    $router->controller( '/', DashboardController::class );
    $router->controller( '/user', UserController::class );

} );