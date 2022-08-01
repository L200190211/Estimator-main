<?php

namespace Config;

use App\Controllers\PromoController;

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
$routes->get('/', 'DashboardController::index');
$routes->post('/report', 'DashboardController::report');

// produk
$routes->get('produk', 'ProdukController::index');
$routes->add('produk/create', 'ProdukController::create');
$routes->add('produk/store', 'ProdukController::store');
$routes->add('produk/edit/(:segment)', 'ProdukController::edit/$1');
$routes->add('produk/update/(:segment)', 'ProdukController::update/$1');
$routes->get('produk/delete/(:segment)', 'ProdukController::delete/$1');
$routes->add('produk/delete/img', 'ProdukController::deleteimage');

// Paket Iklan
$routes->get('produk/iklan', 'PaketIklanController::index');
$routes->add('produk/iklan/create', 'PaketIklanController::create');
$routes->add('produk/iklan/store', 'PaketIklanController::store');
$routes->add('produk/iklan/success', 'PaketIklanController::success');
$routes->add('produk/iklan/edit/(:segment)', 'PaketIklanController::edit/$1');
$routes->add('produk/iklan/update/(:segment)', 'PaketIklanController::update/$1');

// Auth
//login
$routes->get('login', 'LoginController::index');
$routes->post('login', 'LoginController::login');
$routes->get('logout', 'LoginController::logout');

// Notifikasi
$routes->get('notifikasi', 'NotifikasiController::index');
$routes->add('notifikasi/sudah-dibaca', 'NotifikasiController::sudahdibaca');

//dropzone
$routes->get("image-upload", "ProdukController::dropzone");
$routes->post("produk/dropzoneStore", "ProdukController::dropzoneStore");

//profile
$routes->get('/profile', 'ProfilController::index');
$routes->post('/profile/update/(:segment)', 'ProfilController::update/$1');
$routes->post('/profile/ganti/(:segment)', 'ProfilController::ganti/$1');
// $routes->post('/profile/gantiemail/(:segment)', 'ProfilController::gantiemail/$1');

// wilayah distribusi
$routes->get('/wilayah-distribusi', 'WilayahDistribusiController::index');
$routes->get('/wilayah-distribusi/create', 'WilayahDistribusiController::create');
$routes->add('/wilayah-distribusi/store', 'WilayahDistribusiController::store');
$routes->get('/wilayah-distribusi/delete/(:segment)', 'WilayahDistribusiController::delete/$1');

//wilayah produk
$routes->get('/wilayah-produk', 'WilayahProdukController::index');
$routes->get('/wilayah-produk/create', 'WilayahProdukController::create');
$routes->add('/wilayah-produk/store', 'WilayahProdukController::store');
$routes->get('/wilayah-produk/edit', 'WilayahProdukController::edit');
$routes->get('/wilayah-produk/update', 'WilayahProdukController::update');
$routes->get('/wilayah-produk/delete/(:segment)/(:num)', 'WilayahProdukController::delete/$1');
$routes->get('/wilayah-produk/deletes/(:segment)', 'WilayahProdukController::delete/$1');


//kategori
$routes->get('/kategori', 'KategoriController::index');

//Ulasan-produk
$routes->get('/ulasan-produk', 'UlasanController::indexProduk');
$routes->get('/ulasan-produk/search', 'UlasanController::search');
// $routes->get('/ulasan-produk/produk', 'UlasanController::getUlasanProduk');
//Ulasan-Suplier
$routes->get('/ulasan-suplier', 'UlasanController::indexSuplier');

//Transaksi
$routes->get('/transaksi', 'TransaksiController::index');
$routes->post('/transaksi/updatestatus/(:segment)', 'TransaksiController::updatestatus/$1');
$routes->post('/transaksi/konfirmasipesanan/(:segment)', 'TransaksiController::konfirmasipesanan/$1');
$routes->post('/transaksi/tolakpesanan/(:segment)', 'TransaksiController::tolakpesanan/$1');
$routes->post('/transaksi/update_pengiriman/(:segment)/(:segment)', 'TransaksiController::update_pengiriman/$1/$2');
$routes->get('/transaksi/riwayat', 'TransaksiController::riwayat');
$routes->post('/transaksi/barangready/(:segment)', 'TransaksiController::barangready/$1');

// Promo kode
$routes->get('/promo', 'PromoController::index');
$routes->get('/promo/create', 'PromoController::create');
$routes->add('/promo/store', 'PromoController::store');
$routes->get('/promo/delete/(:segment)', 'PromoController::delete/$1');
$routes->get('/promo/detail/(:segment)', 'PromoController::detail/$1');
$routes->get('/promo/edit/(:segment)', 'PromoController::edit/$1');
$routes->add('/promo/update', 'PromoController::update');
$routes->get('/promo/deleteproduk/(:segment)/(:segment)', 'PromoController::deleteProduk/$1/$2');
$routes->add('/promo/createproduk/', 'PromoController::storeProduk');

// Promo Produk
$routes->get('/promo-produk', 'DiskonProdukController::index');
$routes->get('/promo-produk/create', 'DiskonProdukController::create');
$routes->add('/promo-produk/store', 'DiskonProdukController::store');
$routes->get('/promo-produk/delete/(:segment)', 'DiskonProdukController::delete/$1');
$routes->get('/promo-produk/detail/(:segment)', 'DiskonProdukController::detail/$1');
$routes->get('/promo-produk/edit/(:segment)', 'DiskonProdukController::edit/$1');
$routes->add('/promo-produk/update', 'DiskonProdukController::update');

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
