<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->addRedirect('/', 'posts');

use App\Controllers\Home;
use App\Controllers\Posts;
use App\Controllers\Users;

$routes->match(['get', 'post'], 'posts/create', [Posts::class, 'create']);
$routes->match(['get', 'post'], 'posts/update/(:segment)', [Posts::class, 'update']);
$routes->match(['get'], 'posts/delete/(:segment)', [Posts::class, 'delete']);
$routes->get('posts/(:segment)', [Posts::class, 'view']);
$routes->get('posts', [Posts::class, 'index']);

$routes->match(['get', 'post'], 'users/login', [Users::class, 'login']);
$routes->match(['get', 'post'], 'users/register', [Users::class, 'register']);
$routes->get('users/profile', [Users::class, 'profile']);
$routes->post('users/upload_avatar', [Users::class, 'upload_avatar']);
$routes->get('users/logout', [Users::class, 'logout']);

$routes->post('comments/create', [Post::class, 'comment']);

$routes->get('phpinfo', [Home::class, 'phpinfo']);



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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
