<?php 
namespace App\Models;

use PDO;
use \Core\Model as BaseModel;
use \Core\QueryBuilder as QB;

class User extends BaseModel
{
    /**
    * Class constructor
    *
    * @param array $data Initial property values
    * @return void
    */
    public function __construct($data)
    {
        foreach($data as $key => $value) {
            $this->$key = $value;
        };
    }

    /**
    * Save the user model with the current property values
    * @return void
    */
    public function save()
    {
        $qb = new QB;
        $qb->conn = static::getDB();
        $columns = ['name', 'email', 'password_hash'];
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $values = [
            $this->name,
            $this->email,
            $password_hash
        ];
        return $qb->insert('users', $columns, $values);
    }
}