<?php

/**
 * Mathisi - Learn by building
 *
 * @package  Mathisi
 * @author   Levi Gonzales | gonzalesdev.com
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// Emulate Apache's mod_rewrite without a standard webserver.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';