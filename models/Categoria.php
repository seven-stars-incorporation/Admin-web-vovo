<?php
    require_once("../database/Conexao.php");

    class Categoria{
        private $idCategoria, $descCategoria;
        private $idReceita;

        public function getIdReceita(){
            return $this->idReceita;
        }
        public function getDescCategoria(){
            return $this->descCategoria;
        }
        public function setIdReceita($idReceita){
            $this->idReceita = $idReceita;
        }
        public function setNomeIngrediente($nomeIngrediente){
            $this->nomeIngrediente = $nomeIngrediente;
        }

        public function getValorIngrediente()
        {
            return $this->valorIngrediente;
        }

        public function setDescCategoria($descCategoria)
        {
            $this->descCategoria = $descCategoria;
        }

        public function count(){
            $con = Conexao::conectar();
            $querySelect = "SELECT COUNT(idingrediente) FROM tbingrediente";
            $resultado = $con->query($querySelect);
            $lista = $resultado->fetchAll();
            return $lista;
        }

        public function listar(){
            $con = Conexao::conectar();
            $querySelect = "SELECT * FROM tbingrediente";
            $resultado = $con->query($querySelect);
            $lista = $resultado->fetchAll();
            return $lista;
        }

        public function listarId($id){
            $con = Conexao::conectar();
            $querySelect = "SELECT * FROM tbingrediente WHERE idIngrediente = " . $id;
            $resultado = $con->query($querySelect);
            $lista = $resultado->fetchAll();
            return $lista;
        }

        public function maisBaratos(){
            $con = Conexao::conectar();
            $querySelect = "SELECT tbingrediente.idIngrediente, tbingrediente.nomeIngrediente, tbingrediente.valorIngrediente FROM tbingrediente 
                            WHERE tbingrediente.valorIngrediente != 0.0
                            ORDER BY valorIngrediente
                            LIMIT 10;";
            $resultado = $con->query($querySelect);
            $lista = $resultado->fetchAll();
            return $lista;
        }

        public function cadastrar($categoria){
            $con = Conexao::conectar();
            $stmt = $con->prepare("INSERT INTO `tbcategoria`(`idReceita`, `descCategoria`) VALUES (?, ?)");
            $stmt->bindValue(1, $categoria->getIdReceita());
            $stmt->bindValue(2, $categoria->getDescCategoria());
            $stmt->execute();
            $lastID = "SELECT LAST_INSERT_ID()";
            $result = $con->query($lastID);
            return $result->fetchAll()[0][0];
        }

    }
?>