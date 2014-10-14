<?php

namespace app\controllers;
use son\controller\Action,
    son\di\Container;


class Index extends Action {
    
    public function index(){
        $article = Container::getClass("article");
        $this->view->artigo = $article->fetchAll();        
        $this->render("index");
    }
    
}
