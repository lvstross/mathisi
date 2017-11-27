<?php
namespace Core;

use App\Models\User;

class Auth
{
    /**
    * Set Session variables
    *
    * @return void
    */
    public static function setUserId($id)
    {
        session_regenerate_id(true);
        $_SESSION['id'] = $id;
    }

    /**
    * Destroy Session
    *
    * @return void
    */
    public static function destroySession()
    {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }

    /**
    * Remember the originally requested page in the session
    *
    * @return void
    */
    public static function rememberRequestedPage()
    {
        $_SESSION["return_to"] = $_SERVER['REQUEST_URI'];
    }

    /**
    * Get the previous requested page
    *
    * @return void
    */
    public static function getReturnToPage()
    {
        if(isset($_SESSION["return_to"])){
            return $_SESSION["return_to"];
        }
        return '/';
    }

    /**
    * Get the current logged in user.
    *
    * @return mixed The user model or null if not logged in
    */
    public static function getUser()
    {
        if(isset($_SESSION["id"])){
            return User::findById($_SESSION['id']);
        }
    }
}