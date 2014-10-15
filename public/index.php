<?php

    require_once '../vendor/SplClassLoader.php';
        
    $classloader = new SplClassLoader('son','../vendor');
    $classloader->register();
    
    $classloader = new SplClassLoader('app','../');
    $classloader->register();
    
    $bootstrap = new app\Init;


    
    

    
