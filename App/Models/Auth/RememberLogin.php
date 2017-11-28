<?php 

namespace App\Models\Auth;

use PDO;
use Core\Model as BaseModel;
use Core\Token;
use App\Models\Auth\User;
/**
* Remembered login model
*/
class RememberLogin extends BaseModel
{
    /**
    * Find a remembered login model by the token
    *
    * @param string $token  The remembered login token
    * @return mixed  Remember login object if found, false otherwise
    */
    public static function findByToken($token)
    {
        $token = new Token($token);
        $token_hash = $token->getHash();
        $sql = 'SELECT * FROM remember_tokens
                WHERE token_hash = :token_hash';
        $db = static::getDB();
        $stm = $db->prepare($sql);
        $stm->bindValue(':token_hash', $token_hash, PDO::PARAM_STR);
        $stm->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stm->execute();
        return $stm->fetch();
    }

    /**
    * Get the user model associated with this remembered login
    * 
    * @return User  The user model
    */
    public function getUser()
    {
        return User::findById($this->user_id);
    }

    /**
    * See if the remember token has expired or not
    *
    * @return boolean  True if the token has expired, false otherwise
    */
    public function hasExpired()
    {
        return strtotime($this->expires_at) < time();
    }

    /**
    * Delete this model
    *
    * @return void
    */
    public function delete()
    {
        $sql = 'DELETE FROM remember_tokens
                WHERE token_hash = :token_hash';
        $db = static::getDB();
        $stm = $db->prepare($sql);
        $stm->bindValue(':token_hash', $this->token_hash, PDO::PARAM_STR);
        $stm->execute();
    }
}