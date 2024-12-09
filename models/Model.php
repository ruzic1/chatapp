<?php
    namespace models;

    class Model{
        protected \PDO $pdo;
        public function __construct(){
            $this->pdo=new \PDO("mysql:host=localhost;dbname=chatapp","root","");
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }
?>