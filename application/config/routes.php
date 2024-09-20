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

/**
 * Admin Controller
 * Dashboard
*/
$route['dashboard/admin'] = 'admin/dashboard';

// Activity
$route['activity/admin'] = 'admin/activity';
$route['activity/create/admin'] = 'admin/activity/create/';
$route['activity/store/admin'] = 'admin/activity/store/';
$route['activity/show/admin/(:num)'] = 'admin/activity/show/$1';
$route['activity/update/admin/(:num)'] = 'admin/activity/update/$1';
$route['activity/delete/admin/(:num)'] = 'admin/activity/delete/$1';

// Activity Details
$route['activity/detail/create/admin/(:num)'] = 'admin/activity_detail/create/$1';
$route['activity/detail/store/admin/(:num)'] = 'admin/activity_detail/store/$1';
$route['activity/detail/show/admin/(:num)'] = 'admin/activity_detail/show/$1';
$route['activity/detail/update/admin/(:num)'] = 'admin/activity_detail/update/$1';
$route['activity/detail/delete/admin/(:num)'] = 'admin/activity_detail/delete/$1';

// Activity Technician
$route['activity/create-tech/admin/(:num)'] = 'admin/activity_tech/create/$1';
$route['activity/store-tech/admin/(:num)'] = 'admin/activity_tech/store/$1';
$route['activity/show-tech/admin/(:num)'] = 'admin/activity_tech/show/$1';
$route['activity/update-tech/admin/(:num)'] = 'admin/activity_tech/update/$1';
$route['activity/delete-tech/admin/(:num)'] = 'admin/activity_tech/delete/$1';

// Constrain Category
$route['constrain/admin'] = 'admin/constrain_category';
$route['constrain/create/admin'] = 'admin/constrain_category/create';
$route['constrain/store/admin'] = 'admin/constrain_category/store';
$route['constrain/show/admin/(:num)'] = 'admin/constrain_category/show/$1';
$route['constrain/update/admin/(:num)'] = 'admin/constrain_category/update/$1';
$route['constrain/delete/admin/(:num)'] = 'admin/constrain_category/delete/$1';

// Activity Category
$route['activity/category/admin'] = 'admin/activity_category';
$route['activity/category/create/admin'] = 'admin/activity_category/create';
$route['activity/category/store/admin'] = 'admin/activity_category/store';
$route['activity/category/show/admin/(:num)'] = 'admin/activity_category/show/$1';
$route['activity/category/update/admin/(:num)'] = 'admin/activity_category/update/$1';
$route['activity/category/delete/admin/(:num)'] = 'admin/activity_category/delete/$1';

// Company Branch
$route['branch/admin'] = 'admin/company_branch';
$route['branch/create/admin'] = 'admin/company_branch/create';
$route['branch/store/admin'] = 'admin/company_branch/store';
$route['branch/show/admin/(:num)'] = 'admin/company_branch/show/$1';
$route['branch/update/admin/(:num)'] = 'admin/company_branch/update/$1';
$route['branch/delete/admin/(:num)'] = 'admin/company_branch/delete/$1';

// Entity Group
$route['entity-group/admin'] = 'admin/group_of_entity';
$route['entity-group/create/admin'] = 'admin/group_of_entity/create';
$route['entity-group/store/admin'] = 'admin/group_of_entity/store';
$route['entity-group/show/admin/(:num)'] = 'admin/group_of_entity/show/$1';
$route['entity-group/update/admin/(:num)'] = 'admin/group_of_entity/update/$1';
$route['entity-group/delete/admin/(:num)'] = 'admin/group_of_entity/delete/$1';

// Enterprise
$route['enterprise/admin'] = 'admin/enterprise';
$route['enterprise/create/admin'] = 'admin/enterprise/create';
$route['enterprise/store/admin'] = 'admin/enterprise/store';
$route['enterprise/show/admin/(:num)'] = 'admin/enterprise/show/$1';
$route['enterprise/update/admin/(:num)'] = 'admin/enterprise/update/$1';
$route['enterprise/delete/admin/(:num)'] = 'admin/enterprise/delete/$1';

// Enterprise Status
$route['enterprise/status/admin'] = 'admin/enterprise_status';
$route['enterprise/status/create/admin'] = 'admin/enterprise_status/create';
$route['enterprise/status/store/admin'] = 'admin/enterprise_status/store';
$route['enterprise/status/show/admin/(:num)'] = 'admin/enterprise_status/show/$1';
$route['enterprise/status/update/admin/(:num)'] = 'admin/enterprise_status/update/$1';
$route['enterprise/status/delete/admin/(:num)'] = 'admin/enterprise_status/delete/$1';

// User
$route['user/admin'] = 'admin/user';
$route['user/create/admin'] = 'admin/user/create';
$route['user/store/admin'] = 'admin/user/store';
$route['user/show/admin/(:num)'] = 'admin/user/show/$1';
$route['user/update/admin/(:num)'] = 'admin/user/update/$1';
$route['user/delete/admin/(:num)'] = 'admin/user/delete/$1';

// History
$route['history/admin'] = 'admin/history';

// Report
$route['report/user/admin'] = 'admin/report/user';
$route['report/tech/admin'] = 'admin/report/tech';
$route['report/user-pdf/admin'] = 'admin/report/user_pdf';
$route['report/tech-pdf/admin'] = 'admin/report/tech_pdf';
$route['report/excel/admin'] = 'admin/report/excel';
