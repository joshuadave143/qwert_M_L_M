<?php
$routes->setDefaultNamespace('Modules\Admin\Controllers');
$routes->get('admin', '\Modules\Admin\Controllers\Dashboard::index');
// $routes->resource('dashboard');

// $routes->group('api', ['filter'=> 'BasicAuthFilter'], function($routes){
// $routes->get('dashboard', '\Modules\Admin\Controllers\Dashboard::index');
$routes->post('login', '\Modules\Admin\Controllers\Dashboard::login');
// $routes->group('api', ['filter'=> 'OAuthFilter'], function($routes){
$routes->group('api', function($routes){

    $routes->resource('dashboard', ['controller' =>'Dashboard']);
});
// $routes->resource('api/dashboard', ['controller' =>'Dashboard']);