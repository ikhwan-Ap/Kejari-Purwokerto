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
// Beranda/ Home
$routes->get('/', 'Home::index');
$routes->get('/kontak', 'Home::kontak');
$routes->get('/jadwal_sidang', 'Home::jadwal_sidang');
$routes->get('/pidana_khusus', 'Home::pidana_khusus');
$routes->get('/pidana_umum', 'Home::pidana_umum');
$routes->get('/perdata', 'Home::tata_usaha');
// Bidang
$routes->get('/bidang/(:any)', 'Home::bidang/$1');
// Berita 
$routes->get('/berita', 'Home::list_berita');
$routes->get('/berita/(:any)', 'Home::berita/$1');
// Profil
$routes->get('/visi_misi', 'Home::visi_misi');
$routes->get('/profil/(:any)', 'Home::profil/$1');
// Pelayanan
$routes->get('/portal', 'Home::portal');
// Informasi
$routes->get('/agenda', 'Home::agenda');
$routes->get('/agenda/(:any)', 'Home::get_agenda/$1');
$routes->get('/pengumuman', 'Home::pengumuman');
$routes->get('/pengumuman/(:any)', 'Home::get_pengumuman/$1');
$routes->get('/peraturan/(:any)', 'Home::peraturan/$1');
$routes->get('/sarana/(:any)', 'Home::sarana/$1');
$routes->get('/struktur', 'Home::struktur');
$routes->get('/arsip_foto', 'Home::arsip_foto');
$routes->get('/arsip_video', 'Home::arsip_video');
// Get Beranda
$routes->get('/download_pengumuman/(:any)', 'Home::download_pengumuman/$1');
$routes->get('/download_peraturan/(:any)', 'Home::download_peraturan/$1');
// Admin

$routes->get('/login', 'Auth::index');
$routes->get('/admin', 'Admin::index');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'isLoggedIn']);
$routes->get('/admin/kasus', 'Kasus::index');
$routes->get('/admin/incraht', 'Incraht::index');
$routes->get('/admin/dpo', 'Buron::index');
$routes->get('/admin/berita', 'Berita::index');

$routes->get('/admin/bidang', 'Bidang::index');
// Kepala Kejaksaan
$routes->get('/kepala_kejaksaan', 'Kejaksaan::index');
// Menu
$routes->get('/header', 'Menu::index');
$routes->get('/download', 'Menu::download');
$routes->get('/icon', 'Menu::icon');
$routes->get('/carousel', 'Menu::carousel');
$routes->get('/banner', 'Banner::index');
// $routes->get('/login', 'Home::index');
//Moduls    
$routes->get('/admin/visi_misi', 'Visi_misi::index');
$routes->get('/admin/agenda', 'Modul::index');
$routes->get('/admin/profil', 'Profil::index');
$routes->get('/admin/pengumuman', 'Pengumuman::index');
$routes->get('/admin/peraturan', 'Peraturan::index');
$routes->get('/admin/sarana', 'Sarana::index');
//Berita
$routes->get('/admin/pelayanan', 'Modul::pelayanan');
//Arsip
$routes->get('/admin/arsip_foto', 'Arsip::index');
$routes->get('/admin/arsip_video', 'Video::index');
$routes->get('/admin/struktur', 'Struktur::index');

// Donwload
$routes->get('/download_excel', 'Kasus::download_excel');
$routes->get('/download_file/(:any)', 'Menu::download_file/$1');
$routes->get('/admin/download_peraturan/(:any)', 'Peraturan::download_peraturan/$1');
$routes->get('/admin/download_pengumuman/(:any)', 'Pengumuman::download_pengumuman/$1');
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
