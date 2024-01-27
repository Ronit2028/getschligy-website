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
|	https://codeigniter.com/user_guide/general/routing.htmlf
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
$route['default_controller'] = 'customer_front';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
 
/* User login & Signup */
$route['login'] = 'vc_site_admin/user/validate_credentials';
$route['signin'] = 'page/login';
$route['uploadreadymodal'] = 'vc_site_admin/user/validate_upl_credentials';
$route['review'] = 'vc_site_admin/user/validate_review';
//$route['forgetpassword'] = 'vc_site_admin/user/forgotPassword';
$route['logout'] = 'vc_site_admin/user/logout';
$route['admin/logout'] = 'vc_site_admin/user/logout';
$route ['register'] = 'vc_site_admin/user/create_member';
$route ['signup'] = 'page/registration';
$route ['profile'] = 'vc_site_admin/user/profile';
$route ['reference/(:any)(:num)'] = 'customer_front';
$route ['get-bliss-code-by-phone'] = 'vc_site_admin/user/get_bliss_code_by_phone';


$route['forgetpassword'] = 'page/forget_password';
$route['bankers'] = 'page/bankers';
$route['about'] = 'page/about';
$route['landing_page'] = 'page/landing_page';
$route['courses'] = 'page/courses';
$route['individual'] = 'page/individual';
$route['corpo'] = 'page/corpo';
$route['scholar_more'] = 'page/learn_more';
$route['learn/(:any)'] = 'page/learn';
$route['why_us'] = 'page/why_us';
$route['scholarship'] = 'page/scholarship';
$route['scholarship_form'] = 'page/scholarship_form';
$route['scholarship_form3'] = 'page/scholarship_form3';
$route['scholarship_form4'] = 'page/scholarship_form4';
$route['scholarship_form5'] = 'page/scholarship_form5';
$route['join_our_team'] = 'page/join_our_team';
$route['Contribute_with_us'] = 'page/Contribute_with_us';
$route['engineering'] = 'page/engineering';
$route['pharmacy'] = 'page/pharmacy';
$route['para_medical'] = 'page/para_medical';
$route['Business_management'] = 'page/Business_management';
$route['Computer_Application'] = 'page/Computer_Application'; 
$route['Food_Agriculture_forestry'] = 'page/Food_Agriculture_forestry';
$route['law'] = 'page/law';
$route['hotel_and_turism_management'] = 'page/hotel_and_turism_management';
$route['Education_and_Teaching'] = 'page/Education_and_Teaching';
$route['Dental'] = 'page/Dental';
$route['mass'] = 'page/mass';
$route['Nursing'] = 'page/Nursing';
//$route['signup'] = 'page/signup';
$route['grievance'] = 'page/grievance';
$route['business_plan'] = 'page/business_plan';
$route['offers'] = 'page/offers';
$route['store_locator'] = 'page/store_locator';
$route['help'] = 'page/help';
$route['track_order'] = 'page/track_order';
$route['corporate'] = 'page/corporate';
$route['send_a_query'] = 'page/send_a_query';
$route['contact_us'] = 'page/contact_us';
$route['feedback'] = 'page/feedback';
$route['complaint'] = 'page/complaint';
$route['career'] = 'page/career';
$route['faq'] = 'page/faq';
$route['how_do_i_shop'] = 'page/how_do_i_shop';
$route['terms_of_use'] = 'page/terms_of_use';
$route['how_do_i_pay'] = 'page/how_do_i_pay';
$route['privacy'] = 'page/privacy';
$route['desclaimer'] = 'page/desclaimer';
$route['stories'] = 'page/stories';
$route['return_policy'] = 'page/return_policy';
$route['cancellation'] = 'page/cancellation';
$route['shipping_policy'] = 'page/shipping_policy';
$route['exchanges_return'] = 'page/exchanges_return';
$route['happy_hours'] = 'page/happy_hours';
$route['ways-to-earn'] = 'page/ways_to_earn';
$route['winners_league'] = 'page/winners_league';
$route['good_times'] = 'page/good_times';
$route['the_one'] = 'page/the_one';

$route['cart'] = 'cart/index';
$route['cart/remove/(:any)'] = 'cart/remove/$1';
$route['checkout'] = 'checkout/index';
$route['payment'] = 'checkout/payment';
$route['ccavenue'] = 'checkout/ccavenue';
$route['thankyou'] = 'checkout/thankyou';
$route['search'] = 'product/search';

$route['category/(:any)'] = 'category/index';
$route['category/(:any)/page/(:num)'] = 'category/index';
$route['products'] = 'product/bliss_product_list';
$route['deals-king'] = 'deals/index';
$route['deals/(:any)(:num)'] = 'deals/merchants_deal';
$route['new-arrivals'] = 'product/new_arrivals';
$route['stores'] = 'product/stores';
$route['divino-product/(:any)'] = 'product/bliss_product';  
$route['add-product/(:any)'] = 'product/add_to_cart';  
$route['product/(:any)'] = 'product/product';


/* Admin */
$route['admin'] = 'vc_site_admin/profile/index';
$route['admin/profile'] = 'vc_site_admin/profile/profile';
$route['admin/my_Colleges'] = 'vc_site_admin/profile/my_Colleges';
$route['admin/request-wallet'] = 'vc_site_admin/profile/pin_request';
$route['admin/totalincome'] = 'vc_site_admin/profile/totalincome';
$route['admin/welcomeletter'] = 'vc_site_admin/profile/welcomeletter';
$route['admin/rewards'] = 'vc_site_admin/profile/rewards';
$route['admin/total_affiliate'] = 'vc_site_admin/profile/total_affiliate';
$route['admin/total_affiliate/(:any)'] = 'vc_site_admin/profile/total_affiliate/$1';
$route['admin/downline'] = 'vc_site_admin/profile/downline_all';
$route['admin/activate_account'] = 'vc_site_admin/profile/activate_account';

/* update Admin password */
$route['admin/password'] = 'vc_site_admin/password';
 
 
/*Report*/
$route['admin/grievance'] = 'vc_site_admin/report/index';
$route['admin/complaint'] = 'vc_site_admin/report/complaint';
$route['admin/contact'] = 'vc_site_admin/report/contact';

/*Orders*/
$route['admin/order'] = 'vc_site_admin/order/index';
$route['admin/order/(:num)'] = 'vc_site_admin/order/order_view/$1';


/*profileupdate*/
$route['admin/proedit'] = 'vc_site_admin/proedit/index';
$route['admin/proedit/edit/(:num)'] = 'vc_site_admin/proedit/update/$1';
$route['admin/income/(:any)'] = 'vc_site_admin/income/index';

/*Distributor Level Information*/
$route['admin/DistributorLevelInformation'] = 'vc_site_admin/DistributorLevelInformation/index';
$route['admin/DistributorLevelInformation/(:any)'] = 'vc_site_admin/DistributorLevelInformation/index/$1';


/*Downline all*/
$route['admin/downlineall'] = 'vc_site_admin/downlineall/index';
$route['admin/downlineall/(:any)'] = 'vc_site_admin/downlineall/index/$1';

/*Downline*/
$route['admin/downline'] = 'vc_site_admin/downline/index';
$route['admin/scholarship'] = 'vc_site_admin/downline/scholarship';
$route['admin/downline/(:any)'] = 'vc_site_admin/downline/index/$1';

/*Downline sale*/
$route['admin/downlinesale'] = 'vc_site_admin/downlinesale/index';
$route['admin/downlinesale/(:any)'] = 'vc_site_admin/downlinesale/downlinesale/$1';
$route['admin/transfer_fund'] = 'vc_site_admin/income/transfer_fund';
$route['admin/transfer_history'] = 'vc_site_admin/income/transfer_history';
$route['admin/Payment_request'] = 'vc_site_admin/income/Payment_request';


/*Pin sale*/
$route['admin/pin_sale'] = 'vc_site_admin/sale/pininsale';
$route['admin/pin_invoice/(:num)'] = 'vc_site_admin/sale/pininvoice/$1';


$route['quiz'] = 'page/quiz';
$route['quiz-result/(:any)'] = 'page/quiz_result';
$route['start-quiz/(:num)/(:any)/(:any)'] = 'page/quiz_start';
$route['scholar_more/(:any)'] = 'page/learn_more/$1';
$route['admin/preview/(:any)'] = 'vc_site_admin/profile/preview/$1';
$route['google_login'] = 'vc_site_admin/user/google_login';

?>