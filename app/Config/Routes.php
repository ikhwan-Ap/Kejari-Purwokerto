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
$routes->get('/', 'Auth::index');
$routes->get('/admin', 'Admin::index');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'isLoggedIn']);
$routes->get('/kasus', 'Kasus::index');
$routes->get('/incraht', 'Incraht::index');
$routes->get('/buron', 'Buron::index');
$routes->get('/berita', 'Berita::index');
// Get Beranda
$routes->get('/beranda/agenda', 'Home::agenda');
$routes->get('/beranda/agenda/(:any)', 'Home::get_agenda/$1');
// Get Pengumuman
$routes->get('/beranda/pengumuman', 'Home::pengumuman');
$routes->get('/beranda/pengumuman/(:any)', 'Home::get_pengumuman/$1');
//Profil
$routes->get('/beranda/profil/(:any)', 'Home::profil/$1');
//Peraturan
$routes->get('/beranda/peraturan/(:any)', 'Home::peraturan/$1');
//Sarana
$routes->get('/beranda/sarana/(:any)', 'Home::sarana/$1');
//Arsip foto&video
$routes->get('/beranda/arsip_foto', 'Home::arsip_foto');
$routes->get('/beranda/arsip_video', 'Home::arsip_video');
//Struktur
$routes->get('/beranda/struktur', 'Home::struktur');
//Templating Companny
$routes->get('/beranda', 'Home::index');
$routes->get('/visi-misi', 'Home::visi_misi');
//Navbar Company
$routes->get('/bidang_view/(:any)', 'Home::bidang/$1');
// Bidang
$routes->get('/bidang', 'Bidang::index');
// Menu
$routes->get('/header', 'Menu::index');
$routes->get('/download', 'Menu::download');
$routes->get('/icon', 'Menu::icon');
$routes->get('/carousel', 'Menu::carousel');
$routes->get('/banner', 'Banner::index');
// $routes->get('/login', 'Home::index');
//Moduls    
$routes->get('/visi_misi', 'Visi_misi::index');
$routes->get('/agenda', 'Modul::index');
$routes->get('/profil', 'Profil::index');
$routes->get('/pengumuman', 'Pengumuman::index');
$routes->get('/peraturan', 'Peraturan::index');
$routes->get('/sarana', 'Sarana::index');
//Berita
$routes->get('/berita_tentang/(:any)', 'Home::berita_view/$1');

$routes->get('/pelayanan', 'Modul::pelayanan');
//Arsip
$routes->get('/arsip_foto', 'Arsip::index');
$routes->get('/arsip_video', 'Video::index');
$routes->get('/struktur', 'Struktur::index');

// Donwload
$routes->get('/download_file/(:any)', 'Menu::download_file/$1');
$routes->get('/download_peraturan/(:any)', 'Peraturan::download_peraturan/$1');
$routes->get('/download_pengumuman/(:any)', 'Pengumuman::download_pengumuman/$1');
$routes->get('/beranda/download_pengumuman/(:any)', 'Home::download_pengumuman/$1');
$routes->get('/beranda/download_peraturan/(:any)', 'Home::download_peraturan/$1');
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
