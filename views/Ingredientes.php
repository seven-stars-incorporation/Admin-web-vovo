<?php

require_once('../models/Ingrediente.php');


$ingrediente = new Ingrediente();

$maisBaratos = $ingrediente->maisBaratos();
$ingredientes = $ingrediente->listar();
if (isset($_GET['id'])){
    $ingredientes = $ingrediente->listarId($_GET['id']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard da vovo</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
</head>
<body>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="../images/vovo.png" >
                    <h2 class="text-muted">Dicas da<span class="danger"> vovo</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-symbols-sharp">
                        close
                    </span>
                </div>
            </div>
            <!-- sidebar -->
            <div class="sidebar">
                <a href="Index.php" >
                    <span class="material-symbols-sharp">grid_view</span>
                    <h3>Geral</h3>
                </a>
                
                <a href="Receitas.php">
                    <span class="material-symbols-sharp">receipt_long</span>
                    <h3>Receitas</h3>
                </a>

                <a href="Ingredientes.php" class="active">
                    <span class="material-symbols-sharp">inventory</span>
                    <h3>Ingredientes</h3>
                </a>
            </div>
        </aside>
        <!-- fim da sidebar -->

        <main>
            <h1>Ingredientes</h1>

            <div class="insights-one" style='grid-template-columns: repeat(1, 1fr);'>
                <!-- graficos -->
                <div class="sales">
                    <span class="material-symbols-sharp">savings</span>
                        <div class="left">
                            <h3>Ingredientes Mais Barataos</h3>
                            <table id="column-example-14"
                                class="charts-css column show-labels show-primary-axis show-data-axes">
                                <thead>
                                    <tr>
                                        <th scope="col"> Year </th>
                                        <th scope="col"> Progress </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $html = "";
                                $last = count($maisBaratos)-1;
                                $max = intval($maisBaratos[$last]['valorIngrediente']);
                                
                                foreach ($maisBaratos as $ingredient){
                                    $porcent = intval($ingredient['valorIngrediente']) / $max;
                                    $html .= "<tr>
                                                <th scope='row'><a href='Ingredientes.php?id={$ingredient['idIngrediente']}'>{$ingredient['idIngrediente']}</a></th>
                                                <td style='--size:{$porcent}'>{$ingredient['valorIngrediente']}</td>
                                            </tr>
                                            ";
                                }

                                echo $html;
                                ?>
                                </tbody>
                            </table>
                        </div>
                    
                </div>

                
                <!-- fim dos graficos -->
            </div>

            <div class="recent-ingredients" style="display: flex; flex-direction: column; align-items: center;">
                <h2>Ingredientes Cadastrados</h2>
                <table>
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nome</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $html = "";

                        foreach($ingredientes as $ingrediente){
                            $html .= "<tr>
                                        <td>{$ingrediente['idIngrediente']}</td>
                                        <td>{$ingrediente['nomeIngrediente']}</td>
                                        <td>R\${$ingrediente['valorIngrediente']}</td>
                                    </tr>
                                    ";
                        }

                        echo $html;
                        ?>
                        
                    </tbody>
                </table>
                <a href="Ingredientes.php">Mostrar todos</a>
            </div>
        </main>
        <!-- fim da secao principal -->
    </div>

    <script src="js/Index.js"></script>
</body>
</html>
