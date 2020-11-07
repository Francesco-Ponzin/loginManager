<?php
include_once "user_db.php";

class User{

    private $username;
    private $userdata = "";

    public function __construct($username){
        $this->username = $username;
    }

    public function getUserdata(){
        return $this->userdata;
    }

    public function setUserdata($userdata){
        $this->userdata = $userdata;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getAsJSON(){
        return json_encode(["username" => $this->username, "userdata" => $this->userdata]);
    }

}