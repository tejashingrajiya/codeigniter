<?php
	
	namespace Config;
	
	// Create a new instance of our RouteCollection class.
	$routes = Services::routes();
	
	// Load the system's routing file first, so that the app and ENVIRONMENT
	// can override as needed.
	if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
		require SYSTEMPATH . 'Config/Routes.php';
	}
	
	/*
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
	$routes->get('/', 'Home::index');
	
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
	
	//user 
	$routes->get('user', 'User::index');
	$routes->get('user-add', 'User::create');
	$routes->post('user-store', 'User::store');
	$routes->get('user-edit/(:num)', 'User::edit/$1');
	$routes->post('user-update/(:num)', 'User::update/$1');
	$routes->get('user-delete/(:num)', 'User::delete/$1');
	$routes->get('ajax-datatable', 'User::ajaxDataTables');
	$routes->get('/fetch-student', 'User::ReadStudent');
	$routes->post('users/getUsers', 'User::getUsers');

	//Country 
	$routes->get('country', 'CountryController::index');
	$routes->get('country-add', 'CountryController::create');
	$routes->post('country-store', 'CountryController::store');
	$routes->get('country-edit/(:num)', 'CountryController::edit/$1');
	$routes->post('country-update/(:num)', 'CountryController::update/$1');
	$routes->get('country-delete/(:num)', 'CountryController::delete/$1');
	
	//State 
	$routes->get('state', 'StateController::index');
	$routes->get('state-add', 'StateController::create');
	$routes->post('state-store', 'StateController::store');
	$routes->get('state-edit/(:num)', 'StateController::edit/$1');
	$routes->post('state-update/(:num)', 'StateController::update/$1');
	$routes->get('state-delete/(:num)', 'StateController::delete/$1');
	
	//city 
	$routes->get('city', 'CityController::index');
	$routes->get('city-add', 'CityController::create');
	$routes->post('city-store', 'CityController::store');
	$routes->get('city-edit/(:num)', 'CityController::edit/$1');
	$routes->post('city-update/(:num)', 'CityController::update/$1');
	$routes->get('city-delete/(:num)', 'CityController::delete/$1');
	$routes->post('get-state', 'CityController::ge_state');
	$routes->post('users/getCity', 'CityController::getCity');
