<?php 

namespace Core;

class Error
{
    /**
    * Error handler. convert all errors to Exceptions by throwing an ErrorException.
    *
    * @param int $level Error level
    * @param string $message Error message
    * @param string $file Filename the error was raised in 
    * @param int $line Line number in the file
    *
    * @return void
    */
    public static function errorHandler($level, $messagae, $file, $line)
    {
        if (error_reporting() !== 0) { // to keep the @ operator working
            if(!isset($message)){
                $message = "No message given";
            }
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
    * Exception handler
    *
    * @param Exception $exception The Exception
    *
    * @return void
    */
    public static function exceptionHandler($exception)
    {
        // Code is 404 (not found) or 500 (general error)
        $code = $exception->getCode();
        if($code != 404){
            $code = 500;
        }
        http_response_code($code);
        $error_status = getenv('SHOW_ERRORS');
        if($error_status){
            echo "<h1 style='text-align:center;color:#fff;background-color:#dd4040;margin-bottom:0px;border-radius:10px 10px 0 0;'>Fatal error</h1>";
            echo "<div style='background-color:#d6cfcf;border-radius:0 0 10px 10px;padding:20px;margin-top:0px;'>";
            echo "<p><strong>Uncaught exception:</strong> '" . get_class($exception) . "'</p>";
            echo "<p><strong>Message:</strong> '" . $exception->getMessage() . "'</p>";
            echo "<p><strong>Stack trace:</strong> <pre>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p><strong>Thrown in</strong> '" . $exception->getFile() . "' on line <strong>" . $exception->getLine() . "</strong></p>";
            echo "</div>";
        } else {
            $log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);

            $message = "Uncaught Exception: '" . get_class($exception) . "'";
            $message .= " with message '" . $exception->getMessage() . "'";
            $message .= "\nStack trace: " . $exception->getTraceAsString();
            $message .= "\nThrown in '" . $exception->getFile() . "' on line " . $exception->getLine();
            $message .= "\n";

            error_log($message);
            View::renderTemplate("$code.html");
        }
    }
}