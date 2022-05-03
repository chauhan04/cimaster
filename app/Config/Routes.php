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
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Frontend\Home::index',['as'=>'home']);

$routes->get('aboutus','Frontend\PageController::aboutus',['as'=>'aboutus']);
$routes->get('contactus','Frontend\PageController::contactus',['as'=>'contactus']);
$routes->post('contactus','Frontend\PageController::contactemail',['as'=>'contact.send']);
$routes->post('subscribe','Frontend\PageController::subscribe',['as'=>'subscribe']);

$routes->group("", ['namespace' => 'App\Controllers\Frontend', 'filter' => 'loginFilter'],function($routes){
    $routes->get('login','LoginController::index',['as'=>'frontend.login']);
    $routes->post('login','LoginController::loginAuth',['as'=>'frontend.makelogin']);
    $routes->get('register','RegisterController::index',['as'=>'frontend.register']);
    $routes->post('register','RegisterController::register',['as'=>'frontend.makeregister']);
    $routes->get("forgotpassword", "ForgotpasswordController::forgotpassword",['as'=>'frontend.forgotpassword']);
    $routes->post("forgotpassword", "ForgotpasswordController::sendForgotLink",['as'=>'frontend.forgotpassword.link']);
    $routes->get("resetpassword/(:any)", "ForgotpasswordController::resetpasswordform/$1",['as'=>'frontend.resetpassword.form']);
    $routes->post("resetpassword", "ForgotpasswordController::resetpassword",['as'=>'frontend.resetpassword']);
});

$routes->group("user", ['namespace' => 'App\Controllers\Frontend', 'filter' => 'authGuard'],function($routes){
    $routes->get('dashboard','UserController::index',['as'=>'user.dashboard']);
    $routes->get('profile','UserController::profile',['as'=>'user.profile']);
    $routes->get("edit-profile", "UserController::editProfile",['as'=>'user.profile.edit']);
    $routes->post("profile", "UserController::saveProfile",['as'=>'user.profile.update']);
    $routes->get('changepassword','UserController::changepassword',['as'=>'user.changepassword']);
    $routes->post('changepassword','UserController::changepasswordsave',['as'=>'user.changepassword.update']);
    $routes->get('logout','UserController::logout',['as'=>'user.logout']);
});


$routes->group("", ['namespace' => 'App\Controllers\Backend', 'filter' => 'adminLoginFilter'], function($routes){
    $routes->get('admin/login','LoginController::index',['as'=>'admin.login']);
    $routes->post('admin/login','LoginController::loginAuth',['as'=>'admin.makelogin']);
    $routes->get("admin/forgotpassword", "ForgotpasswordController::forgotpassword",['as'=>'admin.forgotpassword']);
    $routes->post("admin/forgotpassword", "ForgotpasswordController::sendForgotLink",['as'=>'admin.forgotpassword.link']);
    $routes->get("admin/resetpassword/(:any)", "ForgotpasswordController::resetpasswordform/$1",['as'=>'admin.resetpassword.form']);
    $routes->post("admin/resetpassword", "ForgotpasswordController::resetpassword",['as'=>'admin.resetpassword']);
});

$routes->group("admin", ['namespace' => 'App\Controllers\Backend', 'filter' => 'adminAuthGuard'], function($routes){
    // URL - /admin
    $routes->get("/", "AdminController::dashboard");
    $routes->get('dashboard','AdminController::dashboard',['as'=>'admin.dashboard']);

    $routes->get("admins/list", "AdminController::index",['as'=>'admin.list']);
    $routes->get("admins/create", "AdminController::create",['as'=>'admin.create']);
    $routes->post("admins/create", "AdminController::store",['as'=>'admin.store']);
    $routes->get("admins/edit/(:num)", "AdminController::edit/$1",['as'=>'admin.edit']);
    $routes->post("admins/edit", "AdminController::saveEdit",['as'=>'admin.edit.save']);
    $routes->get("admins/view/(:num)", "AdminController::show/$1",['as'=>'admin.view']);
    $routes->get("admins/delete/(:num)", "AdminController::delete/$1",['as'=>'admin.delete']);    
    $routes->get("logout", "AdminController::logout",['as'=>'admin.logout']);
    $routes->get("profile", "AdminController::profile",['as'=>'admin.profile']);
    $routes->get("edit-profile", "AdminController::editProfile",['as'=>'admin.profile.edit']);
    $routes->post("profile", "AdminController::saveProfile",['as'=>'admin.profile.store']);

    $routes->get("users/list", "UserController::index",['as'=>'user.list']);
    $routes->get("users/create", "UserController::create",['as'=>'user.create']);
    $routes->post("users/create", "UserController::store",['as'=>'user.store']);
    $routes->get("users/edit/(:num)", "UserController::edit/$1",['as'=>'user.edit']);
    $routes->post("users/edit", "UserController::saveEdit",['as'=>'user.edit.save']);
    $routes->get("users/view/(:num)", "UserController::show/$1",['as'=>'user.view']);
    $routes->get("users/delete/(:num)", "UserController::delete/$1",['as'=>'user.delete']);

    $routes->get("contact", "PageController::view",['as'=>'admin.contact.page']);

});

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
