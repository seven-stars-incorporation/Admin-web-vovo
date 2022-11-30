<?php
require_once("../models/ReceitaIngrediente.php");
require_once("../models/Receita.php");
require_once("../models/Ingrediente.php");
require_once("../models/Categoria.php");


$receita = new Receita();
$categoria = new Categoria();
$ingredienteClass = new Ingrediente();
$receitaIngrediente = new ReceitaIngrediente();

//IMAGEM
$nome = $_FILES['image']['name'];
$arquivo = $_FILES['image']['tmp_name'];
$caminho = "images/uploads/". time().".png";
move_uploaded_file($arquivo, "../".$caminho);

//CADASTRO DA RECEITA
$receita->setNomeReceita($_POST['nomeReceita']);
$receita->setTempoReceita($_POST['time']);
$receita->setModoPreparo($_POST['prepare']);
$IP = $_SERVER["HTTP_ORIGIN"];

$receita->setCaminhoImg("{$IP}/adm/".$caminho);

$lastID = $receita->cadastrar($receita); //ID QUE FOI CADASTRADO A RECEITA

//CADASTRAR CATEGORIA
$categoria->setDescCategoria($_POST['categoria']);
$categoria->setIdReceita($lastID);
$categoria->cadastrar($categoria);

//CADASTRO DOS INGREDIENTES
$ingrediente = $_POST['ingrediente'];
$ingredienteClass->setNomeIngrediente($ingrediente);
$ingredienteClass->setValorIngrediente($_POST['precoIngrediente']);

$receitaIngrediente->setIdReceita($lastID);

$receitaIngrediente->cadastrar($receitaIngrediente, $ingredienteClass);

foreach ($_POST as $key=>$value){
    $num = str_replace('ingrediente', '', $key);
    if (is_numeric($num)){
        $valor = $_POST['precoIngrediente'.$num];
        $ingredienteClass->setNomeIngrediente($value);
        $ingredienteClass->setValorIngrediente($valor);

        $receitaIngrediente->setIdReceita($lastID);

        $receitaIngrediente->cadastrar($receitaIngrediente, $ingredienteClass);
    }
}

header("location: ../views/Receitas.php?id={$lastID}");

