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

$route['default_controller'] = "Cloudrecipes";
$route['goto_register'] = "Cloudrecipes/goto_register";
$route['register'] = "Cloudrecipes/register";
$route['signin'] = "Cloudrecipes/signin_process";
$route['logout'] = "Cloudrecipes/logout";
$route['new_ingredient'] = "Cloudrecipes/new_ingredient_view";
$route['add_new_ingr'] = "Cloudrecipes/add_ingredients";
$route['add_recipe'] = "Cloudrecipes/add_recipe_view";
$route['create_recipe'] = "Cloudrecipes/add_recipes";
$route['view_ingredients'] = "Cloudrecipes/view_ingredients";
$route['get_recipe_lists'] = "Cloudrecipes/get_recipe_lists";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */