<?php
namespace App\Controllers;


use App\Models\Post;
use \Core\View;
use \Core\Mail;
use \Core\Controller as BaseController;

class Posts extends BaseController
{
    /**
    * Show the index page
    * @return void
    */
    public function index()
    {
        $posts = Post::getAll();
        View::renderTemplate('Posts/index.html', [
            'posts' => $posts
        ]);
    }

    /**
    * Show the add new page
    * @return void
    */
    public function addNew()
    {   
        $subject = 'Learning How To Use MVC-Mailing';
        $body = "<h1>Hello there!</h1><p>This email is coming from the addnew function in the posts controller.</p>";
        $addresses = [''];
        // Mail::newEmail($subject, $body, $addresses);
    }
}