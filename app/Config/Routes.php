<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/', 'Home::index');
$routes->get('config_db', 'ConfigDb::index');
$routes->post('produk', 'Produk::index');
$routes->get('produk', 'Produk::index');
$routes->get('profil', 'Profil::index');
$routes->get('login', 'Login::index');
$routes->post('login', 'Login::login');
$routes->get('logout', 'Login::logout');
