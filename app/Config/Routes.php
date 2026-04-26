<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('news','News::index');
$routes->get('news/(:segment)','News::show/$1');
$routes->get('tentang/sejarah', 'TentangController::sejarah');
$routes->get('tentang/visi-misi', 'TentangController::visiMisi');
$routes->get('tentang/struktur-organisasi', 'TentangController::strukturOrganisasi');
$routes->get('tentang/motto', 'TentangController::motto');
$routes->get('tentang/tentang-universitas', 'TentangController::tentangUniversitas');
$routes->get('tentang/kontak', 'KontakController::index');
$routes->get('alumni', 'AlumniController::index');
$routes->get('alumni/(:num)', 'AlumniController::detail/$1');
$routes->get('agenda', 'AgendaController::index');
$routes->get('agenda/(:segment)', 'AgendaController::detail/$1');

$routes->get('admin/login', 'Auth::login');
$routes->post('admin/login', 'Auth::loginProcess');
$routes->get('admin/logout', 'Auth::logout');

$routes->get('fakultas/(:segment)', 'FakultasController::detail/$1');
$routes->get('fakultas/(:segment)/(:segment)', 'FakultasController::detailProdi/$1/$2');

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
$routes->get('dashboard', 'Admin::dashboard');
$routes->get('berita', 'Admin::berita');
$routes->get('berita/tambah', 'Admin::beritaTambah');
$routes->post('berita/simpan', 'Admin::beritaSimpan');
$routes->get('berita/edit/(:num)', 'Admin::beritaEdit/$1');
$routes->post('berita/update/(:num)', 'Admin::beritaUpdate/$1');
$routes->get('berita/hapus/(:num)', 'Admin::beritaHapus/$1');

$routes->get('alumni', 'Admin::alumni');
$routes->get('alumni/tambah', 'Admin::alumniTambah');
$routes->post('alumni/simpan', 'Admin::alumniSimpan');
$routes->get('alumni/edit/(:num)', 'Admin::alumniEdit/$1');
$routes->post('alumni/update/(:num)', 'Admin::alumniUpdate/$1');
$routes->get('alumni/hapus/(:num)', 'Admin::alumniHapus/$1');

$routes->get('profil','Admin::profil');
$routes->post('profil/update','Admin::profilUpdate');
 
$routes->get('kontak','Admin::kontak');
$routes->post('kontak/update','Admin::kontakUpdate');

$routes->get('struktur','Admin::struktur');
$routes->get('struktur/edit/(:num)','Admin::strukturEdit/$1');
$routes->post('struktur/update/(:num)','Admin::strukturUpdate/$1');

$routes->get('agenda','Admin::agenda');
$routes->get('agenda/tambah','Admin::agendaTambah');
$routes->post('agenda/simpan','Admin::agendaSimpan');
$routes->get('agenda/edit/(:num)','Admin::agendaEdit/$1');
$routes->post('agenda/update/(:num)','Admin::agendaUpdate/$1');
$routes->get('agenda/hapus/(:num)','Admin::agendaHapus/$1');

$routes->get('fakultas','Admin::fakultas');
$routes->get('fakultas/tambah','Admin::fakultasTambah');
$routes->post('fakultas/simpan','Admin::fakultasSimpan');
$routes->get('fakultas/edit/(:num)','Admin::fakultasEdit/$1');
$routes->post('fakultas/update/(:num)','Admin::fakultasUpdate/$1');
$routes->get('fakultas/hapus/(:num)','Admin::fakultasHapus/$1');
 
$routes->get('prodi/tambah','Admin::prodiTambah');
$routes->post('prodi/simpan/','Admin::prodiSimpan');
$routes->get('prodi/edit/(:num)','Admin::prodiEdit/$1');
$routes->post('prodi/update/(:num)','Admin::prodiUpdate/$1');
$routes->get('prodi/hapus/(:num)','Admin::prodiHapus/$1');

});