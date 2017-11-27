## Routing
All of your routes are handled in the 'Routes/routes.php' file.

```php
<?php 
use Core\Router;
$router = new Router();

// your routes here

$router->dispatch($_SERVER['REQUEST_URI']);
```

The __Router__ class utilizes an __add__ method for building your routes list. Each separate route or 
route pattern needs to be placed in it's own __add__ method. 

### Variable Pattern Routes
The routes themselves specify what controller and methods (actions) you want to execute.
This allows you to define multiple actions for one controller with only one defined route. The _controller_ 
variable is the part of the route where you place the name of your controller. The _action_ 
variable is the part of the route where you place the name of the action you wish to execute when
that route is called. The router automatically assumes that your controllers live in the 'App/Controllers' directory.

```php
$router->add('{controller}/{action}');
/* Used for
posts/add
posts/show
/*
```

### Custom Variable Routes
Custom variable routes are used when you want to create your own variable in a route. Because variable routes
are broken down into regular expressions, custom routes need to know what pattern to follow. When making a custom
variable route, wrap it in curly braces and pass in the variable name, then the regular expression with a colon separating them.
Because the Routing engine builds each regular express by adding the beginning slashes, ending slashes, and start and end of string characters 
as well as delimiters, your regular express only needs to be a basic pattern.
```php
$router->add('{controller}/{id:\d+}/{action}');
/* Used for
posts/2/show
posts/123/edit
*/
$router->add('{controller}/{name:[a-z]+}/{id:\d+}/{action}');
/* Used for
posts/john/23/show
posts/john/5/edit
*/
```


### Routes with parameters
Even though route patterns allow for less code when setting up your routes, it can get 
a little confusing to keep track of your routes. If you want to be a little more striked with
your routes, you can define them outright and pass the appropriate controller and action
in as a second parameter. This second parameter must be an associative array with the variable names
__controller__ and __action__ as the keys.
```php
$router->add('/', [
  'controller' => 'Home', 
  'action' => 'index'
  ]);

$router->add('/posts/view' [
  'controller' => 'Posts', 
  'action' => 'viewPosts'
  ]);

$router->add('/posts/add', [
  'controller' => 'Posts', 
  'action' => 'addPost'
  ]);
```
The router will automatically map the controller and action for the route given.


### Controllers in sub-folders
By default, the router assumes that all of your controllers live in the 'App/Controllers' directory.
If you wish to place controllers in sub-folders in the 'App/Controllers' directory, you can add an additional
__namespace__ key in your associative array. Be sure to add this namespace name at the top of the controller that
you've made in a sub-folder. This rule continues to apply the more you nest your controller files. The routing engine adds on 
'App/Controllers' in front of whatever namespace you created.

##### File
```php
<?php
namespace App\Controlles\Admin;
use \Core\Controller as BaseController;

class Users extends BaseController
{
    public function index()
    {

    }
}
```
##### Route
```php
$router->add('/admin/users/index', [
    'controller' => 'Users', 
    'action' => 'index', 
    'namespace' => 'Admin'
]);
/*
Routeing Engines searches for the 'index' action in the Users controller with the 'App\Controllers\Admin' namespace.
*/
```

Even with this kind of controller set up, you can still use variable routes as well

```php
$router->add('/admin/{controller}/{action}', ['namespace' => 'Admin']);
```