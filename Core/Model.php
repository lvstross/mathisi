<?php 
namespace Core;

use Core\DB;

abstract class Model
{
    /**
    * @var $db Object
    */
    private $db = null;

    /**
    * Class constructor
    * @param Core\DB $db
    * @return void
    */
    public function __construct(DB $db)
    {
        $this->db = $db->getDB();
    }

    /**
    * Return all resources
    *
    * @return mixed Resoures
    */
    protected static function all($table)
    {
        try{
            $query = "SELECT * FROM $table";
            $stm = $this->db->query($query);
            $results = $stm->fetchAll($this->db::FETCH_OBJ);
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
            $query = "SELECT * FROM $table WHERE id=:id LIMIT 1";
            $stm = $this->db->prepare($query);
            $stm->bindParam(":id", $id, $this->db::PARAM_INT);
            $stm->execute();
            $results = $stm->fetch($this->db::FETCH_OBJ);
            return $results;
        }catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }
}