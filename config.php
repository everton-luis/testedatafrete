<?php

class Config{

    public $pdo;

    public function __construct(){
        try{
            $this->pdo = new PDO("mysql:dbname=testedatafrete;host=localhost","root","");
        }catch(PDOExcetion $e){
            echo "erro";
        }
    }

}



?>