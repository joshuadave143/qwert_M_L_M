<?php
$routes->setDefaultNamespace('Modules\Admin\Controllers');

$routes->match(['get','post'],'/admin/(:any)/dashboard', 'Dashboard::index', ['filter' => 'Auth']);
$routes->match(['get','post'],'/admin/(:any)/Package_Library', 'Package::index', ['filter' => 'Auth']);
$routes->match(['get','post'],'/admin/(:any)/Product_Library', 'Product::index', ['filter' => 'Auth']);
$routes->match(['get','post'],'/admin/(:any)/Activation_Codes', 'Activation_code::index', ['filter' => 'Auth']);
$routes->match(['get','post'],'/admin/(:any)/Members_add', 'Entry_member::index', ['filter' => 'Auth']);
$routes->match(['get','post'],'/admin/(:any)/Members_list', 'Entry_member::members_list', ['filter' => 'Auth']);
$routes->match(['get','post'],'/admin/(:any)/save', 'Entry_member::save');
$routes->match(['get','post'],'/admin/(:any)/Product_Codes', 'Product_code::index');
$routes->match(['get','post'],'/admin/(:any)/unilevel_library', 'Unilevel::index');
$routes->match(['get','post'],'/admin/(:any)/payout_history', 'Payout_history::index');
