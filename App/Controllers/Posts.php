<?php
namespace App\Controllers;

use \Core\View;
use App\Models\Post;

class Posts extends \Core\Controller
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
        echo "Hello from the addNew action in the Posts controller!";
    }
}