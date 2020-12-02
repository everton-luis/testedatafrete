<?php

    include('config.php');
    

    class Functions extends Config{

        public function GetAllCeps(){
            $array = array();
            $sql = " select * from ceps ";
            $sql = $this->pdo->query($sql);
            if($sql->rowCount() > 0){
                $array = $sql->fetchAll();
            }

            return $array;
        }

        public function InserirCep($altitude,$cep,$latitude,$longitude,$logradouro,$bairro,$cidade,$estado){
            $sql = "insert into ceps set altitude='$altitude', cep = '$cep', latitude='$latitude', 
                        longitude= '$longitude', logradouro='$logradouro', bairro='$bairro', cidade='$cidade', estado='$estado' ";
            $sql = $this->pdo->query($sql);    
        }

        public function VerificarCep($cep){
            $sql = " select * from ceps where cep='$cep' ";
            $sql = $this->pdo->query($sql);
            if($sql->rowCount() > 0){
                return true;
            }else{
                return false;
            }

        }

        public function GetCep($id){
            $sql = "select * from ceps where id=$id";
            $sql = $this->pdo->query($sql);
            if($sql->rowCount() > 0) {
                $sql = $sql->fetch();

                return $sql;
                
            } else {
                return '';
            }
        }

        public function GetCep1($cep){
            $sql = " select * from ceps where cep='$cep' ";
            $sql = $this->pdo->query($sql);
            if($sql->rowCount() > 0){
                $sql = $sql->fetch();

                return $sql;
            }else{
                return '';
            }

        }

        public function CadastrarViagem($ceporigem,$cepdestino,$distancia){
            $sql = "insert into viagens set ceporigem_id='$ceporigem', cepdestino_id='$cepdestino', 
                    distancia='$distancia', hora_cadastro=NOW(), hora_alteracao='' ";

            $sql = $this->pdo->query($sql);
        }

        public function ListagemViagens(){
            $array = array();
            $sql = "select viagens.id, viagens.ceporigem_id, viagens.cepdestino_id, viagens.distancia, viagens.hora_cadastro, 
                    viagens.hora_alteracao, ceps.cep as cep_origem, (select ceps.cep from ceps where 
                    viagens.cepdestino_id = ceps.id) as cep_destino from viagens inner JOIN ceps on viagens.ceporigem_id = ceps.id";
            
            $sql = $this->pdo->query($sql);
            if($sql->rowCount() > 0){
                $array = $sql->fetchAll();
            }

            return $array;
        }

        public function GetIdViagem($id){
            $sql = "select * from viagens where id='$id'";
            $sql = $this->pdo->query($sql);
            if($sql->rowCount() > 0){
                $sql = $sql->fetch();

                return $sql;
            }else{
                return '';
            }
        }

        public function UpdateViagem($ceporigemid, $cepdestinoid,$distancia,$idviagem){
            $sql = "update viagens set ceporigem_id='$ceporigemid', cepdestino_id='$cepdestinoid', 
                    distancia='$distancia', hora_alteracao=NOW() where id='$idviagem' ";
            
            $sql = $this->pdo->query($sql);
        }

        public function DeletarViagem($id){
            $sql = "delete from viagens where id='$id'";
            $sql = $this->pdo->query($sql);
        }


    }







?>