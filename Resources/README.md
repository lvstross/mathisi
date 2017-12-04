## Application Resources

The application resources folder is broken up into two parts:
1. PHP or Twig View files in the /views directory
2. JS and CSS files in the /assets directory

### Views

If you've ever used Symphony Frameworks Twig templating engine before, you'll feel right at home as the views core has full Twig support out of the box.
See Twig docs [here](https://twig.symfony.com/).

#### To Twig or not to Twig

When it comes to your views, you have two options in rendering your views. The first is 'render'. This method assums nothing about your template and will 
render it like normal PHP. If you desire to build you templates with regular php, this is the method to use. Be sure to have a '.php' extension for all regular 
php view files.
```php
    /**
    * Show the index page
    * @return void
    */
    public function index()
    {
        View::render('Home/index.php');
    }
```

However, if you want to take advantage of the Twig templating engine, you'll need to pass your views through the 'renderTemplate' method. This method will pass 
your view through the twig envoironment for processing. Use this method for all Twig syntax. File extension can be either html or php. 

```php
    /**
    * Show the index page
    * @return void
    */
    public function index()
    {
        View::renderTemplate('Home/index.html');
    }
```

### Setting Global Variables for all Twig Templates

If you need to set any global variables in your twig templates, added them to the returned array in the /resources/views/\_globals.php file. These global variables can 
then be used in your templates. Simply use the key name wrapped in double curly braces.

```php
// _globals.php

return [
    "firstname" => "John",
    "lastname" => "Doe"
];

***************************

// Twig Template

<h1>Hello, {{firstname}} {{ lastname }}</h1>
```

### Assets

The assets folder has the same use case as seen in Laravel. This is were you would place any javascript and sass to be compiled into your project. 
If you have used Laravel Mix before, feel right at home. If you are new to Laravel Mix, see the documentation [here](https://laravel.com/docs/5.5/mix).