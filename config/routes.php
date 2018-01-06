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

$route['default_controller'] = "Users/welcome";
$route['register'] = "Users/register";
$route['login'] = "Users/login";
$route['home'] = "Users/home2";
$route['users'] = "Users/allUsers";
$route['update/userProfile'] = "Users/updateUserProfile";
$route['process']= "Users/process";
$route['404_override'] = '';

$route['update/userUsername'] = "Users/updateUserUsername";
$route['update/userPassword'] = "Users/updateUserPassword";
$route['update/userEmail'] = "Users/updateUserEmail";
$route['images']        = 'Image/index2';
$route['image/upload']  = 'Image/upload';
$route['image/user']    = 'Image/userImages';
$route['user/logout']   = 'Users/logout';
$route['image/(:num)/delete'] = 'Image/pictureDelete/$1';
$route['image/(:num)/comment']   = 'Image/comment/$1';
$route['admin/comment/(:num)/delete']   = 'Admin/commentDelete/$1';
$route['image/(:num)/comments'] = 'Image/allComments/$1';
$route['admin/dashboard'] = 'Admin/dashboard';
$route['admin/users/table'] = 'Admin/usersTable';
$route['admin/users/allPictures'] = 'Admin/allPictures';
$route['admin/users/(:num)/pictures'] = 'Admin/userPictures/$1';
$route['admin/users/(:num)/delete'] = 'Admin/pictureDelete/$1';
$route['admin/user/(:num)/delete'] = 'Admin/userDelete/$1';
$route['admin/user/(:num)/update'] = 'Admin/userUpdate/$1';
$route['admin/user/(:num)/edit'] = 'Admin/editUser/$1';
$route['admin/user/(:num)/editModal'] = 'Admin/getUserModal/$1';
$route['images/max_comments_reached'] = 'Image/maxComments';
$route['test'] = 'Users/test';

/* End of file routes.php */
/* Location: ./application/config/routes.php */