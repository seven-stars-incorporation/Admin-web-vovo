<?php
require_once('models/Receita.php');


$receita = new Receita();

$maisBaratas = $receita->maisBaratas();
$com3 = $receita->com3();
$menosTempo = $receita->menosTempo();
$receitas = $receita->listar();
if (isset($_GET['id'])){
    $receitas = $receita->listarId($_GET['id']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard da vovo</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="./images/vovo.png">
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
                <a href="/dashboard-admin/Index.php">
                    <span class="material-symbols-sharp">grid_view</span>
                    <h3>Geral</h3>
                </a>
            
                <a href="/dashboard-admin/Receitas.php" class="active">
                    <span class="material-symbols-sharp">receipt_long</span>
                    <h3>Receitas</h3>
                </a>

                <a href="/dashboard-admin/Ingredientes.php">
                    <span class="material-symbols-sharp">inventory</span>
                    <h3>Ingredientes</h3>
                </a>

                <!-- <a href="/dashboard-admin/Categorias.php">
                    <span class="material-symbols-sharp">category</span>
                    <h3>Categorias</h3>
                </a> -->
            </div>
        </aside>
        <!-- fim da sidebar -->

        <main>
            <h1>Dashboard</h1>

            <div class="insights">
                <!-- grafio de ingredientes -->
                <div class="sales">
                    <span class="material-symbols-sharp">currency_exchange</span>
                    <div class="left">
                        <h3>Receitas mais baratas</h3>
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
                                $last = count($maisBaratas)-1;
                                $max = intval($maisBaratas[$last]['soma']);
                                
                                foreach ($maisBaratas as $recipe){
                                    $soma = round($recipe['soma'], 2);
                                    $porcent = intval($recipe['soma']) / $max;
                                    $html .= "<tr>
                                                <th scope='row'><a href='Receitas.php?id={$recipe['idReceita']}'>{$recipe['idReceita']}</a></th>
                                                <td style='--size:{$porcent}'>R\${$soma}</td>
                                            </tr>
                                            ";
                                }

                                echo $html;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    
                </div>

                <div class="ingredients-total">
                    <span class="material-symbols-sharp">category</span>
                    <div class="left">
                        <h3>Com ate 3 ingredientes</h3>
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
                                $max = 3;
                                
                                foreach ($com3 as $recipe){
                                    $porcent = intval($recipe['cont']) / $max;
                                    $html .= "<tr>
                                                <th scope='row'><a href='Receitas.php?id={$recipe['idReceita']}'>{$recipe['idReceita']}</a></th>
                                                <td style='--size:{$porcent}'>{$recipe['cont']}</td>
                                            </tr>
                                            ";
                                }

                                echo $html;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    
                </div>

                <div class="ingredients-total-search">
                    <span class="material-symbols-sharp">timer</span>
                    <div class="left">
                        <h3>Menos Tempo de fogo</h3>
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
                                $last = count($menosTempo)-1;
                                $max = intval($menosTempo[$last]['tempoReceita']);
                                
                                foreach ($menosTempo as $recipe){
                                    $porcent = intval($recipe['tempoReceita']) / $max;
                                    $html .= "<tr>
                                                <th scope='row'><a href='Receitas.php?id={$recipe['idReceita']}'>{$recipe['idReceita']}</a></th>
                                                <td style='--size:{$porcent}'>{$recipe['tempoReceita']}</td>
                                            </tr>
                                            ";
                                }

                                echo $html;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <!-- fim do grafico de ingredientes -->
            </div>
            <!-- fim dos insights -->

            <!-- <div class="recent-ingredients">
                <h2> Ingredientes Recentes</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>pinto de borracha</td>
                        </tr>
                        <tr>
                            <td>pinto de borracha</td>
                        </tr> BUCETA
                    </tbody>
                </table>
                <a href="">Mostrar Todos</a>
            </div> -->

            <div class="recent-ingredients" style="display: flex; flex-direction: column; align-items: center;">
                <h2>Receitas</h2>
                <table class="styled-table" style="width: 50%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $html = "";

                        foreach($receitas as $receita){
                            $html .= "<tr>
                                        <td>{$receita['idReceita']}</td>
                                        <td><a target='_blank' href='https://b3c3-2804-7f0-b901-4142-14a2-b5a-80be-2b70.sa.ngrok.io/web-vovo/src/views/detalhes-receita.php?id={$receita['idReceita']}'>{$receita['nomeReceita']}</a></td>
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
            <div class="analytics-ingredients">
                <div class="item add-something">
                    <div>
                        <span class="material-symbols-sharp">add</span>
                        <button class="btn" onclick="openModal('dv-modal')">Adicionar Receitas</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <dialog id="dv-modal" class="modal">
        <div class="form-register">
            <form action="Receitas.php" method="post">

                <h1>Cadastrar Receita</h1>

                <fieldset>
                    <legend><span class="number">1</span>Informacoes da receita</legend>
                    <label for="name">Nome</label>
                    <input type="text" id="name" name="name">

                    <label for="price">Custo Aproximado</label>
                    <input type="number" id="price" name="price" placeholder="$">


                    <label for="bio">Ingredientes</label>
                    <textarea id="bio" name="prepare"></textarea>

                    <label for="job">Categoria</label>
                    <input type="text" id="category" name="category">
                </fieldset>

                <fieldset>
                    <legend><span class="number">2</span>Preparo</legend>
                    <label for="bio">Modo de preparo</label>
                    <textarea id="bio" name="prepare"></textarea>

                    <label for="time">Tempo De Preparo</label>
                    <input type="number" id="time" name="time" placeholder="em minutos">
                </fieldset>
                <fieldset>

                </fieldset>
                <button type="submit" class="btn-register">Cadastrar</button>
            </form>
            <div class="modal-footer">
                <button class="btn-close" onclick="closeModal('dv-modal')">Fechar</button>
            </div>
        </div>
    </dialog>

    <script src="js/Index.js"></script>
</body>

</html>