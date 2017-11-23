<?php 
namespace App\Models;

use PDO;
use \Core\Model as BaseModel;
use \Core\QueryBuilder as QB;

class User extends BaseModel
{
    /**
    * Error messages
    *
    * @var array
    */
    public $errors = [];

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
        $this->validate();
        if(empty($this->errors)) {
            $qb = new QB;
            $qb->conn = static::getDB();
            $columns = ['name', 'email', 'password_hash'];
            $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
            $values = [
                $this->name,
                $this->email,
                $password_hash
            ];
            $qb->insert('users', $columns, $values);
            return true;
        }else{
            return false;
        }
    }

    /**
    * Validate current property values, adding validation error messages to the errors array property
    *
    * @return void
    */
    public function validate()
    {
        // Name
        if($this->name == ''){
            $this->errors[] = "Name is required";
        }
        // email address
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL) === false){
            $this->errors[] = "Invalid email";
        }
        $this->emailExists($this->email);
        // Password
        if($this->password != $this->confpassword){
            $this->errors[] = "Password must match confirmation";
        }
        if(strlen($this->password) < 6){
            $this->errors[] = "Please enter at least 6 charactes for the password";
        }
        if(preg_match('/.*[a-z]+.*/i', $this->password) == 0){
            $this->errors[] = "Password needs at least one letter";
        }
        if(preg_match('/.*\d+.*/i', $this->password) == 0){
            $this->errors[] = "Password needs at least one number";
        }
    }
    
    /**
    * Check for email uniqeness in the database
    *
    * @param String
    * @return Boolean
    */
    public function emailExists($email)
    {
        $e = "'".$email."'";
        $qb = new QB;
        $qb->conn = static::getDB();
        $results = $qb->select('users', 'email')
           ->where('email', '=', $e)
           ->all();
        if(count($results) > 0){
            $this->errors[] = "Sorry! This email has already been taken.";
        }
    }
}