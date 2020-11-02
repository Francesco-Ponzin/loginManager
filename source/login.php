<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once "class/login.php";

session_start();

if (isset($_REQUEST["model"]) && loginManager::login($_REQUEST["model"]["username"], $_REQUEST["model"]["password"])){
    $_SESSION["username"] = $_REQUEST["model"]["username"];
}else{
    session_destroy();
}

