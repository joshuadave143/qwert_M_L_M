<?php
$routes->setDefaultNamespace('Modules\API\Controllers');

$routes->group('api', function($routes){
    $routes->resource('package', ['controller' =>'Api_package']);
    $routes->resource('product', ['controller' =>'Api_product']);
    $routes->resource('vw_activation', ['controller' =>'Api_vw_activation_codes']);
    $routes->resource('members', ['controller' =>'Api_members']);
    $routes->resource('vw_product_code', ['controller' =>'Api_product_codes']);
    $routes->resource('indirect_ref', ['controller' =>'Api_indirect_referral']);
    $routes->resource('direct_ref', ['controller' =>'Api_direct_referral']);
    $routes->resource('nodes', ['controller' =>'Api_nodes']);
    $routes->resource('unilevel', ['controller' =>'Api_unilevel']);
    $routes->resource('vw_unilevel_details', ['controller' =>'Api_vw_unilevel_details']);
    $routes->resource('collect', ['controller' =>'Api_process_collect']);
    $routes->resource('payout', ['controller' =>'Api_payout']);
    $routes->resource('vw_ewallet_total', ['controller' =>'Api_vw_ewallet_total']);
    $routes->resource('country', ['controller' =>'Api_country']);
    $routes->resource('security', ['controller' =>'Api_security']);
});