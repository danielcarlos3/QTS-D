<?php
namespace Interfaces;

interface ClienteInterface
{
    public function getName();
    public function setName($name);
    public function getEmail();
    public function setEmail($email);
    public function listar();
    public function novoCliente();
    public function editar($id);
    public function remover($id);

}