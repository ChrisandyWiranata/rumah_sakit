<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->get('create-db', function() {
//     $forge = \Config\Database::forge();
//     if ($forge->createDatabase('rumah_sakit')) {
//         echo 'Database created!';
//     }
// });

$routes->get('auth', 'Auth::index');
$routes->get('register', "Auth::register");
$routes->post('register', "Auth::registerProcess");
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::loginProcess');
$routes->post('logout', 'Auth::logout');

$routes->addRedirect('/', 'home');
$routes->get('home', 'Home::index');

$routes->get('antrian', 'Antrian::index');
$routes->get('antrian/add', 'Antrian::create');
$routes->post('antrian', 'Antrian::store');
$routes->delete('antrian/(:segment)', 'Antrian::destroy/$1');

$routes->get('pasien', 'Pasien::index');

$routes->get('admin', 'Admin::index');
$routes->post('admin/category', 'Admin::find_category');
$routes->post('admin/pasien', 'Admin::find_pasien');

$routes->get('dokter', 'Dokter::index');
$routes->get('dokter/call', 'Dokter::call');
$routes->post('rekam', 'RekamMedis::make');