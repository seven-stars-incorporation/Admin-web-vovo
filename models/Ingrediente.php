<?php
    require_once("../database/Conexao.php");

    class Ingrediente{
        private $idIngrediente, $valorIngrediente;
        private $nomeIngrediente;

        public function getIdIngrediente(){
            return $this->idIngrediente;
        }
        public function getNomeIngrediente(){
            return $this->nomeIngrediente;
        }
        public function setIdIngrediente($idIngrediente){
            $this->idIngrediente = $idIngrediente;
        }
        public function setNomeIngrediente($nomeIngrediente){
            $this->nomeIngrediente = $nomeIngrediente;
        }

        public function getValorIngrediente()
        {
            return $this->valorIngrediente;
        }

        public function setValorIngrediente($valorIngrediente)
        {
            $this->valorIngrediente = $valorIngrediente;
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

    }
?>