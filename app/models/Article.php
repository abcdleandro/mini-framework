<?php

namespace app\models;
//use son\db\Table;

//class ".$this->table." extends Table {
class Article {
    
    protected $table = "article";
    protected $db;    
    
    public function __construct( $db ){
    	$this->db = $db;    	
    }

    /*
    public function _insert(array $data) {
        return "";
    }
    
    public function _update(array $data) {
        return "";
    }
    */

    protected function _insert( array $data ){
    	$pdo = $this->db->prepare( " INSERT INTO ".$this->table." (nome, descricao) VALUES(:nome, :descricao) " );
    	$pdo->bindParam(":nome", $data['nome']);
    	$pdo->bindParam(":descricao", $data['descricao']);
    	$pdo->execute();
    	return $this->db->lastInsertId();
    }

    protected function _update( array $data ){
    	$pdo = $this->db->prepare( " UPDATE ".$this->table." SET nome = :nome, descricao = :descricao WHERE id = :id " );
    	$pdo->bindParam(":id", $data['id']);
    	$pdo->bindParam(":nome", $data['nome']);
    	$pdo->bindParam(":descricao", $data['descricao']);
    	$pdo->execute();
    	return $data['id'];
    }

    public function save( array $data ){
    	if( !isset($data["id"]) ){
	 		return $this->_insert($data);
	    }else{
	    	return $this->_update($data);
	    }
    }

    public function find( $id ){
    	$pdo = $this->db->prepare( " SELECT * FROM ".$this->table." WHERE id = :id " );
    	$pdo->bindParam(":id", $id);
    	$pdo->execute();
    	return $pdo->fetch();
    }

    public function delete( $id ){
    	$pdo = $this->db->prepare( " DELETE FROM ".$this->table." WHERE id = :id " );
    	$pdo->bindParam(":id", $id);    	
    	$pdo->execute();
    	return true;
    }

    public function fetchAll(){
    	$pdo = $this->db->prepare( " SELECT * FROM ".$this->table." " );    	   	
    	$pdo->execute();
    	return $pdo->fetchAll();
    }
}