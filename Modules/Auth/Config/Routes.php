<?php
$routes->setDefaultNamespace('Modules\Auth\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');

$routes->match(['get','post'],'Auth', 'Auth::index');
$routes->match(['get','post'],'logout', 'Auth::logout');
