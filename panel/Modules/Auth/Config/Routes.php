<?php
$routes->setDefaultNamespace('Modules\Auth\Controllers');
$routes->setDefaultController('Auth');
$routes->match(['get','post'],'/', 'Auth::member_index');
$routes->match(['get','post'],'/Auth', 'Auth::member_index');
$routes->match(['get','post'],'/auth', 'Auth::member_index');
$routes->match(['get','post'],'/api_login', 'Auth::api_login');

// admin
$routes->match(['get','post'],'admin', 'Auth::index');
$routes->match(['get','post'],'admin/auth', 'Auth::index');
// login
$routes->match(['get','post'],'/member', 'Auth::member_index');
$routes->match(['get','post'],'register', 'Auth::register');
$routes->match(['get','post'],'success', 'Auth::success');


$routes->match(['get','post'],'logout', 'Auth::logout');
