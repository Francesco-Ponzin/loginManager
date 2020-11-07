<?php
header('Content-Type: application/json');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once "class/user_db.php";
include_once "class/login.php";


session_start();




if(isset($_REQUEST["model"])) $model = json_decode($_REQUEST["model"],true); else die("missing model");

switch ($model["action"]) {
    case 'add':
        if(isAutorized($_SESSION["username"] ?? null, "add")){
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
        if(isAutorized($_SESSION["username"] ?? null, "update")){
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

    case 'remove':
        if(isAutorized($_SESSION["username"] ?? null, "remove")){
            if(!isset($model["username"])) die("missing username");
            $user = new User($model["username"]);
            user_db::remove($user);
            echo json_encode($user);    
        }else{
            die("unauthorized");
        }
    break;
    
    case 'passwordchange':
        if(isAutorized($_SESSION["username"] ?? null, "passwordchange")){
            if(!isset($model["username"])) die("missing username");
            if(!isset($model["password"])) die("missing password");

            loginManager::setPassword($model["username"],$model["password"]);

            echo json_encode(true);    
        }else{
            die("unauthorized");
        }
    break;

    case 'loadall':
        if(isAutorized($_SESSION["username"] ?? null, "loadall")){
            $users = user_db::loadAll();
            $output = "[";
            $isFirst = true;
            foreach ($users as $user ) {
                $output .= ($isFirst?"":",") . $user->getAsJSON();
                $isFirst = false;
            }

            $output .= "]";

            echo $output;    
        }else{
            die("unauthorized");
        }
    break;
    
    default:
        die("missing action");
    break;
}


function isAutorized($user, $action= null, $detail = null){
    return true;
}