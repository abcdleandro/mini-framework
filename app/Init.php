<?php

namespace app;

use son\init\Bootstrap;

class Init extends Bootstrap{    
    
    public function _initRoute(){
        $arr['xpto'] = ['route' => '/xpto', 'controller' => 'xpto', 'action'=>'index'];
        $arr['home'] = ['route' => '/', 'controller' => 'index', 'action'=>'index'];
        $this->setRoutes($arr);
    }
}
