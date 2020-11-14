<?php

include_once "dbconnect.php";
include_once "user.php";


class user_db{


    public static function load($username){

        $db = DBconnect::db();
        $sql = 'SELECT `username`, `userdata` FROM `users` WHERE `username` = ? ';
        $sth = $db->prepare($sql);

        if (!$sth->execute([$username])) {
            throw new Exception(sprintf(
                "Error PDO exec: %s",
                implode(',', $db->errorInfo())
            ));
        }


        $record = $sth->fetchAll(PDO::FETCH_OBJ)[0] ?? null;
        if($record !== null){
            $user = new User($record->username);
            $user->setUserdata(json_decode($record->userdata));
            return $user;            
        }
        return false;
    }

    public static function loadAll(){
        $db = DBconnect::db();
        $sql = 'SELECT `username`, `userdata` FROM `users`';
        $sth = $db->prepare($sql);

        if (!$sth->execute()) {
            throw new Exception(sprintf(
                "Error PDO exec: %s",
                implode(',', $db->errorInfo())
            ));
        }

        $records = $sth->fetchAll(PDO::FETCH_OBJ);
        $users = [];
        foreach ($records as $record) {
            $user = new User($record->username);
            $user->setUserdata(json_decode($record->userdata));
            $users[] = $user;
        }
        return $users;
    }

    public static function update(User $user){
        $db = DBconnect::db();
        $sql = 'UPDATE `users` SET `userdata` = :userdata WHERE `username` = :username';
        $sth = $db->prepare($sql);
        $data = [
            ':username' => $user->getUsername(),
            ':userdata' => json_encode($user->getUserdata())
        ];
        if (!$sth->execute($data)) {
            throw new Exception(sprintf(
                "Error PDO exec: %s",
                implode(',', $db->errorInfo())
            ));
        }
    }

    public static function remove(User $user){
        $db = DBconnect::db();
        $sql = 'DELETE FROM `users` WHERE `username` = :username';
        $sth = $db->prepare($sql);
        $data = [
            ':username' => $user->getUsername(),
        ];
        if (!$sth->execute($data)) {
            throw new Exception(sprintf(
                "Error PDO exec: %s",
                implode(',', $db->errorInfo())
            ));
        }

        return true;
    }

    public static function add(User $user, string $password){
        $db = DBconnect::db();
        $sql = 'INSERT INTO users (username, userdata, passwordhash, salt, algorithm) VALUES (:username, :userdata, :passwordhash, :salt, :algorithm)';
        $sth = $db->prepare($sql);

        $data = loginManager::generatePasswordDataset($password);

        $data += [
                ':username' => $user->getUsername(),
                ':userdata' => json_encode($user->getUserdata())
            ];

        return $sth->execute($data);

    } 


}