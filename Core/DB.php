<?php

namespace Core;

use PDO;

class DB
{
    /**
    * @var pdo driver
    */
    private $PDO_DRIVER;

    /**
    * @var db host
    */
    private $DB_HOST;

    /**
    * @var db name
    */
    private $DB_NAME;

    /**
    * @var db user
    */
    private $DB_USER;

    /**
    * @var db password
    */
    private $DB_PASSWORD;

    /**
    * @var db object
    */
    private $db = null;

    /**
    * Class constructor
    * @return void
    */
    public function __construct()
    {
        // Get environment variables
        $this->PDO_DRIVER = getenv('PDO_DRIVER');
        $this->DB_HOST = getenv('DB_HOST');
        $this->DB_NAME = getenv('DB_NAME');
        $this->DB_USER = getenv('DB_USER');
        $this->DB_PASSWORD = getenv('DB_PASSWORD');
    }

    /**
    * Get the PDO database connection
    *
    * @return mixed
    */
    protected static function getDB()
    {
        if($this->db === null) {
            try {
                $dsn = $PDO_DRIVER . ':host=' . $DB_HOST . ';dbname=' . $DB_NAME . ';charset=utf8';
                $this->db = new PDO($dsn, $DB_USER, $DB_PASSWORD);
                // Throw an Exception when an error occurs
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->db;
            } catch (PDOException $e) {
                throw new Exception($e->getMessage());
            }
        }
        return $this->db;
    }
}