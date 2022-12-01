<?php

require_once('../models/Ingrediente.php');
require_once('../models/Pesquisa.php');
require_once('../models/Receita.php');

$ingrediente = new Ingrediente();
$pesquisa = new Pesquisa();
$receita = new Receita();

$addRecente = $receita->read_recent();
$top5 = $pesquisa->getTop5();
$quantIngredientes = $ingrediente->count()[0][0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard dicas da vovo</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="../images/vovo.png">
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
                <!-- active -->
                <a href="Index.php" class="active">
                    <span class="material-symbols-sharp">grid_view</span>
                    <h3>Geral</h3>
                </a>
                <a href="Receitas.php">
                    <span class="material-symbols-sharp">receipt_long</span>
                    <h3>Receitas</h3>
                </a>
                <a href="Ingredientes.php">
                    <span class="material-symbols-sharp">inventory</span>
                    <h3>ingredientes</h3>
                </a>        
            </div>
        </aside>
        <!-- fim da sidebar -->

        <main>
            <h1>Dashboard</h1>

            <div class="insights-centered">
                <!-- graficos -->
                <div class="sales">
                    <span class="material-symbols-sharp">analytics</span>
                    <div>
                        <div class="left">
                            <h3>Capacidade total de pesquisa</h3>
                            <h1><?php echo $quantIngredientes;?></h1>
                        </div>
                    </div>
                    <small class="text-muted">Baseado nos Ingredientes</small>
                </div>

                <div class="ingredients-total-search">
                    <span class="material-symbols-sharp">stacked_line_chart</span>
                    <div>
                        <div class="left">
                            <h3>Receitas mais pesquisadas</h3>
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
                                $max = intval($top5[0]['quant']);
                                foreach ($top5 as $recipe){
                                    $porcent = intval($recipe['quant']) / $max;
                                    $html .= "<tr>
                                                <th scope='row'><a href='Receitas.php?id={$recipe['idreceita']}'>{$recipe['idreceita']}</a></th>
                                                <td style='--size:{$porcent}'>{$recipe['quant']}</td>
                                            </tr>
                                            ";
                                }

                                echo $html;
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- fim dos graficos -->
            </div>
            <!-- fim dos insights -->

            <div class="recent-ingredients" style="display: flex; flex-direction: column; align-items: center;">
                <h2>Receitas Adicionadas Recentemente</h2>
                <table>
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $html = "";

                        foreach($addRecente as $receita){
                            $html .= "<tr>
                                        <td>{$receita['idReceita']}</td>
                                        <td>{$receita['nomeReceita']}</td>
                                    </tr>
                                    ";
                        }

                        echo $html;
                        ?>
                        
                    </tbody>
                </table>
                <a href="Receitas.php">Mostrar todos</a>
            </div>
        </main>
        <!-- fim da secao principal -->

        <div class="right">
            <!-- fim do perfil do admin -->
            <div class="status-web-scraping">
                <h2>Busca Automatica</h2>
                <div class="status-search">
                    <div class="search-auto">
                        <div class="message">
                            <p><b>Status do Serviço De Busca Automatica</b></p>
                            <br>
                            <div class="theme-toggler">
                                <span class="material-symbols-sharp active">power_rounded</span>
                                <span class="material-symbols-sharp">power_off</span>
                            </div>
                            <p><b></b></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fim do status de servico -->
        </div>
    </div>

    <script src="js/Index.js"></script>
</body>

</html>
