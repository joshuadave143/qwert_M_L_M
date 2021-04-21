<?php
$routes->setDefaultNamespace('Modules\Member\Controllers');

$routes->match(['get','post'],'/member/(:any)/dashboard', 'Dashboard::index', ['filter' => 'Auth']);
$routes->match(['get','post'],'/member/(:any)/Package_Library', 'Package::index', ['filter' => 'Auth']);
$routes->match(['get','post'],'/member/(:any)/Product_Library', 'Product::index', ['filter' => 'Auth']);
$routes->match(['get','post'],'/member/(:any)/Activation_Codes', 'Activation_code::index', ['filter' => 'Auth']);
$routes->match(['get','post'],'/member/(:any)/Members_add', 'Entry_member::index', ['filter' => 'Auth']);
$routes->match(['get','post'],'/member/(:any)/Members_list', 'Entry_member::members_list', ['filter' => 'Auth']);
$routes->match(['get','post'],'/member/(:any)/save', 'Entry_member::save', ['filter' => 'Auth']);
$routes->match(['get','post'],'/member/(:any)/Product_Codes', 'Product_code::index', ['filter' => 'Auth']);
$routes->match(['get','post'],'/member/(:any)/direct_referrals', 'Referrals::index', ['filter' => 'Auth']);
$routes->match(['get','post'],'/member/(:any)/indirect_referrals', 'Referrals::indirect', ['filter' => 'Auth']);
$routes->match(['get','post'],'/member/(:any)/genealogy', 'Genealogy::index', ['filter' => 'Auth']);
$routes->match(['get','post'],'/member/(:any)/unilevel', 'Unilevel::index', ['filter' => 'Auth']);
$routes->match(['get','post'],'/member/(:any)/payout_history', 'Payout_history::index', ['filter' => 'Auth']);
$routes->match(['get','post'],'/member/(:any)/account_settings', 'Account_settings::index', ['filter' => 'Auth']);
$routes->match(['get','post'],'/member/(:any)/change_password', 'Change_password::index', ['filter' => 'Auth']);
