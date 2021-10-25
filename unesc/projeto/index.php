<?php
use Controller\Index,
    Controller\User;

require_once 'config/config.php'; //Inclusão de arquivo de configuração do projeto
require_once 'config/autoload.php'; //Inclusão de arquivo autoload classes

$url    = (isset($_GET['url'])) ? strip_tags($_GET['url']) : NULL; //Tratamento de URL, se vazio retorna NULO

$index = new Index($url); //Instancia o objeto index responsável por montar o layout