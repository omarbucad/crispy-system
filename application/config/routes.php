<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login/forgot-password'] = 'login/forgot_password';

$route['app/setup/sales-taxes'] = 'app/setup/sales_tax';
$route['app/setup/users/add'] = 'app/setup/add_users';
$route['app/setup/users/view'] = 'app/setup/view_users';
$route['app/setup/outlets-and-registers'] = 'app/setup/outlets_and_registers';
$route['app/setup/add-outlet'] = 'app/setup/add_outlet';
$route['app/setup/add-register'] = 'app/setup/add_register';




$route['app/product/order-stock'] = 'app/product/order_stock';
$route['app/product/return-stock'] = 'app/product/return_stock';
$route['app/product/inventory-count'] = 'app/product/inventory_count';
$route['app/product/supplier/add'] = 'app/product/add_supplier';
$route['app/product/supplier/view/(:any)'] = 'app/product/view_supplier/$1';




$route['app/customer/add-customer'] = 'app/customer/add';
$route['app/customer/import-customer'] = 'app/customer/import';
