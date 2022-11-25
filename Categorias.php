<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard da vovo</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
</head>
<body>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="./images/vovo.png" >
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
                <a href="/dashboard-admin/Index.php" >  
                    <span class="material-symbols-sharp">grid_view</span>
                    <h3>Geral</h3>
                </a>

                <a href="/dashboard-admin/Receitas.php">
                    <span class="material-symbols-sharp">receipt_long</span>
                    <h3>Receitas</h3>
                </a>

                <a href="/dashboard-admin/Ingredientes.php" >
                    <span class="material-symbols-sharp">inventory</span>
                    <h3>Ingredientes</h3>
                </a>

                <a href="/dashboard-admin/Categorias.php" class="active">
                    <span class="material-symbols-sharp">category</span>
                    <h3>Categorias</h3>
                </a>
            </div>
        </aside>
        <!-- fim da sidebar -->

        <main>
            <h1>Categorias</h1>

            <div class="insights-one">
                <!-- grafio de ingredientes -->
                <div class="sales">
                    <span class="material-symbols-sharp">savings</span>
                        <div class="left">
                            <h3>Receitas Por Categoria</h3>
                            <table id="column-example-14"
                                class="charts-css column show-labels show-primary-axis show-data-axes">
                                <thead>
                                    <tr>
                                        <th scope="col"> Year </th>
                                        <th scope="col"> Progress </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">  </th>
                                        <td style="--size:0.25;"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">  </th>
                                        <td style="--size:0.5;"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">  </th>
                                        <td style="--size:0.125;"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">  </th>
                                        <td style="--size:0.75;"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">  </th>
                                        <td style="--size:0.25;"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <small class="text-muted">ultimos 7 dias</small>
                </div>

                
                <!-- fim do grafico de ingredientes -->
            </div>
            <!-- fim dos insights -->
        </main>
        <!-- fim da secao principal -->
    </div>

    <script src="js/Index.js"></script>
</body>
</html>