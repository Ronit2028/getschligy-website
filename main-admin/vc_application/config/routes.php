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
$route['default_controller'] = 'user/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/* Admin */
$route['admin'] = 'user/index';
$route['welcome'] = 'user/admin_welcome';
$route['login'] = 'user/index';
$route['logout'] = 'user/logout';
$route['login/validate_credentials'] = 'user/validate_credentials';
$route['admin/member-login'] = 'vc_site_admin/user/member_login';
$route ['get-bliss-code-by-phone'] = 'vc_site_admin/user/get_bliss_code_by_phone';


/*Gallery*/
$route['admin/gallery'] = 'vc_site_admin/gallery/index';
$route['admin/payouts-release'] = 'vc_site_admin/redeam/payouts_release'; 
$route['admin/gallery/add'] = 'vc_site_admin/gallery/add';
$route['admin/gallery/edit/(:num)'] = 'vc_site_admin/gallery/update/$1';
$route['admin/gallery/del/(:num)'] = 'vc_site_admin/gallery/del/$1'; 
$route['admin/ytb'] = 'vc_site_admin/gallery/yt_gallery';
$route['admin/ytb/add'] = 'vc_site_admin/gallery/ytb_add';
$route['admin/ytb/edit/(:num)'] = 'vc_site_admin/gallery/ytb_update/$1';
$route['admin/ytb/del/(:num)'] = 'vc_site_admin/gallery/ytb_del/$1';


$route['admin/password'] = 'vc_site_admin/password/index'; 

/*News*/
$route['admin/news'] = 'vc_site_admin/news/index';
$route['admin/news/add'] = 'vc_site_admin/news/add';
$route['admin/news/edit/(:num)'] = 'vc_site_admin/news/update/$1';
$route['admin/news/del/(:num)'] = 'vc_site_admin/news/del/$1';
$route['admin/reward'] = 'vc_site_admin/customer/reward';

/*Orders*/
$route['admin/order'] = 'vc_site_admin/order/index';
$route['admin/order/(:num)'] = 'vc_site_admin/order/order_view/$1';
$route['admin/order/distribute/(:num)'] = 'vc_site_admin/order/order_distribute/$1';

/*customers*/
$route['admin/customer'] = 'vc_site_admin/customer/index';
$route['admin/customer/add'] = 'vc_site_admin/customer/add';
$route['admin/customer/edit/(:num)'] = 'vc_site_admin/customer/update/$1';
$route['admin/customer/del/(:num)'] = 'vc_site_admin/customer/del/$1';
$route['admin/wallet_request_list'] = 'vc_site_admin/customer/wallet_request_list';
$route['admin/feedback'] = 'vc_site_admin/customer/feedback_list';
$route['admin/feedback/edit/(:num)'] = 'vc_site_admin/customer/feedback_update/$1';
$route['admin/pin_request/edit/(:num)'] = 'vc_site_admin/customer/pin_request_update/$1';

/*review*/
$route['admin/review'] = 'vc_site_admin/review/index';
$route['admin/review/add'] = 'vc_site_admin/review/add';
$route['admin/review/edit/(:num)'] = 'vc_site_admin/review/update/$1';
$route['admin/review/del/(:num)'] = 'vc_site_admin/review/del/$1';

/*redeem*/
$route['admin/redeam'] = 'vc_site_admin/redeam/index';
$route['admin/redeam/add'] = 'vc_site_admin/redeam/add';
$route['admin/redeam/edit/(:num)'] = 'vc_site_admin/redeam/update/$1';
$route['admin/redeam/del/(:num)'] = 'vc_site_admin/redeam/del/$1';

/*doc verification*/
$route['admin/docverification'] = 'vc_site_admin/docverification/index';
$route['admin/docverification/add'] = 'vc_site_admin/docverification/add';
$route['admin/docverification/edit/(:num)'] = 'vc_site_admin/docverification/update/$1';
$route['admin/docverification/del/(:num)'] = 'vc_site_admin/docverification/del/$1';

/*product*/
$route['admin/product'] = 'vc_site_admin/product/index';
$route['admin/product/add'] = 'vc_site_admin/product/add';
$route['admin/product/edit/(:num)'] = 'vc_site_admin/product/update/$1';
$route['admin/product/del/(:num)'] = 'vc_site_admin/product/del/$1';
$route['admin/ecommerce'] = 'vc_site_admin/product/ecommerce';
$route['admin/ecommerce/add'] = 'vc_site_admin/product/ecommerce_add';
$route['admin/ecommerce/edit/(:num)'] = 'vc_site_admin/product/ecommerce_update/$1';
$route['admin/ecommerce/del/(:num)'] = 'vc_site_admin/product/ecommerce_del/$1';
$route['admin/distribution'] = 'vc_site_admin/product/distribution';


/* pin */
$route['admin/payouts'] = 'vc_site_admin/pin/payouts';
$route['admin/weekly-closing'] = 'vc_site_admin/pin/weekly_closing';
$route['admin/pin/my-pin-transfer'] = 'vc_site_admin/pin/my_pin_transfer';
$route['admin/bank-statement'] = 'vc_site_admin/pin/bank_statement';
$route['admin/bank-process'] = 'vc_site_admin/pin/bank_process';


/*Lamlord Manual Entry*/
$route['admin/lamlord'] = 'vc_site_admin/lamlord/index';
$route['admin/lamlord/add'] = 'vc_site_admin/lamlord/add';
$route['admin/lamlord/edit/(:num)'] = 'vc_site_admin/lamlord/update/$1';
$route['admin/lamlord/del/(:num)'] = 'vc_site_admin/lamlord/del/$1';



/*tax*/
$route['admin/tax'] = 'vc_site_admin/tax/index';
$route['admin/tax/add'] = 'vc_site_admin/tax/add';
$route['admin/tax/edit/(:num)'] = 'vc_site_admin/tax/update/$1';
$route['admin/tax/del/(:num)'] = 'vc_site_admin/tax/del/$1';

$route['admin/category'] = 'vc_site_admin/category/index';
$route['admin/category/add'] = 'vc_site_admin/category/add';
$route['admin/category/edit/(:num)'] = 'vc_site_admin/category/update/$1';
$route['admin/category/del/(:num)'] = 'vc_site_admin/category/del/$1';

$route['admin/coupon'] = 'vc_site_admin/coupon/index';
$route['admin/coupon/add'] = 'vc_site_admin/coupon/add';
$route['admin/coupon/edit/(:num)'] = 'vc_site_admin/coupon/update/$1';
$route['admin/coupon/del/(:num)'] = 'vc_site_admin/coupon/del/$1';


$route['admin/seo'] = 'vc_site_admin/seo/index';
$route['admin/seo/add'] = 'vc_site_admin/seo/add';
$route['admin/seo/edit/(:num)'] = 'vc_site_admin/seo/update/$1';
$route['admin/seo/del/(:num)'] = 'vc_site_admin/seo/del/$1';

$route['admin/webstores'] = 'vc_site_admin/webstores/index';
$route['admin/webstores/add'] = 'vc_site_admin/webstores/add';
$route['admin/webstores/edit/(:num)'] = 'vc_site_admin/webstores/update/$1';
$route['admin/webstores/del/(:num)'] = 'vc_site_admin/webstores/del/$1';


$route['admin/merchant'] = 'vc_site_admin/merchant/index';
$route['admin/merchant/add'] = 'vc_site_admin/merchant/add';
$route['admin/merchant/edit/(:num)'] = 'vc_site_admin/merchant/update/$1';
$route['admin/merchant/del/(:num)'] = 'vc_site_admin/merchant/del/$1';
/* Search */
$route['admin/search'] = 'vc_site_admin/search';
$route['admin/wallet/add'] = 'vc_site_admin/customer/wallet';
$route['admin/college/add'] = 'vc_site_admin/customer/college_update';
$route['admin/wallet/history'] = 'vc_site_admin/customer/wallet_history';
$route['admin/pin/used'] = 'vc_site_admin/pin/used_pins';



$route['admin/pin_sale'] = 'vc_site_admin/sale/pininsale';
$route['admin/pin_invoice/(:num)'] = 'vc_site_admin/sale/pininvoice/$1';


$route['admin/scholarship'] = 'vc_site_admin/gallery/scholarship';
$route['admin/scholarship/edit/(:num)'] = 'vc_site_admin/gallery/scholarship_update/$1';

$route['admin/scholarship_results'] = 'vc_site_admin/gallery/scholarship_results';

$route['admin/quiz'] = 'vc_site_admin/gallery/quiz';
$route['admin/quiz_ques/(:num)'] = 'vc_site_admin/gallery/quiz_ques/$1';
$route['admin/quiz/add'] = 'vc_site_admin/gallery/quiz_add';
$route['admin/quiz/que/(:num)'] = 'vc_site_admin/gallery/quiz_question/$1';
$route['admin/quiz/quiz_question_update/(:num)'] = 'vc_site_admin/gallery/quiz_question_update/$1';
$route['admin/quiz/edit/(:num)'] = 'vc_site_admin/gallery/quiz_update/$1';
$route['admin/quiz/del/(:num)'] = 'vc_site_admin/gallery/quiz_del/$1';

$route['admin/individual'] = 'vc_site_admin/customer/individaul_list';
$route['admin/individual/del/(:any)'] = 'vc_site_admin/customer/individual_del/$1';

$route['admin/corporation'] = 'vc_site_admin/customer/corporation_list';
$route['admin/corporation/del/(:any)'] = 'vc_site_admin/customer/corporation_del/$1';



$route['admin/myschlorship'] = 'vc_site_admin/customer/myschlorship_list';
$route['admin/myschlorship/add'] = 'vc_site_admin/customer/myschlorship_add';

$route['admin/myschlorship/edit/(:num)'] = 'vc_site_admin/customer/myschlorship_update/$1';
$route['admin/myschlorship/del/(:num)'] = 'vc_site_admin/customer/myschlorship_del/$1';

$route['admin/schlorship_reply'] = 'vc_site_admin/customer/schlorship_reply';
$route['admin/schlorship_reply/view/(:num)'] = 'vc_site_admin/customer/schlorship_reply_view';
$route['admin/schlorship_reply/edit/(:num)'] = 'vc_site_admin/customer/schlorship_reply_edit';







$route['admin/team'] = 'vc_site_admin/customer/team_list';
$route['admin/team/del/(:any)'] = 'vc_site_admin/customer/team_del/$1';

$route['admin/contact'] = 'vc_site_admin/customer/contact_list';
$route['admin/contact/del/(:any)'] = 'vc_site_admin/customer/contact_del/$1';
















?>