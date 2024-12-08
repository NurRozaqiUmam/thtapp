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
$routes->get('produk/index', 'Produk::index');
$routes->get('produk/excel', 'Produk::excel');
$routes->get('produk/tambahproduk', 'Produk::tambahProduk');
$routes->post('produk/store', 'Produk::store');
$routes->get('produk/editproduk/(:num)', 'Produk::editproduk/$1');
$routes->post('produk/update/(:num)', 'Produk::update/$1');
// $routes->post('produk/delete/(:num)', 'Produk::delete/$1');
$routes->get('produk/delete/(:num)', 'Produk::delete/$1');
$routes->get('profil', 'Profil::index');
$routes->get('login', 'Login::index');
$routes->post('login', 'Login::login');
$routes->get('logout', 'Login::logout');
