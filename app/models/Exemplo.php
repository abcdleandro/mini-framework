<?php

namespace app\models;

class Exemplo {
    
    public function somar($x,$y){
        if( is_numeric($x) and is_numeric($y) )
            return $x+$y;
        else
            throw new \Exception('Valor passado não é númerico!');
    }
    
}
