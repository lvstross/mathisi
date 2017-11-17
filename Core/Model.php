<?php 
namespace Core;

use PDO;
use App\Config;

abstract class Model
{
    /**
    * Get the PDO database connection
    */
    protected static function getDB()
    {
        static $db = null;
        if($db === null) {

            try {
                $dsn = Config::PDO_DRIVER . ':host=' . Config::DB_HOST . ';dbname=' . 
                Config::DB_NAME . ';charset=utf8';
                $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        return $db;
    }
}