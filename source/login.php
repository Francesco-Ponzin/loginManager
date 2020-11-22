<?php
header('Content-Type: application/json');

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once "class/login.php";
include_once "class/user_db.php";

session_start();

if (isset($_REQUEST["model"])) $model = json_decode($_REQUEST["model"], true);
else die("missing model");


switch ($model["action"] ?? "") {

    case 'login':
        if (loginManager::login($model["username"], $model["password"])) {
            $_SESSION["user"] = user_db::load($model["username"]);
            echo json_encode($_SESSION["user"]);
        } else {
            session_destroy();
            echo "false";
        }
        break;

    case 'logout':
        session_destroy();
        echo "true";
        break;

    case 'load':
        echo json_encode($_SESSION["user"] ?? false);
        break;

    default:
        die("missing action");
        break;
}
