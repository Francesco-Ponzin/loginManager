<?php

class User implements JsonSerializable{

    private $username;
    private $userdata;

    public function __construct($username, $role = ""){
        $this->username = $username;
        $this->userdata = [];
        $this->setRole($role);
    }

    public function getRole(){
        return $this->userdata["role"] ?? $this->setRole("");
    }

    public function setRole($role){

        switch ($role) {
            case 'admin':
                $this->userdata["role"] = "admin";
            break;
            case 'guest':
                $this->userdata["role"] = "guest";
            break;           
            default:
                $this->userdata["role"] = "nobody";
            break;
        }
        return $this->userdata["role"];
    }

    public function getUsername(){
        return $this->username;
    }

    public function getUserdata(){
        return $this->userdata;
    }

    public function setUserdata($userdata){
        $this->userdata = is_array($userdata) ? $userdata : [];
    }

    public function jsonSerialize(){
        $output = [];
        $output["username"] = $this->getUsername();
        $output["role"] = $this->getRole();
        return $output;
    }

}