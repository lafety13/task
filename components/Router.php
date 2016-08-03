<?php 

class Router
{
	private $_routes;

	public function __construct()
	{
		$pathRoutes = ROOT . '/config/routes.php';
		$this->_routes = include $pathRoutes;
	}
	private function _getUri() 
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}

	public function run() 
	{
		$uri = $this->_getUri();

		foreach ($this->_routes as $uriPattern => $path) {
			if (preg_match("~$uriPattern~", $uri)) { 
	   		   	$internalRoute = preg_replace("~$uriPattern~", $path, $uri);

	   		   	$segments = explode('/', $internalRoute);
	   		   	
	   		   	$controllerName = ucfirst(array_shift($segments)) . 'Controller';
	   		   	$actionName = 'action' . ucfirst(array_shift($segments));
	   		   	$parameters = $segments;

	   		   	$controllerFile = ROOT . '/controllers/' . 
	   		   		$controllerName . '.php';

	   		   	if (file_exists($controllerFile)) {
	   		   		if (method_exists(new $controllerName(), $actionName)) {
	   		   			include_once $controllerFile;
	   		   		} else {
	   		   			Error::generate404();
	   		   		}
	   		   	} else {
	   		   		Error::generate404();
	   		   	}

	   		   	$controllerObj = new $controllerName();
	   		   	$result = call_user_func_array([$controllerObj, $actionName], $parameters);

	   		   	if ($result != NULL) {
	   		   		break;
	   		   	}
			}
		}
	}
}