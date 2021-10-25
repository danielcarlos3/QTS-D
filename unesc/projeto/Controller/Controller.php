<?php


namespace Controller;


class Controller extends Database
{
    public static function loadView($path,$file,$data = NULL) {

        if (is_array($data) && count($data) > 0) {
            extract($data, EXTR_PREFIX_SAME, 'data'); //converte dados vindo de $data em variaveis
        }

        $view = $path . '/' . $file . '.php';

        if (!file_exists($view)) {
            self::error("Erro. A view '{$view}' não foi encontrada.");
        }

        require_once $view;
    }


    public static function error($msg) {
        throw new \Exception($msg);
    }


}

