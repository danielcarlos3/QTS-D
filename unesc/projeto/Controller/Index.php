<?php
namespace Controller;

class Index extends Controller
{
    private $class;
    private $action;
    private $post;

    public function __construct($url) {

        /**
         * Tratamento de URL: Recebe a URL e explode para uso de 03 parâmetros: classe, ação e post
         */

        $qString      = explode('/', $url);
        $this->class  = (isset($qString[0]) AND !empty($qString[0])) ? $qString[0] : '';
        $this->action = (isset($qString[1]) AND !empty($qString[1])) ? $qString[1] : 'listar';
        $this->post   = (isset($qString[2]) AND !empty($qString[2])) ? $qString[2] : '';

        if(empty($this->class)) {

            self::loadView(PATH_TEMPLATE,'index/container');

        } else {
           // echo $this->class;
            $this->class = __NAMESPACE__ . '\\' . $this->class;
            call_user_func(array($this->class,$this->action),$this->post); //Ler sobre a função call_user_func


        }
    }


}