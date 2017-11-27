## Controllers

All controllers must be places in the 'App/Controllers' directory. There are two different types of
controllers available:

1. [BaseController](https://github.com/lvstross/mvc-framework/tree/master/Core/Controller.php)
2. [AuthController](https://github.com/lvstross/mvc-framework/tree/master/App/Controllers/Auth/AuthController.php)

### BaseController
The BaseController may be used when all your methods require no authentication or when only some of 
your methods require authentication. A controller file can be set up like so.

```php
<?php

namespace App\Controllers;

use Core\View;
use Core\Controller as BaseController;

class Home extends BaseController
{
    /**
    * Show the index page
    * @return void
    */
    public function index()
    {
        View::renderTemplate('Home/index.html');
    }
}
?>
```

#### Calling before and after methods
The BaseController comes with before and after methods that can be called for any controller method.
Simply add these methods to your controller and include the word 'Action' after every method you wish
to call the before and after methods. 

```php
<?php

class Home extends BaseController
{
    protected function before
    {
        echo 'Called before index view is loaded!';
    }

    public function indexAction()
    {
        View::renderTemplate('Home/index.html');
    }

    protected function after
    {
        echo 'Called after index view is loaded!';
    }
}

?>
```

#### Dump and Die

If at anytime in your controller you wish to dump a variable and kill the program. Included is the 'dd' 
method. Call it on the controller instance at anytime.

```php
<?php

class Home extends BaseController
{
    /**
    * Show the index page
    * @return void
    */
    public function index()
    {
        $data = ['red', 'green', 'blue'];
        $this->dd($data);
        // the following will not be executed
        View::renderTemplate('Home/index.html');
    }
}
?>
```

#### Redirecting
If at any point in your controller you need to redirect to another page, simply call the 'redirect' 
method and pass in the url you wish to redirect to. 

```php
class Home extends BaseController
{
    /**
    * Show the index page
    * @return void
    */
    public function index()
    {
        if($user_id){
            View::renderTemplate('Posts/posts.html');
        }else{
            $this->redirect('/login');
        }
    }
}
```

#### BaseController Authentication
If only some of your methods require authentication while others do not, simply call the 'middleware' 
method before your code block to authenticate the user.

```php
class Posts extends BaseController
{
    /**
    * Show the posts index page
    * @return void
    */
    public function index()
    {
        $this->middleware();
        // Will be redirected to '/' if not authenticated.

        $posts = Post::getAll();
        View::renderTemplate('Posts/index.html', [
            'posts' => $posts
        ]);
    }
```

### AuthController
The AuthController is for when all methods in your controller require authentication before being 
called. This controller class contains all the previously metioned methods in the BaseController. All 
this controller simply allows you to do so call methods without having to declare the 'middleware' method 
everytime. An AuthController can be created like so.

```php
<?php
namespace App\Controllers;

use Core\View;
use App\Models\Post;
use App\Controllers\Auth\Authenticated;

class Posts extends Authenticated
{
    /**
    * Show the posts index page
    * @return void
    */
    public function index()
    {
        $posts = Post::getAll();
        View::renderTemplate('Posts/index.html', [
            'posts' => $posts
        ]);
    }
}
```

### Routing and Controllers in sub-folder
See the [Routing](https://github.com/lvstross/mvc-framework/tree/master/Routes#controllers-in-sub-folders) documentation for routing to controllers placed in sub-folders.