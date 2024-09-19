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
|	https://codeigniter.com/userguide3/general/routing.html
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

// Authentication
$route['login'] = 'auth/auth';
$route['logout'] = 'auth/auth/logout';

/**
 * User Controller
 * Activity
*/
$route['dashboard'] = 'user/dashboard';

$route['activity'] = 'user/activity';
$route['activity/create'] = 'user/activity/create';
$route['activity/store'] = 'user/activity/store';
$route['activity/show/(:num)'] = 'user/activity/show/$1';
$route['activity/update/(:num)'] = 'user/activity/update/$1';
$route['activity/detail/show/(:num)'] = 'user/activity_detail/show/$1';
$route['activity/delete/(:num)'] = 'user/activity/delete/$1';

// History
$route['history'] = 'user/history';

// Report
$route['report'] = 'user/report';
$route['report/pdf'] = 'user/report/pdf';
$route['report/excel'] = 'user/report/excel';

/**
 * Tech Controller
 * Dashboard
*/
$route['dashboard/tech'] = 'tech/dashboard';

// Activity
$route['activity/tech'] = 'tech/activity';
$route['activity/take/tech/(:num)'] = 'tech/activity/take/$1';
$route['activity/show/tech/(:num)'] = 'tech/activity/show/$1';
$route['activity/detail/create/tech/(:num)'] = 'tech/activity_detail/create/$1';
$route['activity/detail/store/tech/(:num)'] = 'tech/activity_detail/store/$1';
$route['activity/detail/show/tech/(:num)'] = 'tech/activity_detail/show/$1';
$route['activity/detail/update/tech/(:num)'] = 'tech/activity_detail/update/$1';
$route['activity/detail/delete/tech/(:num)'] = 'tech/activity_detail/delete/$1';

$route['activity/create-tech/tech/(:num)'] = 'tech/activity_tech/create/$1';
$route['activity/delete-tech/tech/(:num)'] = 'tech/activity_tech/delete/$1';

// History
$route['history/tech'] = 'tech/history';

// Report
$route['report/tech'] = 'tech/report';
$route['report/pdf/tech'] = 'tech/report/pdf';
$route['report/excel/tech'] = 'tech/report/excel';
