<?php
namespace App\Controllers;

use App\Models\Post;
use App\Controllers\Auth\AuthController;
use Core\View;
use Core\Auth;

class Posts extends AuthController
{
    /**
    * Show the index page
    * @return void
    */
    public function indexAction()
    {
        $posts = Post::getAll();
        View::renderTemplate('Posts/index.html', [
            'posts' => $posts
        ]);
    }

    /**
    * Add a new post
    * @return void
    */
    public function storeAction()
    {   
        $result = Post::addPost();
        View::renderTemplate('Posts/index.html', [
            'result' => $result
        ]);
    }

    /**
    * API Route for getting the posts
    * @return json
    */
    public function allAction()
    {
        $results = Post::getAll();
        echo json_encode($results);
    }
}