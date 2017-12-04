<?php 
namespace Core;

use PDO;
use App\Config;

abstract class Model
{
    /**
    * Get the PDO database connection
    *
    * @return mixed
    */
    protected static function getDB()
    {
        static $db = null;
        if($db === null) {

            try {
                $dsn = Config::PDO_DRIVER . ':host=' . Config::DB_HOST . ';dbname=' . 
                Config::DB_NAME . ';charset=utf8';
                $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
                
                // Throw an Exception when an error occurs
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $db;
            } catch (PDOException $e) {
                throw new Exception($e->getMessage());
            }
        }
        return $db;
    }

    /**
    * Return all resources
    *
    * @return mixed Resoures
    */
    protected static function all($table)
    {
        try{
            $db = self::getDB();
            $query = "SELECT * FROM $table";
            $stm = $db->query($query);
            $results = $stm->fetchAll(PDO::FETCH_OBJ);
            return $results;
        }catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
    * Find one resource by id
    *
    * @return mixed Resoures
    */
    protected static function findOrFail($table, $id = 0)
    {
        try{
            $db = self::getDB();
            $query = "SELECT * FROM $table WHERE id=:id LIMIT 1";
            $stm = $db->prepare($query);
            $stm->bindParam(":id", $id, PDO::PARAM_INT);
            $stm->execute();
            $results = $stm->fetch(PDO::FETCH_OBJ);
            return $results;
        }catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }
}