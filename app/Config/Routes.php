<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
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
//$routes->setAutoRoute(false); //to have only manually setted routes

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
//$routes->get('(:any)', 'Pages::view/$1');
// Equivalent to the following:


// DRAINCHANNELS
$routes->get('drain/list','DrainController::index');
$routes->get('drain/view/(:any)','DrainController::showItem/$1');
$routes->post('drain/create','DrainController::create');
$routes->put('drain/edit/(:num)','DrainController::update/$1');
$routes->delete('drain/delete/(:num)', 'DrainController::delete/$1');
$routes->get('drain/joined/(:any)', 'DrainController::joined/$1');

// TAX - YEAR
$routes->get('tax/list','TaxController::index');
$routes->get('tax/view/(:any)','TaxController::showItem/$1');
$routes->post('tax/create','TaxController::create');
//$routes->put('tax/edit/(:num)','TaxController::update/$1');
$routes->delete('tax/delete/(:num)', 'TaxController::delete/$1');
$routes->get('tax/joined/(:any)', 'TaxController::joined/$1');

// USERS
$routes->get('user/list','UserController::index');
$routes->get('user/view/(:any)','UserController::showItem/$1');
$routes->post('user/create','UserController::create');
$routes->put('user/edit/(:num)','UserController::update/$1');
$routes->delete('user/delete/(:num)', 'UserController::delete/$1');
$routes->get('user/joined/(:any)', 'UserController::joined/$1');

$routes->options('(:any)', 'UserController::options'); //one options method for all routes.


// RELATIONAL
$routes->get('relational/list','RelationalController::index');
$routes->get('relational/view/(:any)','RelationalController::showItem/$1');
$routes->post('relational/create','RelationalController::create');
//$routes->put('relational/edit/(:num)','RelationalController::update/$1');
$routes->delete('relational/delete/(:num)', 'RelationalController::delete/$1');
//$routes->get('relational/joined/(:any)', 'RelationalController::joined/$1');



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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
