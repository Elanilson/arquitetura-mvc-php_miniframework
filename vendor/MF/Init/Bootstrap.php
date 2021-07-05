<?php
namespace MF\Init;

abstract class Bootstrap {

	private $routes;
	abstract protected function initRountes();
	public function __construct(){
			$this->initRountes();
			$this->run($this->getUrl());
		}

	public function getRoutes(){
		return $this->routes;
	}
	public function setRoutes(array $routes){
		$this->routes =$routes;
	}

		protected function run ($url){
	 
		foreach ($this->getRoutes() as $key => $route) {
			if($url == $route['route']){
				$class = "App\\Controllers\\".ucfirst($route["controller"]);

				$action = $route['action'];

				$controle = new $class;

				$controle->$action();

			}
		}
	}

	protected function getUrl(){
		return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	}



}


?>