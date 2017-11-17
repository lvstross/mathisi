<?php 
namespace App\Models;
use PDO;

class Post extends \Core\Model
{
    /**
    * Get all the posts as an associative array
    *
    * @return array
    */
    public static function getAll()
    {
        try {
            $conn = static::getDB();
            $stm = $conn->query('SELECT id, title, content FROM posts ORDER BY created_at');
            $results = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}