<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');

$routes->get('/', 'Home::index');

$routes->post('states/create', 'memberPage::create');
