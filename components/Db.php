<?php

class Db {
	private $_params;
	public $connection;
	protected static $_instance = NULL;

	private function __wakeup(){}
	private function __clone(){}

	private function __construct() {
		$this->_params = include (ROOT . '/config/params.php');

		$this->connection = new mysqli(
			$this->_params['host'],
			$this->_params['user'],
			$this->_params['password'],
			$this->_params['db']
		) or die ("Невозможно установить соединение" );

		if ($this->connection->connect_errno) {
	  		printf("Не удалось подключиться: %s\n", $this->connection->connect_error);
	   		exit();
		}
	}

	public static function getInstance() {
		if (self::$_instance === NULL) {
			return new self;
		}
		return self::$_instance;
	}
}
