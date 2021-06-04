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
$routes->get('/', 'Home::index');
$routes->add('login', 'Pelanggan::login');
$routes->add('register', 'Pelanggan::register');
$routes->resource('pelanggan');

$routes->add('paketkupon/showpaketkupon', 'PaketKupon::showPaketKupon');
$routes->add('paketkupon/showPaketKuponBerdasarkanJenisPaketKupon', 'PaketKupon::showPaketKuponBerdasarkanJenisPaketKupon');
$routes->resource('paketkupon');

$routes->add('kuponpelanggan/uploadbukti', 'KuponPelanggan::uploadBukti');
$routes->add('kuponpelanggan/createKuponPelanggan', 'KuponPelanggan::createKuponPelanggan');
$routes->add('kuponpelanggan/updateKuponPelanggan', 'KuponPelanggan::updateKuponPelanggan');
$routes->resource('kuponpelanggan');

$routes->add('menu/showAllMenu', 'Menu::showAllMenu');
$routes->add('menu/createMenu', 'Menu::createMenu');
$routes->add('menu/updateMenu', 'Menu::updateMenu');
$routes->add('menu/updateMenuNoFoto', 'Menu::updateMenuNoFoto');
$routes->resource('menu');

$routes->add('pesanan/updatepesanan', 'Pesanan::updatePesanan');
$routes->add('pesanan/createPesanan', 'Pesanan::createPesanan');
$routes->resource('pesanan');

$routes->add('admin/register', 'Admin::register');
$routes->add('admin/login', 'Admin::login');
$routes->resource('admin');

$routes->add('mix/showKuponPelangganBerdasarkanIdPelanggan', 'Mix::showKuponPelangganBerdasarkanIdPelanggan');
$routes->add('mix/showPesananBerdasarkanIdPelanggan', 'Mix::showPesananBerdasarkanIdPelanggan');
$routes->add('mix/createPesanan', 'Mix::createPesanan');

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
