<?php
/**
 * Class Router configures routes, 
 * directs to associated controller function.
 */
class Router
{
	protected $uri;
	protected static $method;
	protected $controller;
	protected $routes = [

		'/' => 'index',
		'/home' => 'index',
		'/upload' => 'upload',
		'/download' => 'download',
		'/error' => 'error',

	];

	public function __construct()
	{
		self::$method = Request::getMethod();
		$this->uri = Request::getPath();
		$this->controller = new Controller();
	}

	public function direct()
	{
		switch ($this->uri) {
			case '/home':
				$this->determine($this->uri);	
	
				break;

			case '/upload':
				$this->determine($this->uri);	
				break;

			case '/download':
				$this->determine($this->uri);	
				break;
			
			case '/':
				$this->determine($this->uri);					
				break;

			default :
				$this->determine('/error');
		}
	}

	public function determine($data)
	{
		if (method_exists($this->controller, $this->routes[$data])) {
			$method = $this->routes[$data];
			call_user_func([$this->controller, "$method"]);
		}else {
			return false;
		}
	}

	public static function getMethod()
	{
		return self::$method;
	}

}