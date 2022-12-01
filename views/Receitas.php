<?php
require_once('../models/Receita.php');


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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
                <a href="Index.php">
                    <span class="material-symbols-sharp">grid_view</span>
                    <h3>Geral</h3>
                </a>

                <a href="Receitas.php" class="active">
                    <span class="material-symbols-sharp">receipt_long</span>
                    <h3>Receitas</h3>
                </a>

                <a href="Ingredientes.php">
                    <span class="material-symbols-sharp">inventory</span>
                    <h3>Ingredientes</h3>
                </a>
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

            <div class="recent-ingredients" style="display: flex; flex-direction: column; align-items: center;">
                <h2>Receitas</h2>
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

                        foreach($receitas as $receita){
                            $html .= "<tr>
                                        <td>{$receita['idReceita']}</td>
                                        <td><a target='_blank' href='http://127.0.0.1:8080/web-vovo/src/views/detalhes-receita.php?id={$receita['idReceita']}'>{$receita['nomeReceita']}</a></td>
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

    <div id="dv-modal" class="modal">
        <div class="form-register">
            <form enctype="multipart/form-data" action="../controllers/cadastrar_receita.php" method="post">

                <h1>Cadastrar Receita</h1>

                <fieldset>
                    <legend><span class="number">1</span>Informacoes da receita</legend>
                    <label>Nome Receita</label>
                    <input type="text" required name="nomeReceita" placeholder="Insira o nome da Receita">
                    <label>Categoria</label>
                    <input type="text" required name="categoria" placeholder="Insira o nome da Categoria">
                    <label>Nome do Ingrediente</label>
                    <input type="text" required id="ingrediente" name="ingrediente" placeholder="Insira o nome do ingrediente">

                    <label>Preco do ingrediente</label>
                    <input type="number" required step=".01" id="precoIngrediente" name="precoIngrediente" class="form-control campoDefault"
                        placeholder="Insira o preço do ingrediente" />

                    <div id="imendaHTMLingrediente"></div>
                    <br>

                    <a class="btn" id="btnAdicionaIngrediente"><i class="fa fa-plus"></i> Adicionar Mais
                        ingredientes</a>


                    <br>
                    <br>
                    <label for="name">Imagem da receita</label>
                    <div class="file-upload">
                        <input class="file-upload__input" type="file" name="image" accept="image/*" id="myFile" multiple>
                        <button class="file-upload__button" type="button">Escolha um arquivo</button>
                        <span class="file-upload__label"></span>
                    </div>

                </fieldset>
                <br>

                <fieldset>
                    <legend><span class="number">2</span>Preparo</legend>
                    <label for="bio">Modo de preparo</label>
                    <textarea required id="bio" name="prepare"></textarea>

                    <label for="time">Tempo De Preparo</label>
                    <input required type="number" id="time" name="time" placeholder="em minutos">
                </fieldset>
                <fieldset>

                </fieldset>
                <button type="submit" class="btn-register">Cadastrar</button>
            </form>
            <div class="modal-footer">
                <button class="btn-close" onclick="closeModal('dv-modal')">Fechar</button>
            </div>
        </div>
    </div>

    <script src="../js/Index.js"></script>
    <script type="text/javascript">
        var idContador = 0;

        function exclui(id) {
            var campo = $("#" + id.id);
            campo.hide(200);
        }

        $(document).ready(function () {

            $("#btnAdicionaIngrediente").click(function (e) {
                e.preventDefault();
                var tipoCampo = "ingrediente";
                adicionaCampo(tipoCampo);
            })

            function adicionaCampo(tipo) {

                idContador++;

                var idCampoNomeIngrediente = "ingrediente" + idContador;
                var idPreco = "precoIngrediente" + idContador;
                var numCampo = idContador;
                var idForm = "formIngredientes" + idContador;

                var html = "";

                html += "<div style='margin-top: 8px;' class='input-group' id='" + idForm + "'>";
                html += "<label>Nome do ingrediente</label>";
                html += "<input required type='text' name='" + idCampoNomeIngrediente +
                    "' placeholder='Insira o nome do " + numCampo + "o " + tipo + "'>";
                html += "<label>Preco do ingrediente</label>";
                html += "<input required type='number' step='.01' name='" + idPreco +
                    "' class='form-control novoCampo' placeholder='Insira o preço do " + numCampo + "o " +
                    tipo + "'/>";
                html += "<span class='input-group-btn'>";
                html += "<button class='btn' onclick='exclui(" + idForm +
                    ")' type='button'><span class='fa fa-trash'></span></button>";

                html += "</span>";
                html += "</div>";

                $("#imendaHTML" + tipo).append(html);
            }

            $(".btnExcluir").click(function () {
                console.log("clicou");
                $(this).slideUp(200);
            })

            $("#btnSalvar").click(function () {

                var mensagem = "";
                var novosCampos = [];
                var camposNulos = false;

                $('.campoDefault').each(function () {
                    if ($(this).val().length < 1) {
                        camposNulos = true;
                    }
                });
                $('.novoCampo').each(function () {
                    if ($(this).is(":visible")) {
                        if ($(this).val().length < 1) {
                            camposNulos = true;
                        }
                        //novosCampos.push($(this).val());
                        mensagem += $(this).val() + "\n";
                    }
                });

                if (camposNulos == true) {
                    alert("Atenção: existem campos nulos");
                } else {
                    alert("Novos campos adicionados: \n\n " + mensagem);
                }

                novosCampos = [];
            })

        });
    </script>

    <script type="text/javascript">
        Array.prototype.forEach.call(
            document.querySelectorAll(".file-upload__button"),
            function (button) {
                const hiddenInput = button.parentElement.querySelector(
                    ".file-upload__input"
                );
                const label = button.parentElement.querySelector(".file-upload__label");
                const defaultLabelText = "Nenhum arquivo Selecionado";

                // Set default text for label
                label.textContent = defaultLabelText;
                label.title = defaultLabelText;

                button.addEventListener("click", function () {
                    hiddenInput.click();
                });

                hiddenInput.addEventListener("change", function () {
                    const filenameList = Array.prototype.map.call(hiddenInput.files, function (
                        file
                    ) {
                        return file.name;
                    });

                    label.textContent = filenameList.join(", ") || defaultLabelText;
                    label.title = label.textContent;
                });
            }
        );
    </script>
</body>

</html>
