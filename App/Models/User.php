<?php 
namespace App\Models;

use PDO;
use \Core\Auth;
use \Core\Model as BaseModel;
use \Core\QueryBuilder as QB;

/**
* App User Class
* 
* Apart of the authentication system
*/
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

    /**
    * Check for email uniqeness in the database
    *
    * @param String
    * @return Boolean
    */
    public static function findById($id)
    {
        $_id = "'".$id."'";
        $qb = new QB;
        $qb->conn = static::getDB();
        $results = $qb->select('users', '*')
           ->where('id', '=', $_id)
           ->all();
        return $results;
    }

    /**
    * Authenticate user
    *
    * @return void
    */
    public function authenticate()
    {
        $e = "'" . $this->email . "'";
        $p = "'" . $this->password . "'";
        $qb = new QB;
        $qb->conn = static::getDB();
        $results = $qb->select('users', '*')
                      ->where('email', '=', $e)
                      ->all();
        if(count($results) > 0){
            if(password_verify($this->password, $results[0]['password_hash'])){
                Auth::setUserId($results[0]['id']);
                return true;
            }else{
                $this->errors[] = "Your password does not match your email.";
            }
        }else{
            $this->errors[] = "Sorry, these credentials were not found.";
        }
        return false;
    }
}