<?php

spl_autoload_register(function ($classe) {

    //var_dump($classe); Verificar path(caminho) da instãncia da classe

    $file = $classe . '.php'; //Concatenando extenção do arquivo php

    if (file_exists($file)) {
        include $file;
    }
});
