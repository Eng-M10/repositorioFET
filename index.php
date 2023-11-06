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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <!-- Barra de navegação -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div>
                <a class="navbar-brand" href="https://up.ac.mz">
                    <img src="./resources/img/logoup.png" alt="logo da up-maputo" width="100" height="100">
                </a>
            </div>
            <span class="border border-black mx-2"></span>
            <div>
            <a class="navbar-brand" href="https://fet.up.ac.mz">
                <img src="./resources/img/logofet.png" alt="logotipo da fet" class="w-20 h-20">
            </a>
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
        
        <form action="pesquisar.php" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control me-0.95 rounded" placeholder="Pesquisar artigos científicos">
                <div class="input-group-append">
                <input class="btn btn-primary" type="submit" value="Pesquisar">
            
                </div>
            </div>
        </form>

        <!-- Cards de informações -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <!-- Exemplo de card -->
            <div class="col">
                <div class="card">
                    <img src="./resources/img/leviloot.jpg" class="card-img-top" alt="Imagem do Artigo">
                    <div class="card-body">
                        <h5 class="card-title">Desafio dos Trnasportes Publicos Urbanos</h5>
                        <p class="card-text">Autor: Jesus Navas</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="./resources/img/andykelly.jpg" class="card-img-top" alt="Imagem do Artigo">
                    <div class="card-body">
                        <h5 class="card-title">Inteligência Artificial vs Desenvolvimento Humano</h5>
                        <p class="card-text">Autor: Marcus Rashford</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="./resources/img/karthiksridasyam.jpg" class="card-img-top" alt="Imagem do Artigo">
                    <div class="card-body">
                        <h5 class="card-title">Dark Social Media</h5>
                        <p class="card-text">Autor: Rasmus Helltier</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="./resources/img/patricktomasso.jpg" class="card-img-top" alt="Imagem do Artigo">
                    <div class="card-body">
                        <h5 class="card-title">T</h5>
                        <p class="card-text">Autor: Patrick Tomasso</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="imagem1.jpg" class="card-img-top" alt="Imagem do Artigo">
                    <div class="card-body">
                        <h5 class="card-title">Título do Artigo 1</h5>
                        <p class="card-text">Autor: Autor 1</p>
                        <p class="card'text">12-03-2023</p>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card">
                    <img src="imagem1.jpg" class="card-img-top" alt="Imagem do Artigo">
                    <div class="card-body">
                        <h5 class="card-title">Título do Artigo 1</h5>
                        <p class="card-text">Autor: Autor 1</p>
                    </div>
                </div>
            </div>
            <!-- Adicione mais cards conforme necessário -->
        </div>

        <!-- Preview de documentos carregados recentemente em forma de tabela -->
        <h2 class="mt-5">Monografias</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Data Submissão</th>
                </tr>
            </thead>
            <?php $doc->showAllDocumentsByType("monografia"); ?>
        </table>


        <h2 class="mt-5">Teses</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Data de Submissão</th>
                </tr>
            </thead>
            <?php $doc->showAllDocumentsByType("tese"); ?>
        </table>

        <h2 class="mt-5">Dissertações</h2>
        <table class="table table-striped">
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
                        <p><strong>Email:</strong> info@repositoriocientifico.com</p>
                        <p><strong>Telefone:</strong> (123) 456-7890</p>
                    </address>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>
</html>



