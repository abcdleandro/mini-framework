<?php

use son\di\Container;

class ExemploTest extends PHPUnit_Framework_TestCase {
    
    private $model;
    
    public function setUp(){
        $this->model = Container::getClass('exemplo');
    }
    
    public function testVerificaTipoDeObjeto(){
        $this->assertInstanceOf("app\models\Exemplo", $this->model);
    }
    
    public function testVerificaSePodeSomar(){        
        $this->assertEquals(2,  $this->model->somar(1,1));
        $this->assertEquals(3,  $this->model->somar(1,2));
    }
    
    public function testVerificaSeAsEntradasSaoNumeros(){
        try {
            $this->model->somar(1,'a');
            $this->model->somar('a','a');
            $this->model->somar('a',1);
        } catch (Exception $ex) {
            $this->assertEquals('Valor passado não é númerico!', $ex->getMessage());
        }        
    }
    
}
