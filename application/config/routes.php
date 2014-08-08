<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "public/articles";
$route['404_override'] = '';
$route['quienes-somos'] = 'public/pages/about';
$route['contacto'] = 'public/pages/contact';
$route['articulos/(:any)/(:num)'] = "public/articles/article/$1/$2";
$route['categorias/(:any)/(:num)'] = "public/categories/category/$1/$2";
//  Articles
$route['admin/articles/(:num)'] = "admin/articles/index/$1";
$route['admin/articles/article-activate/(:num)'] = "admin/articles/articleActivate/$1";
$route['admin/articles/article-deactivate/(:num)'] = "admin/articles/articleDeactivate/$1";
$route['admin/articles/article-status/(:num)'] = "admin/articles/articleStatus/$1";
$route['admin/articles/article-new'] = "admin/articles/articleNew";
$route['admin/articles/article-edit/(:num)'] = "admin/articles/articleEdit/$1";
$route['admin/articles/article-delete/(:num)'] = "admin/articles/articleDelete/$1";
$route['admin/categories/category-new'] = "admin/categories/categoryNew";
$route['admin/categories/category-edit/(:num)'] = "admin/categories/categoryEdit/$1";
$route['admin/categories/category-delete/(:num)'] = "admin/categories/categoryDelete/$1";
$route['admin/cities/(:num)'] = "admin/cities/getCities/$1";
$route['admin/customers/(:num)'] = "admin/customers/index/$1";
$route['admin/customers/customer-new'] = 'admin/customers/customerNew';
$route['admin/customers/customer-edit/(:num)'] = "admin/customers/customerEdit/$1";
$route['admin/customers/customer-delete/(:num)'] = "admin/customers/customerDelete/$1";
$route['admin/customers/customer-statistics'] = "admin/customers/customerStatistics";

$route['admin/pictures/(:num)'] = "admin/pictures/index/$1";
$route['admin/pictures/picture-new'] = "admin/pictures/pictureNew";
$route['admin/pictures/picture-edit/(:num)'] = "admin/pictures/pictureEdit/$1";
$route['admin/pictures/picture-delete/(:num)'] = "admin/pictures/pictureDelete/$1";
$route['admin/pictures/picture-preview/(:num)'] = "admin/pictures/picturePreview/$1";

$route['admin/slides/(:num)'] = "admin/slides/index/$1";
$route['admin/slides/slide-activate/(:num)'] = "admin/slides/slideActivate/$1";
$route['admin/slides/slide-deactivate/(:num)'] = "admin/slides/slideDeactivate/$1";
$route['admin/slides/slide-new'] = "admin/slides/slideNew";
$route['admin/slides/slide-edit/(:num)'] = "admin/slides/slideEdit/$1";
$route['admin/slides/slide-delete/(:num)'] = "admin/slides/slideDelete/$1";

$route['admin/purchases/(:num)'] = "admin/purchases/index/$1";
$route['admin/purchases/purchase-new'] = "admin/purchases/purchaseNew";
$route['admin/purchases/purchase-edit/(:num)'] = "admin/purchases/purchaseEdit/$1";
$route['admin/purchases/purchase-delete/(:num)'] = "admin/purchases/purchaseDelete/$1";
$route['admin'] = 'admin/dashboard/index';
$route['admin/users'] = 'admin/users/index';
$route['admin/users/user-activate/(:num)'] = "admin/users/userActivate/$1";
//$route['admin/users/'] = 'admin/users/userChangePassword';
$route['admin/users/user-deactivate/(:num)'] = "admin/users/userDeactivate/$1";
$route['admin/users/user-edit/(:num)'] = "admin/users/userEdit/$1";
$route['admin/forgot-password'] = 'admin/users/userForgotPassword';
$route['admin/login'] = 'admin/users/userLogin';
$route['admin/logout'] = 'admin/users/userLogout';
$route['admin/users/user-new'] = 'admin/users/userNew';
//$route['admin/users/'] = 'admin/users/userResetPassword';

$route['admin/tools/backup-database'] = 'admin/tools/backupDatabase';






/* End of file routes.php */
/* Location: ./application/config/routes.php */