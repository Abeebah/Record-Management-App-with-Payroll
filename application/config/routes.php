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


//records route
$route['records']                   = 'records';
$route['records/add-records']       = 'records/add_records';
$route['records/records-process']   = 'records/records_process';
$route['records/records-delete']    = 'records/records_delete';
$route['records/company-select']    = 'records/company_select';


// payroll route
$route['payroll']                   = 'payroll';
$route['payroll/payroll-range']     = 'payroll/payroll_range';
$route['payroll/add-payroll-view']  = 'payroll/add_payroll_view';
$route['payroll/staff-select']      = 'payroll/staff_select';
$route['payroll/payroll-process']   = 'payroll/payroll_process';


// reports route
$route['reports']                   = 'reports';



// settings route 
$route['settings']                  = 'settings';
$route['settings/loggedin']         = 'settings/loggedin';
$route['settings/company']          = 'settings/company_view';
$route['settings/category']         = 'settings/category_view';
$route['settings/users']            = 'settings/users_view';
$route['settings/edit-company']     = 'settings/edit_company';
$route['settings/company-process']  = 'settings/company_process';
$route['settings/delete-company']   = 'settings/delete_company';
$route['settings/edit-category']    = 'settings/edit_category';
$route['settings/category-process'] = 'settings/category_process';
$route['settings/delete-category']  = 'settings/delete_category';
$route['settings/users-process']    = 'settings/users_process';
$route['settings/users-edit']       = 'settings/users_edit';
$route['settings/edit-user-process']= 'settings/edit_user_process';
$route['settings/reset-suspend-user']= 'settings/reset_suspend_user';

$route['dashboard']         = 'app/dashboard';
$route['login']             = 'app/login';
$route['signout']           = 'app/signout';
$route['change-password']   = 'app/change_password';

$route['default_controller'] = 'app';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
