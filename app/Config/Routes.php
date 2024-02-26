<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->view('/halkos', 'halkos');

$routes->view('/', 'halawal');

$routes->get('/login', 'Auth\Login::index');
$routes->post('/ceklogin', 'Auth\Login::ceklogin');
$routes->get('/register', 'Auth\Login::register');
$routes->post('/simpan', 'Auth\Login::simpan');
$routes->get('/logout', 'Auth\Login::logout');

$routes->get('/profile', 'Profile::index');
$routes->get('/ubahpassword', 'Profile::ubahpassword');
$routes->post('/update_password', 'Profile::update_password');
$routes->get('/editprofile', 'Profile::editprofile');
$routes->put('/profile/(:any)/update', 'Profile::update');

$routes->get('/dashboard', 'Dashboard::index');

$routes->resource('pelayanan');
$routes->resource('dokter');
$routes->resource('jadwaldokter');
$routes->resource('pasien');

// untuk antrian
$routes->get('/antrian', 'Antrian::index');
$routes->get('/antrian/new', 'Antrian::new');
$routes->get('/antrian/finish', 'Antrian::finish');
$routes->post('/antrian', 'Antrian::create');
$routes->get('/antrian/panggil/(:any)/(:any)/(:any)', 'Antrian::panggil/$1/$2/$3');
$routes->get('/antrian/lewatkan/(:any)/(:any)/(:any)', 'Antrian::lewatkan/$1/$2/$3');
$routes->post('/antrian/get_jam_pelayanan', 'Antrian::get_jam_pelayanan');
$routes->post('/antrian/get_pelayanan', 'Antrian::get_pelayanan');
$routes->post('/antrian/get_dokter', 'Antrian::get_dokter');
$routes->post('/antrian/get_layanan', 'Antrian::get_layanan');
$routes->get('/antrian/cetak/(:any)', 'Antrian::cetak/$1');
$routes->delete('/antrian/(:any)', 'Antrian::delete/$1');

// untuk antrian next
$routes->get('/antrian_next', 'AntrianNext::index');
$routes->get('/antrian_next/cancel/(:any)', 'AntrianNext::cancel/$1');

// list tunggu obat buat admin
$routes->get('/data_listtgu_obat', 'DokterDashboard::list_tgu_obat');

// untuk report
$routes->get('/report', 'Report::index');
$routes->get('/printpdf', 'Report::pdf');

// untuk level dokter
$routes->get('/dokterarea/pelayanan', 'DokterDashboard::pelayanan');
$routes->get('/dokterarea/jadwal_praktek', 'DokterDashboard::jadwal_praktek');
$routes->get('/dokterarea/antrian', 'DokterDashboard::antrian');
$routes->get('/dokterarea/status_layanan/(:any)', 'DokterDashboard::status_layanan/$1');
$routes->post('/dokterarea/diagnosa', 'DokterDashboard::diagnosa');
$routes->get('/dokterarea/pstguobat', 'DokterDashboard::pstguobat');

// untuk level pasien
$routes->get('/guest/jadwal_pelayanan', 'Guest::jadwal_pelayanan');
$routes->get('/guest/jadwal_antrian', 'Guest::jadwal_antrian');
$routes->get('/guest/daftar_antrian', 'Guest::daftar_antrian');
$routes->post('/guest/register', 'Guest::register');
$routes->get('/guest/list_antrian', 'Guest::list_antrian');
$routes->get('/guest/cetak/(:any)', 'Guest::cetak/$1');
$routes->get('/guest/list_tgu_obat', 'Guest::list_tgu_obat');

// untuk antrian next pasien
$routes->get('/guest/antrian_next', 'Guest::list_antrian_next');
$routes->get('/guest/antrian_next/cancel/(:any)', 'Guest::cancel/$1');

// untuk apoteker
$routes->get('/apoteker', 'ApotekerDashboard::index');
$routes->get('/apoteker/konfirmasi/(:any)', 'ApotekerDashboard::konfirmasi/$1');
