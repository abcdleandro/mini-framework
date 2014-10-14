<?php

namespace son\db;
use son\di\Container;

abstract class Table {
    
    protected $db;
    protected $table;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function fetchAll(){
        $query = " SELECT * FROM " . $this->table;
        return $this->db->query($query);
    }
    
    abstract public function _insert( array $data );
    abstract public function _update( array $data );
    
    public function save( array $data ){
        if( isset($data['id']) )
            $this->_update ($data);
        else
            $this->_insert ($data);
    }
    
    public function delete( $id ){
        $query = " DELETE FROM " . $this->table . " WHERE id= " . (int) $id;
        return $this->db->query($query);
    }
    
}
