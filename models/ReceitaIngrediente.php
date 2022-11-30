<?php
require_once("../database/Conexao.php");

class ReceitaIngrediente
{
    private $idReceitaIgrediente, $idReceita, $unidadeIngrediente, $idIngrediente;


    public function getIdReceitaIgrediente()
    {
        return $this->idReceitaIgrediente;
    }

    public function setIdReceitaIgrediente($idReceitaIgrediente)
    {
        $this->idReceitaIgrediente = $idReceitaIgrediente;
    }


    public function getIdReceita()
    {
        return $this->idReceita;
    }


    public function setIdReceita($idReceita)
    {
        $this->idReceita = $idReceita;
    }



    public function getIdIngrediente()
    {
        return $this->idIngrediente;
    }


    public function setIdIngrediente($idIngrediente)
    {
        $this->idIngrediente = $idIngrediente;
    }


    public function cadastrar($receitaIngrediente, $ingrediente)
    {
        $con = Conexao::conectar();
        $stmt = $con->prepare("CALL cadastrar_receitaIngrediente(?,?,?)");
        $stmt->bindValue(1, $receitaIngrediente->getIdReceita());
        $stmt->bindValue(2, $ingrediente->getNomeIngrediente());
        $stmt->bindValue(3, $ingrediente->getValorIngrediente());
        $stmt->execute();
    }

    private function searchIdRecipeWithIngredient($ingredientID)
    {
        $con = Conexao::conectar();
        $querySelect = "SELECT idReceita FROM tbreceitaingrediente
                            WHERE idIngrediente LIKE " . $ingredientID;
        $result = $con->query($querySelect);
        $list = $result->fetchAll();
        return $list;
    }

    private function searchRecipeWithId($id)
    {
        $con = Conexao::conectar();
        $querySelect = "SELECT tbreceita.*, nomeIngrediente, valorIngrediente FROM tbreceitaingrediente
                            INNER JOIN tbingrediente ON tbreceitaingrediente.idIngrediente = tbingrediente.idIngrediente
                            INNER JOIN tbreceita on tbreceitaingrediente.idReceita = tbreceita.idReceita
                            WHERE tbreceitaingrediente.idReceita LIKE " . $id . " GROUP BY tbreceita.idReceita";
        $result = $con->query($querySelect);
        $list = $result->fetchAll();
        return $list;
    }

    public function listarIngredientePRecita($idReceita)
    {
        $con = Conexao::conectar();
        $querySelect = "SELECT nomeIngrediente, valorIngrediente FROM tbreceitaingrediente
                            INNER JOIN tbingrediente ON tbreceitaingrediente.idIngrediente = tbingrediente.idIngrediente
                            WHERE tbreceitaingrediente.idReceita LIKE " . $idReceita;
        $result = $con->query($querySelect);
        $list = $result->fetchAll();
        return $list;
    }

    public function listarPIngrediente($idIngrediente)
    {
        $listRecipe = array();
        $list = $this->searchIdRecipeWithIngredient($idIngrediente);
        foreach ($list as $id){
            $id = $id[0];
            $tempListRecipe = $this->searchRecipeWithId($id);
            $listRecipe = array_merge($listRecipe, $tempListRecipe);
        }

        return $listRecipe;
    }
}
