<?php


namespace Controller;

use Interfaces\ClienteInterface,
    PDO;



class Cliente extends Controller implements ClienteInterface
{
    private $name;
    private $email;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function novoCliente() {

        if(isset($_POST['Act'])) {
            /**
             * Inserir usuário no banco de dados
             */

            $cliente = self::getInstance();
            $sql  = "INSERT INTO `clientes` (`nome`, `logradouro`, `bairro` , `email`, `telefone`, `dtNasc`) VALUES (:name,:endereco ,:bairro,:email, :telefone, :dtNasc)";
            $stmt = $cliente->prepare($sql);
            $stmt->bindValue(':name',$_POST['name'],PDO::PARAM_STR);
            $stmt->bindValue(':endereco',$_POST['endereco'],PDO::PARAM_STR);
            $stmt->bindValue(':bairro',$_POST['bairro'],PDO::PARAM_STR);
            $stmt->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
            $stmt->bindValue(':telefone',$_POST['telefone'],PDO::PARAM_STR);
            $stmt->bindValue(':dtNasc',$_POST['dtNasc'],PDO::PARAM_STR);
            $result = $stmt->execute();

            if($result) {
                Common::redir('cliente/listar');
            } else {
                self::error('Erro ao inserir usuário no banco de dados :(');
            }
            exit;
        }
        self::loadView(PATH_TEMPLATE,'cliente/novoCliente');
    }

public function editar($id) {

        $user = self::getInstance();

        if(isset($_POST['Act1'])) {
            /**
             * Atualizar o banco de dados
             */

            $sql = 'UPDATE `clientes` SET `nome` = :nome , `logradouro` = :endereco , `bairro` = :centro , `email` = :email, `telefone` = :telefone, `dtnasc` = :dtNasc WHERE (`id` = :id);';
            $stm = $user->prepare($sql);
            $stm->bindValue(':nome',$_POST['name'],PDO::PARAM_STR);
            $stm->bindValue(':endereco',$_POST['endereco'],PDO::PARAM_STR);
            $stm->bindValue(':bairro',$_POST['bairro'],PDO::PARAM_STR);
            $stm->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
            $stm->bindValue(':telefone',$_POST['telefone'],PDO::PARAM_STR);
            $stm->bindValue(':dtNasc',$_POST['dtNasc'],PDO::PARAM_STR);
            $stm->bindValue(':id',$id,PDO::PARAM_INT);
            $result = $stm->execute();
            

            if($result){
                Common::redir('cliente/listar');
            }else{
                self::error('Erro ao editar Usuario no banco de dados :(');
            }

            exit;
        }

        $sql = 'select * from `clientes` where `id` = :id';
        $stm = $user->prepare($sql);
        $stm->bindValue(':id',$id,PDO::PARAM_INT);
        $stm->execute();
        $data = $stm->fetch();


        self::loadView(PATH_TEMPLATE,'cliente/edita', $data);

    }

    public function listar() {

        $user = self::getInstance();
        $result = $user->query("select `id`, `nome`, `logradouro`, `bairro`, `email`, `telefone`, date_format(`dtNasc`, '%d/%m/%Y') as `dtNasc`, status from clientes;");
        $result->execute();
        $data = $result->fetchAll(); //array

        self::loadView(PATH_TEMPLATE,'cliente/container',$data);

    }

    public function remover($id)
    {
        $user = self::getInstance();
        $sql = "DELETE FROM `clientes` WHERE id = :id";
        $stmt = $user->prepare($sql);
        $stmt->bindValue(':id',$id,PDO::PARAM_INT);
        $result = $stmt->execute();

        if($result) {
            Common::redir('Cliente/listar');
        } else {
            self::error('Erro ao deletar usuário no banco de dados :(');
        }

    }
    public function desativar($id){
        
        $user = self::getInstance();
        $sql = "UPDATE `clientes` SET `status` = 2 WHERE (`id` = :id);";
        $stmt = $user->prepare($sql);
        $stmt->bindValue(':id',$id,PDO::PARAM_INT);
        $result = $stmt->execute();

        if($result) {
            Common::redir('Cliente/listar');
        } else {
            self::error('Erro ao deletar usuário no banco de dados :(');
        }

    }

    public function ativar($id){

        $user = self::getInstance();
        $sql = "UPDATE `clientes` SET `status` = 1 WHERE (`id` = :id);";
        $stmt = $user->prepare($sql);
        $stmt->bindValue(':id',$id,PDO::PARAM_INT);
        $result = $stmt->execute();
        
        if($result) {
            Common::redir('Cliente/listar');
        } else {
            self::error('Erro ao deletar usuário no banco de dados :(');
        }
    }
     

   
    public function buscar(){

        $busca = $_POST['busca'];
        $optionBusca = $_POST['optionBusca'];
      
      
        $user = self::getInstance();
        $result = $user->query("select `id`, `nome`, `logradouro`, `bairro`, `email`, `telefone`, date_format(`dtNasc`, '%d/%m/%Y') as `dtNasc`, status from clientes where $optionBusca like '%$busca%';");
        $result->execute();
        $data = $result->fetchAll(); //array

       
        

       self::loadView(PATH_TEMPLATE,'cliente/container',$data);
            //exit;
       // }


        }
    
    
}