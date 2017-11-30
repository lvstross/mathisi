<?php 
namespace Core;

/**
* Generate unique random tokens
*/
class Token
{
    /**
    * The token value
    * @var array
    */
    protected $token;

    /**
    * Class contructor. Create a new random token
    *
    * @return void
    */
    public function __construct($token_value = null)
    {
        if($token_value){
            $this->token = $token_value;
        }else{
            $this->token = bin2hex(random_bytes(16));
        }
    }

    /**
    * Get the token value
    *
    * 
    * @return string The value
    */
    public function getValue()
    {
        return $this->token;
    }

    /**
    * Get the hashed toekn value
    *
    * @return string The hashed value
    */
    public function getHash()
    {
        return hash_hmac('sha256', $this->token, \App\Config::SECRET);
    }

    /**
    * Get Session id
    *
    * @return string Session id from Cookie super global
    */
    public static function getCsrfToken()
    {
        if(isset($_COOKIE['PHPSESSID'])){
            return $_COOKIE['PHPSESSID'];
        }
    }
}