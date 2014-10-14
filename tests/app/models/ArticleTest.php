<?php

use son\di\Container;

class ArticleTest extends PHPUnit_Framework_TestCase {
    
    private $model;
    
    public function setUp(){
        $this->model = Container::getClass('article');

        $db = new \PDO("mysql:host=localhost;dbname=phptdd","root","root");
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $db->exec("truncate table article");
    }

    public function testVerificaTipoDeObjeto(){
        $this->assertInstanceOf("app\models\Article", $this->model);
    }

    public function testVerificaSeConsegueInserirRegistro(){
        $data['nome'] = "Brasil zuado";        
        $data['descricao'] = "será que ganha contra a Holanda???";

        $this->assertEquals(1, $this->model->save($data));
        $this->assertEquals(2, $this->model->save($data));
    }

    /**
    *@depends testVerificaSeConsegueInserirRegistro
    */
    public function testVerificaSeConsegueAlterarRegistro(){
        $data['nome'] = "Brasil zuado";        
        $data['descricao'] = "será que ganha contra a Holanda???";
        $this->model->save($data);

        $data["id"] = 1;
        $data["nome"] = "Alemanha legal!";
        $data['descricao'] = "com certeza ganha";
        $this->assertEquals(1, $this->model->save($data));
    }

    public function testVerificaSeConsegueSelecionarAlgumRegistro(){
        $data['nome'] = "Artigo teste";        
        $data['descricao'] = "Descrição artigo teste";
        $this->model->save($data);

        $data['nome'] = "Artigo teste 2";
        $data['descricao'] = "Descrição artigo teste 2";
        $this->model->save($data);

        $this->assertEquals("Artigo teste", $this->model->find(1)['nome']);
        $this->assertEquals("Artigo teste 2", $this->model->find(2)['nome']);
    }

    public function testVerificaSeConsegueRemoverAlgumRegistro(){        
        $data['nome'] = "Artigo teste";        
        $data['descricao'] = "Descrição artigo teste";
        $this->model->save($data);
        
        $this->assertTrue($this->model->delete(1));   
    }

    public function testVerificaSeConsegueListarRegistros(){        
        $data['nome'] = "Artigo teste";        
        $data['descricao'] = "Descrição artigo teste";
        $this->model->save($data);

        $data['nome'] = "Artigo teste 2";
        $data['descricao'] = "Descrição artigo teste 2";
        $this->model->save($data);
        
        $this->assertEquals("Artigo teste", $this->model->fetchAll()[0]['nome']);
        $this->assertEquals("Artigo teste 2", $this->model->fetchAll()[1]['nome']);
    }

    public function tearDown(){

    }

}