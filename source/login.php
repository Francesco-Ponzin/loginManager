<?php
header('Content-Type: application/json');

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once "class/login.php";

session_start();

if (isset($_REQUEST["model"])) {
    $model = json_decode($_REQUEST["model"], true);
    if (loginManager::login($model["username"], $model["password"])) {
        $_SESSION["username"] = $model["username"];
        echo '"' . $_SESSION["username"] . '"';
    } else {
        session_destroy();
        echo "false";
    }
}else{
    session_destroy();
    echo "false";
}
