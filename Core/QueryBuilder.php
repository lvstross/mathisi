<?php 
namespace Core;
use PDO;

/**
* Query Builder Class
*/
class QueryBuilder
{
    /**
    * Query String
    * @var String
    */
    protected $query = "";

    /**
    * Database connection
    * @var PDO instace
    */
    public $conn;


    /**
    * Raw Query 
    *
    * @param String Query to execute
    * @return array
    */
    public function raw($str)
    {
        try{
            $this->query = $str;
            $stm = $this->conn->query($this->query);
            $results = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
    * Select Statements
    *
    * @param string Database Table
    * @param array Columns to select from
    *
    * @return $this
    */
    public function select($table, $column)
    {
        // Constructiong the select statement
        $this->query = "SELECT ";
        $this->query .= $column;
        $this->query .= " FROM $table";
        return $this;
    }

    /**
    * Select Statements with Multiple columns
    *
    * @param string Database Table
    * @param array Columns to select from
    *
    * @return $this
    */
    public function selectMultiple($table, $columns = [])
    {
        // Constructiong the select statement
        $this->query = "SELECT ";
        $this->query .= $this->makeColumns($columns);
        $this->query .= " FROM $table";
        return $this;
    }

    /**
    * Where clause
    *
    * @param String Column name
    * @param String Operator
    * @param String Qualifier
    */
    public function where($column, $operator='', $qualifier='')
    {
        $this->query .= " WHERE ". $column . $operator . $qualifier;
        return $this;
    }

    /**
    * AND Operator
    *
    * @return $this
    */
    public function and($column, $operator='', $qualifier='')
    {
        $this->query .= " && " . $column . $operator . $qualifier;
        return $this;
    }

    /**
    * OR Operator
    *
    * @return $this
    */
    public function or($column, $operator='', $qualifier='')
    {
        $this->query .= " || " . $column . $operator . $qualifier;
        return $this;
    }

    /**
    * Order By
    *
    * @param String
    * @return $this
    */
    public function orderBy($table)
    {
        $this->query .= " ORDER BY $table";
        return $this;
    }

    /**
    * Array to columns String Converter
    *
    * @param array
    * @return string
    */
    private function makeColumns($columnsArr)
    {
        $string = '';
        for($i=0; $i < count($columnsArr); $i++){
            if($i === (count($columnsArr) - 1)){
                $string .= $columnsArr[$i];
            } else {
                $string .= $columnsArr[$i] . ',';
            }
        }
        return $string;
    }

    /**
    * Fetch the query
    *
    * @return array
    */
    public function get()
    {
        try{
            $stm = $this->conn->query($this->query);
            $results = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}