<?php 
namespace App\Models;

use PDO;
use Core\Model as BaseModel;
use Core\QueryBuilder as QB;

class Post extends BaseModel
{
    /**
    * Get all the posts as an associative array
    *
    * @return array
    */
    public static function getAll()
    {
        
        // You can interact with your database either by the query builder
        // $qb = new QB;
        // $qb->conn = Post::getDB();
        // return $qb->select('posts', '*')->all();

        // or with the quick model methods
        // return Post::all('posts');
    } 


    public static function addPost()
    {
        // $qb = new QB;
        // $qb->conn = Post::getDB();
        // $columns = ['title', 'content'];
        // $values = ['Ravens', 'They eat anything!'];

        // return $qb->insert('posts', $columns, $values);
    }
}