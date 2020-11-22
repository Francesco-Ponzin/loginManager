<?php

class DBconnect
{
	static public function db()
	{
		try {
			$db = new PDO('mysql:host=localhost;dbname=loginmanager;charset=utf8mb4', 'loginmanager', 'bwR29WaCVdh4iZ0cl');
		} catch (PDOException $e) {
			throw new Exception(sprintf(
				"PDO connection failed: %s\n",
				$e->getMessage()
			));
		}

		return $db;
	}
}
