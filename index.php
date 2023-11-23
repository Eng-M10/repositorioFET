<?php

require_once 'core/init.php';

if (Session::exists('home')) {
    echo "<p class='alert alert-success'>".Session::flash('home')."</p>";
}

$user = new User();
$data = $user->data();
$doc = new Document();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repositório - Faculdade de Engenharias e Tecnologias</title>
    <link rel="shortcut icon" href="./resources/img/logoup.png" >
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./resorces/css/bootstrap-icons.css">
</head>
<body class="bg-light">
    <!-- Barra de navegação -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div>
             <span><a class="navbar-brand" href="https://up.ac.mz">
                    <img src="./resources/img/logoup.png" alt="logo da up-maputo" width="100" height="100">
                </a>
            </div>
            <span class="border border-black mx-2"></span>
            <div>
            <a class="navbar-brand" href="https://fet.up.ac.mz">
                <img src="./resources/img/logofet.png" alt="logotipo da fet" class="w-20 h-20">
            </a></span>
            </div>
            <!-- Botão do menu hamburguês -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Itens de navegação -->
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    
                         <?php if ($user->isLoggedIn()): ?> 
    
                            <?php if ($user->hasPermission('admin')): ?>
                            <!-- For Admin -->
                            <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-speedometer2"></i>
                            <?= escape($data->username) ?>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item btn btn-primary" href="admin.php">Painel do Administrador</a></li>
                                <li><a class="dropdown-item btn btn-secondary" href="logout.php">Sair</a></li>
                  
                            </ul>
                            </div>
                            <?php else: ?>
                            <!-- For Normal User -->
                            <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            <?= escape($data->username) ?>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item btn btn-primary" href="userpainel.php">Painel do Utilizador</a></li>
                                <li><a class="dropdown-item btn btn-secondary" href="logout.php">Sair</a></li>
                  
                            </ul>
                            </div>

                            <?php endif;?>

                        <?php else : ?>
                        <li class="nav-item"><a href="login.php" class="btn btn-primary me-2">Login</a></li>
                        <li class="nav-item"><a href="register.php" class="btn btn-secondary">Cadastrar</a></li>
                        <?php endif;?>

                  </ul>
            </div>
        </div>
    </nav>


    <!-- Conteúdo principal -->
    <div class="container mt-5">
        <h1 class="display-4">Repositório Científico da <strong>F.E.T</strong></h1>
        <p class="lead">Encontre e explore uma vasta coleção de artigos científicos da Faculdade de Engenharias e Tecnologias.</p>

        <!-- Campo de pesquisa -->
        <div class="container mt-2">
            <p class="text-center">Encontre todos os trabalhos clicando Aqui. <span class="text-center"> <a class="btn btn-primary"  href="pesquisar.php">Pesquisar</a> <span></p>
           
        </div>
           
        <!-- Cards de informações -->
        

        <!-- Preview de documentos carregados recentemente em forma de tabela -->
        <h2 class="mt-5">Monografias</h2>
        <div class="col-md-12">
            <table id="dataTableMonografia"  class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Data Submissão</th>
                    </tr>
                </thead>
                <?php $doc->showAllDocumentsByType("monografia"); ?>
            </table>
       </div>


        <h2 class="mt-5">Teses</h2>
        <div class="col-md-12">
            <table id="dataTableTese"  class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Data de Submissão</th>
                    </tr>
                </thead>
                <?php $doc->showAllDocumentsByType("tese"); ?>
            </table>
        </div>

        <h2 class="mt-5">Dissertações</h2>
        <div class="col-md-12">
            <table id="dataTableDissertacao" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Data de Submissão</th>
                    </tr>
                </thead>
                <?php $doc->showAllDocumentsByType("dissertacao"); ?>
            </table>
        </div>

    <!-- Rodapé -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>Links Úteis</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">Termos de Uso</a></li>
                        <li><a href="#">Política de Privacidade</a></li>
                        <li><a href="#">Sobre Nós</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h4>Contato</h4>
                    <address>
                        <p><strong>Email:</strong>upfet@gmail.com</p>
                        <p><strong>Telefone:</strong>(+258) 84 20 07 116</p>
                    </address>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

<script>
    $(document).ready(function () {
        $('#dataTableMonografia, #dataTableTese, #dataTableDissertacao').DataTable({
            "searching": false,
            "paging": true,
            "info": false,
            "lengthChange": false
        });
    });
</script>
</body>
</html>



