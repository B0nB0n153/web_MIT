<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');

// halaman web
$routes->get('/', 'Web::index');

// Halaman Admin
$routes->get('/Admin', 'Admin::index', ['filter' => 'auth']);
$routes->post('/Admin/process', 'Admin::process');
$routes->get('/Admin/user', 'Admin::user', ['filter' => 'auth']);
$routes->get('/Admin/post', 'Admin::post', ['filter' => 'auth']);
$routes->get('/Admin/create_user', 'Admin::create_user', ['filter' => 'auth']);
$routes->get('/Admin/create_post', 'Admin::create_post', ['filter' => 'auth']);
$routes->get('/Admin/edit_user/(:segment)', 'Admin::edit_user/$1', ['filter' => 'auth']);
$routes->get('/Admin/edit_post/(:segment)', 'Admin::edit_post/$1', ['filter' => 'auth']);
$routes->delete('/Admin/post/(:num)', 'Admin::delete/$1', ['filter' => 'auth']);
$routes->get('/Admin/post/(:any)', 'Admin::detail/$1', ['filter' => 'auth']);
$routes->get('/Admin/orang', 'Admin::orang', ['filter' => 'auth']);
$routes->get('/Admin/logout', 'Admin::logout');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
