<?php

namespace Controller;

use Interfaces\UserInterface,
    PDO;

class User extends Controller implements UserInterface
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


    public function novo() {

       if(isset($_POST['Act'])) {
           /**
            * Inserir usuário no banco de dados
            */

           $user = self::getInstance();
           $sql  = "INSERT INTO `user` (`name`,`email`) VALUES (:name,:email)";
           $stmt = $user->prepare($sql);
           $stmt->bindValue(':name',$_POST['name'],PDO::PARAM_STR);
           $stmt->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
           $result = $stmt->execute();

           if($result) {
                Common::redir('User/listar');
           } else {
               self::error('Erro ao inserir usuário no banco de dados :(');
           }
           exit;
       }
        self::loadView(PATH_TEMPLATE,'user/novo');
    }

    public function editar($id) {

        $user = self::getInstance();

        if(isset($_POST['Act'])) {
            /**
             * Atualizar o banco de dados
             */

           $sql = 'UPDATE `user` SET `name` = :name , `email` = :email where `id` = :id';
            $stm = $user->prepare($sql);
            $stm->bindValue(':name',$_POST['name'],PDO::PARAM_STR);
            $stm->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
            $stm->bindValue(':id',$id,PDO::PARAM_INT);
            $result = $stm->execute();

    

            if($result){
                Common::redir('User/listar');
            }else{
                self::error('Erro ao editar Usuario no banco de dados :(');
            }


            exit;
        }

        $sql = 'select * from `user` where `id` = :id';
        $stm = $user->prepare($sql);
        $stm->bindValue(':id',$id,PDO::PARAM_INT);
        $stm->execute();
        $data = $stm->fetch();


   self::loadView(PATH_TEMPLATE,'user/edita', $data);

    }

    public function listar() {

       $user = self::getInstance();
       $result = $user->query("SELECT * FROM `user`");
       $result->execute();
       $data = $result->fetchAll(); //array

       self::loadView(PATH_TEMPLATE,'user/container',$data);

    }

    public function remover($id)
    {
        $user = self::getInstance();
        $sql = "DELETE FROM `user` WHERE id = :id";
        $stmt = $user->prepare($sql);
        $stmt->bindValue(':id',$id,PDO::PARAM_INT);
        $result = $stmt->execute();

        if($result) {
            Common::redir('User/listar');
        } else {
            self::error('Erro ao deletar usuário no banco de dados :(');
        }

    }

    public function buscar() {

        if(isset($_POST['Act'])) {
            /**
             * Inserir usuário no banco de dados
             */
 
            $user = self::getInstance();
            $sql  = "INSERT INTO `user` (`name`,`email`) VALUES (:name,:email)";
            $stmt = $user->prepare($sql);
            $stmt->bindValue(':name',$_POST['name'],PDO::PARAM_STR);
            $stmt->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
            $result = $stmt->execute();
 
            if($result) {
                 Common::redir('User/listar');
            } else {
                self::error('Erro ao inserir usuário no banco de dados :(');
            }
            exit;
        }
         self::loadView(PATH_TEMPLATE,'user/novo');
     }
 
}