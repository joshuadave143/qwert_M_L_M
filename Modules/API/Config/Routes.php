<?php
$routes->setDefaultNamespace('Modules\API\Controllers');

$routes->group('api', function($routes){
    $routes->resource('package', ['controller' =>'Api_package']);
    $routes->resource('product', ['controller' =>'Api_product']);
    $routes->resource('vw_activation', ['controller' =>'Api_vw_activation_codes']);
    $routes->resource('members', ['controller' =>'Api_members']);
    $routes->resource('vw_product_code', ['controller' =>'Api_product_codes']);
});