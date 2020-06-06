<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'Auth';

$route['auth'] = 'Auth';

// ------------------------------------------------------------------------
// SuperAdmin
// ------------------------------------------------------------------------
$route['superadmin/dashboard']                              = 'SuperAdmin/DashboardController';


$route['superadmin/barang']                                 = 'SuperAdmin/BarangController';
$route['superadmin/barang/create']                          = 'SuperAdmin/BarangController/create';
$route['superadmin/barang/store']                           = 'SuperAdmin/BarangController/store';
$route['superadmin/barang/edit/(:any)']                     = 'SuperAdmin/BarangController/edit/$1';
$route['superadmin/barang/update']                          = 'SuperAdmin/BarangController/update';
$route['superadmin/barang/delete/(:any)']                   = 'SuperAdmin/BarangController/delete/$1';

$route['superadmin/unit']                                   = 'SuperAdmin/UnitController';
$route['superadmin/unit/create']                            = 'SuperAdmin/UnitController/create';
$route['superadmin/unit/store']                             = 'SuperAdmin/UnitController/store';
$route['superadmin/unit/edit/(:any)']                       = 'SuperAdmin/UnitController/edit/$1';
$route['superadmin/unit/update']                            = 'SuperAdmin/UnitController/update';
$route['superadmin/unit/delete/(:any)']                     = 'SuperAdmin/UnitController/delete/$1';

$route['superadmin/barang_masuk']                           = 'SuperAdmin/BarangMasukController';
$route['superadmin/barang_masuk/create']                    = 'SuperAdmin/BarangMasukController/create';
$route['superadmin/barang_masuk/store']                     = 'SuperAdmin/BarangMasukController/store';
$route['superadmin/barang_masuk/edit/(:any)']               = 'SuperAdmin/BarangMasukController/edit/$1';
$route['superadmin/barang_masuk/update']                    = 'SuperAdmin/BarangMasukController/update';
$route['superadmin/barang_masuk/delete/(:any)']             = 'SuperAdmin/BarangMasukController/delete/$1';

$route['superadmin/barang_keluar']                           = 'SuperAdmin/BarangKeluarController';
$route['superadmin/barang_keluar/create']                    = 'SuperAdmin/BarangKeluarController/create';
$route['superadmin/barang_keluar/store']                     = 'SuperAdmin/BarangKeluarController/store';
$route['superadmin/barang_keluar/edit/(:any)']               = 'SuperAdmin/BarangKeluarController/edit/$1';
$route['superadmin/barang_keluar/update']                    = 'SuperAdmin/BarangKeluarController/update';
$route['superadmin/barang_keluar/delete/(:any)']             = 'SuperAdmin/BarangKeluarController/delete/$1';

$route['superadmin/kondisi']                                = 'SuperAdmin/KondisiController';

$route['profile/edit']                                      = 'ProfileController/edit';
$route['profile/update']                                    = 'ProfileController/update';
$route['profile/changepassword']                            = 'ProfileController/changepassword';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
