<?php

    //include('../lib/config.php');
    

    class artigoBO1 extends Config{
        
    
        public function GetAll(){

            $array = array();
            $sql = "select * from artigos";
            $sql = $this->pdo->query($sql);
            if($sql->rowCount() > 0){
                $array = $sql->fetchAll();
            }

            return $array;

        }

        public function Add($titulo,$descricao,$capa,$imagem){

            $sql = "insert into artigos (titulo,descricao,capa,imagem) values (:titulo,:descricao,:capa,:imagem)";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(":titulo",$titulo);
            $sql->bindValue(":descricao",$descricao);
            $sql->bindValue(":capa",$capa);
            $sql->bindValue(":imagem",$imagem);
            $sql->execute();
        }

        public function Get($id){

            
            $sql = "select * from artigos where id=:id";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(":id",$id);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $sql = $sql->fetch();

                return $sql;
                
            } else {
                return '';
            }

            

        }

        public function Update($titulo,$descricao,$id){
            $sql = "update artigos set titulo=:titulo, descricao=:descricao where id=:id";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(":titulo",$titulo);
            $sql->bindValue(":descricao",$descricao);
            $sql->bindValue(":id",$id);
            $sql->execute();
            
        }

        public function Del($id){
            $sql = "delete from artigos where id=:id";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(":id",$id);
            $sql->execute();
        }



        

    }



    //$var1 = new artigoBO1();

    

    //$lista = $var1->listar();

    //foreach($lista as $item){
        //echo $item['id'];
    //}





?>