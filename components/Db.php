<?php

class Db {
	private $connection;
	protected static $instance = NULL;

	private function __wakeup(){}
	private function __clone(){}

	private function __construct() {
		$params = include (ROOT . '/config/params.php');

        $dsn = "mysql:host={$params['host']};dbname={$params['db']}";
        $opt = [
		    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		];
        $this->connection = new PDO($dsn, $params['user'], $params['password'], $opt);
	}

	public static function getConnection() {
		if (self::$instance === NULL) {
			$obj = new self;
			return $obj->connection;
		}
		return self::$instance->connection;
	}
}

