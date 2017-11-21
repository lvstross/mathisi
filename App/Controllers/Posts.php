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
    * Add a new post
    * @return void
    */
    public function store()
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
    public function all()
    {
        $results = Post::getAll();
        echo json_encode($results);
    }
}