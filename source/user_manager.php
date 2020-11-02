<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once "class/user_db.php";
include_once "class/login.php";

$isAuthorized = true;

var_dump($_REQUEST);

//if(isset($_REQUEST["model"])) $model = json_decode($_REQUEST["model"],true); else die("missing model");

if(isset($_REQUEST["model"])) $model = $_REQUEST["model"]; else die("missing model");

switch ($model["action"]) {
    case 'add':
        if($isAuthorized){
            if(!isset($model["username"])) die("missing username");
            if(!isset($model["password"])) die("missing password");
            $user = new User($model["username"]);
            if (isset($model["userdata"])) $user->setUserdata($model["userdata"]);

            user_db::add($user,$model["password"]);
            echo json_encode($user);    
        }else{
            die("unauthorized");
        }
    break;

    case 'update':
        if($isAuthorized){
            if(!isset($model["username"])) die("missing username");
            if(!isset($model["password"])) die("missing password");
            $user = new User($model["username"]);
            if (isset($model["userdata"])) $user->setUserdata($model["userdata"]);

            user_db::update($user);
            echo json_encode($user);    
        }else{
            die("unauthorized");
        }
    break;
    
    case 'passwordchange':
        if($isAuthorized){
            if(!isset($model["username"])) die("missing username");
            if(!isset($model["password"])) die("missing password");

            loginManager::setPassword($model["username"],$model["password"]);

            echo json_encode(true);    
        }else{
            die("unauthorized");
        }
    break;
    
    default:
        die("missing action");
    break;
}