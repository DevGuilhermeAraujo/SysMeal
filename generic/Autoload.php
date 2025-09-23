<?php

spl_autoload_register(function($class_name) {
    $directories = [ 
        '',
        'generic/',
        'controller/',
        'service/',
        'dao/',
        'model/',
        'template/'
    ];
    foreach($directories as $directory) {
        $file = $directory . $class_name . '.php';

        if(file_exists($file)) {
            require_once $file;
            return;
        }
    }
    // Se chegou até aqui, a classe não foi encontrada
    throw new Exception("Classe '$class_name' não encontrada");

});
