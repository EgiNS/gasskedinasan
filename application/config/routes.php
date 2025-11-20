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

$route['default_controller'] = 'landingpage';
// $route['default_controller'] = 'auth';
// $route['(:any)'] = 'maintenance';
$route['admin/tryout'] = 'admins/Tryout';
$route['admin/tryout/(:any)'] = 'admins/Tryout/detailtryout/$1';
$route['admin/paket-to'] = 'admins/PaketTo';
$route['admin/paket-to/tambah'] = 'admins/PaketTo/tambahpaket';
$route['admin/paket-to/edit/(:num)'] = 'admins/PaketTo/edit/$1';
$route['admin/paket-to/participant/(:any)/delete'] = 'admins/PaketTo/delete_participant/$1/$2';
$route['admin/paket-to/(:any)/show'] = 'admins/PaketTo/show_packet/$1';
$route['admin/paket-to/(:any)'] = 'admins/PaketTo/detail/$1';
$route['admin/event/(:any)'] = 'admins/Event/detail/$1';
$route['404_override'] = 'my404';
$route['translate_uri_dashes'] = FALSE;
$route['midtrans/token'] = 'MidtransController/token';
$route['midtrans/notification'] = 'MidtransController/notification';
$route['tryout/paket-to/registration'] = 'PaketTo/paket_to_registration';
$route['tryout/paket-to/(:any)'] = 'PaketTo/detail/$1';
$route['tryout/events/(:num)'] = 'Event/detail_event/$1';
$route['tryout/events/registration'] = 'Event/event_registration';
// $route['midtrans/snap/token'] = 'midtrans/snap/token';
// $route['processing/(:any)'] = 'frontend/processing/$1';
// $route['profile/(:any)'] = 'frontend/profile/$1';