<?php

namespace son\controller;

abstract class Action {
    
    protected $action;
    protected $view;


    public function __construct() {
        $this->view = new \stdClass();
    }
    
    protected function render($view, $layout=true){        
        $this->action = $view;
        $layoutPath = '../app/views/layout.phtml';
        if( $layout == true && file_exists($layoutPath) )
            include_once $layoutPath;
        else
            $this->content($view);        
    }
    
    protected function content(){
        $currentClass    = get_class($this);
        $singleClassName = strtolower( str_replace("app\\controllers\\", "", $currentClass) );
        include_once '../app/views/'.$singleClassName.'/'.$this->action.'.phtml';
    }
    
}
