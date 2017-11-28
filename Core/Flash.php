<?php 

namespace Core;
/**
* Flash notification messages class
*/
class Flash
{
    /**
    * Default message type
    * @var string
    */
    const DEFAULT = 'default';

    /**
    * Success message type
    * @var string
    */
    const SUCCESS = 'success';

    /**
    * Information message type
    * @var string
    */
    const INFO = 'info';

    /**
    * Warning message type
    * @var string
    */
    const WARNING = 'warning';

    /**
    * Add a message
    *
    * @param string $message  The message content
    * @param string $type. The message type
    * @return void
    */
    public static function addMessage($message, $type = 'default')
    {
        if(! isset($_SESSION['flash'])) {
            $_SESSION['flash'] = [];
        }
        $_SESSION['flash'][] = [
            'body' => $message,
            'type' => $type
        ];
    }

    /**
    * Get all the messages
    *
    * @return mixed  An array with all the messages or null if none set
    */
    public static function getMessages()
    {
        if (isset($_SESSION['flash'])) {
            $messages =  $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $messages;
        }
    }
}