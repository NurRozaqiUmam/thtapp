<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('config_db', 'ConfigDb::index');
$routes->get('produk', 'Produk::index');
$routes->get('profil', 'Profil::index');
