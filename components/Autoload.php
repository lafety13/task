<?php

function __autoload($class)
{
	$path = [
		'/components/',
		'/controllers/',
		'/models/',
		'/views/',
	];

	foreach ($path as $pathName) {
		$file = ROOT . $pathName . $class . '.php';

		if (is_file($file)) {
			include_once $file;
		}
	}
}