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
// $routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
$routes->get('/hello', 'Hello::index');
$routes->get('/login', 'Login::index');
$routes->get('/register', 'Register::index');
$routes->post('/register/new_user', 'Register::new_user');
$routes->get('/login/logout', 'Login::logout');
$routes->post('/login/check_login', 'Login::check_login');

$routes->get('/forgot_password', 'ForgotPassword::index');
$routes->post('/forgot_password/send_token', 'ForgotPassword::send_token');
$routes->get('/forgot_password/input_token', 'ForgotPassword::input_token');
$routes->post('/forgot_password/verify_token', 'ForgotPassword::verify_token');

$routes->get('/email', 'EmailController::verify_email');

$routes->get('/course/ajax', 'Course::getAJAXResult');
$routes->match(['get','post'],'/course/ajax', 'Course::getAJAXResult');

$routes->post('/register/google_account', 'Register::google_account');

$routes->get('/verify/(:any)', 'Register::verify_email/$1');
#$routes->get('/check_otp/(:any)', 'Register::check_otp/$1');
$routes->post('/check_otp/(:any)', 'Register::check_otp/$1');

$routes->get('/user_profile', 'UserProfile::index');

$routes->get('/upload', 'Upload::index');         
$routes->post('/upload/upload', 'Upload::upload');

$routes->post('/user_profile/update', 'UserProfile::update');
$routes->post('/upload/profile_pic', 'Upload::profile_pic');

$routes->get('/course/new_course', 'Course::new_course');
$routes->post('/course/create_course', 'Course::create');

$routes->get('/course', 'Course::index');
$routes->post('/course', 'Course::index');

$routes->get('/(.*)/ajax', 'AuthController::getAJAXResult');
$routes->match(['get','post'],'/(.*)/ajax', 'AuthController::getAJAXResult');



$routes->get('/course/(:any)/(:any)', 'Course::display_course/$1/$2');
$routes->post('/course/update_thumbnail', 'Course::update_thumbnail');
$routes->post('/course/update', 'Course::update_course');
$routes->post('/course/delete', 'Course::delete_course');
$routes->post('/course/favourite', 'Course::favourite');

$routes->post('/course/comment/add', 'Course::comment_add');

$routes->get('/shopping_cart', 'ShoppingCart::index');
$routes->post('/shopping_cart/add_course', 'ShoppingCart::add_course');

$routes->post('/shopping_cart/remove_course', 'ShoppingCart::remove_course');


$routes->get('/shopping_cart/genPDF', 'ShoppingCart::genPDF');
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
