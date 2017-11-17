<?php 
namespace App\Models;

use PDO;
use \Core\Model as BaseModel;
use \Core\QueryBuilder as QB;

class Post extends BaseModel
{
    /**
    * Get all the posts as an associative array
    *
    * @return array
    */
    public static function getAll()
    {
        // $conn = static::getDB();
        $qb = new QB;
        $qb->conn = static::getDB();
        $columns = ['id', 'title', 'content'];

        // return $qb->raw("SELECT id,title,content FROM posts WHERE id=1 || title='Shark Week' ORDER BY created_at");

        // or
        
        return $qb->selectMultiple('posts', $columns)
                ->where('id', '=', '1')
                ->or('title', '=', "'Shark Week'")
                ->orderBy('created_at')
                ->get();
    }
}