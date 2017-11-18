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
        $columns = ['id', 'title', 'content'];
        
        return $qb->selectMultiple('posts', $columns)
                ->whereNotIn('id', ['2', '3'], 'ARRAY_VALUES')
                ->all();
    }
}