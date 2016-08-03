<?php 

class Error
{
	public static function generate404()
	{
		require_once (ROOT . '/views/error404.php');
		die();
	}
}