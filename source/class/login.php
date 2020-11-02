<?php

include_once "dbconnect.php";

class loginManager{

	public static function login($username, $password)
	{

		$db = DBconnect::db();
		$sql = 'SELECT `algorithm`, `passwordhash`, `salt` FROM `users` WHERE `username` = ? ';
		$sth = $db->prepare($sql);
		if (!$sth->execute([$username])) {
			throw new Exception(sprintf(
				"Error PDO exec: %s",
				implode(',', $db->errorInfo())
			));
		}

		$user = $sth->fetch(PDO::FETCH_OBJ);
		if ($user == null) return false;
		return hash($user->algorithm, $user->salt . $password) == $user->passwordhash;
	}

	public static function setPassword($username, $password, $algorithm = "sha3-256")
	{
		$db = DBconnect::db();
		$sql = 'UPDATE `users` SET `passwordhash` = :passwordhash, `salt` = :salt, `algorithm` = :algorithm WHERE `username` = :username';
		$sth = $db->prepare($sql);

		$data = self::generatePasswordDataset($password, $algorithm);
		$data[":username"] = $username;

		if (!$sth->execute($data)) {
			throw new Exception(sprintf(
				"Error PDO exec: %s",
				implode(',', $db->errorInfo())
			));
		}
	}

	public static function generatePasswordDataset($password, $algorithm = "sha3-256"){
		$salt = base64_encode(random_bytes("128"));
		$passwordhash = hash($algorithm, $salt . $password);
		$data = [
				":passwordhash" => $passwordhash,
				":salt" => $salt,
				":algorithm" => $algorithm,
			];
		return $data;
	}

}

