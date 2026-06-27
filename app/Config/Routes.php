<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AuthController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
$routes->get('/', 'AuthController::index');
$routes->match(['get', 'post'], 'auth/login', 'AuthController::login');
$routes->post('login', 'AuthController::login');

// logout (single route, selalu tersedia)
$routes->get('logout', 'AuthController::logout');
$routes->get('auth/logout', 'AuthController::logout');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
$routes->group('admin', ['filter' => 'role:admin'], static function ($routes) {
    $routes->get('/', 'Admin\Dashboard::index');
    $routes->get('jadwal/rekap', 'Admin\Jadwal::rekap');

    // Mahasiswa
    $routes->get('mahasiswa', 'Admin\Mahasiswa::index');
    $routes->get('mahasiswa/create', 'Admin\Mahasiswa::create');
    $routes->post('mahasiswa/store', 'Admin\Mahasiswa::store');
    $routes->get('mahasiswa/edit/(:segment)', 'Admin\Mahasiswa::edit/$1');
    $routes->post('mahasiswa/update/(:segment)', 'Admin\Mahasiswa::update/$1');
    $routes->get('mahasiswa/delete/(:segment)', 'Admin\Mahasiswa::delete/$1');

    // Dosen
    $routes->get('dosen', 'Admin\Dosen::index');
    $routes->get('dosen/create', 'Admin\Dosen::create');
    $routes->post('dosen/store', 'Admin\Dosen::store');
    $routes->get('dosen/edit/(:segment)', 'Admin\Dosen::edit/$1');
    $routes->post('dosen/update/(:segment)', 'Admin\Dosen::update/$1');
    $routes->get('dosen/delete/(:segment)', 'Admin\Dosen::delete/$1');

    // Mata Kuliah
    $routes->get('mata-kuliah', 'Admin\MataKuliah::index');
    $routes->get('mata-kuliah/create', 'Admin\MataKuliah::create');
    $routes->post('mata-kuliah/store', 'Admin\MataKuliah::store');
    $routes->get('mata-kuliah/edit/(:segment)', 'Admin\MataKuliah::edit/$1');
    $routes->post('mata-kuliah/update/(:segment)', 'Admin\MataKuliah::update/$1');
    $routes->get('mata-kuliah/delete/(:segment)', 'Admin\MataKuliah::delete/$1');

    // Ruangan
    $routes->get('ruangan', 'Admin\Ruangan::index');
    $routes->get('ruangan/create', 'Admin\Ruangan::create');
    $routes->post('ruangan/store', 'Admin\Ruangan::store');
    $routes->get('ruangan/edit/(:segment)', 'Admin\Ruangan::edit/$1');
    $routes->post('ruangan/update/(:segment)', 'Admin\Ruangan::update/$1');
    $routes->get('ruangan/delete/(:segment)', 'Admin\Ruangan::delete/$1');

    // Jadwal
    $routes->get('jadwal', 'Admin\Jadwal::index');
    $routes->get('jadwal/create', 'Admin\Jadwal::create');
    $routes->post('jadwal/store', 'Admin\Jadwal::store');
    $routes->get('jadwal/edit/(:segment)', 'Admin\Jadwal::edit/$1');
    $routes->post('jadwal/update/(:segment)', 'Admin\Jadwal::update/$1');
    $routes->get('jadwal/delete/(:segment)', 'Admin\Jadwal::delete/$1');

    // Optional API endpoint
    $routes->post('jadwal/check-bentrok', 'Admin\Jadwal::checkBentrok');
});

/*
|--------------------------------------------------------------------------
| MAHASISWA ROUTES
|--------------------------------------------------------------------------
*/
$routes->group('mahasiswa', ['filter' => 'role:mahasiswa'], static function($routes) {
    $routes->get('/', 'Mahasiswa\Dashboard::index');
    $routes->get('rencana-studi', 'Mahasiswa\RencanaStudi::index');
    $routes->post('rencana-studi', 'Mahasiswa\RencanaStudi::store');
    $routes->get('rencana-studi/remove/(:num)', 'Mahasiswa\RencanaStudi::remove/$1');
    $routes->get('hasil_studi', 'Mahasiswa\HasilStudi::index');
});

/*
|--------------------------------------------------------------------------
| DOSEN ROUTES
|--------------------------------------------------------------------------
*/
$routes->group('dosen', ['filter' => 'role:dosen'], static function ($routes) {
    $routes->get('/', 'Dosen\Dashboard::index');
    $routes->get('nilai', 'Dosen\Nilai::index');
    $routes->get('nilai/daftar/(:num)', 'Dosen\Nilai::daftar/$1');
    $routes->post('nilai/simpan', 'Dosen\Nilai::simpan');
});

/*
|--------------------------------------------------------------------------
| 404 CUSTOM
|--------------------------------------------------------------------------
*/
$routes->set404Override(static function () {
    echo view('errors/custom_404');
});
