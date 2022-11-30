<?php
require_once("../database/Conexao.php");


class Pesquisa{
    private $idpesquisa, $idreceita, $dataPesquisa;

    /**
     * @return mixed
     */
    public function getIdpesquisa()
    {
        return $this->idpesquisa;
    }

    /**
     * @param mixed $idpesquisa
     */
    public function setIdpesquisa($idpesquisa)
    {
        $this->idpesquisa = $idpesquisa;
    }

    /**
     * @return mixed
     */
    public function getIdreceita()
    {
        return $this->idreceita;
    }

    /**
     * @param mixed $idreceita
     */
    public function setIdreceita($idreceita)
    {
        $this->idreceita = $idreceita;
    }

    /**
     * @return mixed
     */
    public function getDataPesquisa()
    {
        return $this->dataPesquisa;
    }

    /**
     * @param mixed $dataPesquisa
     */
    public function setDataPesquisa($dataPesquisa)
    {
        $this->dataPesquisa = $dataPesquisa;
    }

    public function getTop5(){
        $con = Conexao::conectar();
        $querySelect = "SELECT COUNT(idpesquisa) AS `quant`, idreceita FROM tbpesquisa
                        GROUP BY idreceita 
                        ORDER BY COUNT(idpesquisa) DESC
                        LIMIT 5;";
        $resultado = $con->query($querySelect);
        $lista = $resultado->fetchAll();
        return $lista;
    }
}