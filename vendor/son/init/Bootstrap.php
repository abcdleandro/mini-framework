<?php

namespace son\init;

abstract class Bootstrap {
    
    protected $routes;

    public function __construct() {        
        $this->_initRoute();
        echo $this->run( $this->getUrl() );
    }
    
    protected function getUrl() {
        //$return  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        $partten = "#([a-zA-Z0-9\/]+)(\?.*)?#";
        $arg     = preg_replace($partten, "$1", $_SERVER['REQUEST_URI']);
        return $arg;
    }
    
    public function setRoutes( array $routes ){
        $this->routes = $routes;
    }
    
    protected function run( $url ) {
        array_walk($this->routes, function($routes) use($url){
            if( $url == $routes['route'] ){
                $class = "app\\controllers\\".ucfirst($routes['controller']);
                $controller = new $class;
                $controller->$routes['action']();
            }
        });
    }
    
    abstract protected function _initRoute();    
}
