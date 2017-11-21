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
        $qb = new QB;
        $qb->conn = static::getDB();
        return $qb->select('posts', '*')->all();
    } 

    public static function addPost()
    {
        $qb = new QB;
        $qb->conn = static::getDB();
        $columns = ['title', 'content'];
        $values = ['Ravens', 'They eat anything!'];

        return $qb->insert('posts', $columns, $values);
    }
}