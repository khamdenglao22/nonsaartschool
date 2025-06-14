<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);

session_start();

// Define configuration
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "db_school");

// Front-end
define('SITE_URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https' : 'http' . '://' . $_SERVER['HTTP_HOST'] . '/');

function autoloadClass($className)
{
    $filename = realpath (dirname(__FILE__)) . "/classes/" . $className . ".php";
    if (is_readable($filename)) {
        if (!class_exists($filename)) {
            require_once $filename;
        }
    }
}

function autoloadGlobal($className)
{
    $filename = realpath (dirname(__FILE__)) . "/global/" . $className . ".php";
    if (is_readable($filename)) {
        if (!class_exists($filename)) {
            require_once $filename;
        }

    }
}

spl_autoload_register("autoloadClass");
spl_autoload_register("autoloadGlobal");
// LOAD LIBRARY
// require_once('libs/functions.php');
require_once('libs/libs.php');

// $core = new Core();




