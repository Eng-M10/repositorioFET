<?php
require_once 'core/init.php';
$user = new User();
if ($user->isLoggedIn()) {
   if(!$user->hasPermission('admin')){
    Redirect::to('index.php');
   }
        
}else{
    Redirect::to('index.php'); 
}




?>


<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Inclua os arquivos do Bootstrap (CSS e JS) -->
  <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <title>Painel de Utilizador</title>
  <style>
  body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    overflow: hidden;
  }

  #sidebar {
    height: 100%;
    width: 250px;
    position: fixed;
    background-color: #333;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
    color: white;
  }

  #sidebar a {
    padding: 10px 15px;
    text-decoration: none;
    font-size: 20px;
    color: white;
    display: block;
    transition: 0.3s;
  }

  #sidebar a:hover {
    background-color: #555;
  }

  #content {
    margin-left: 250px;
    padding: 20px;
    overflow-y: auto;
    max-height: calc(100vh - 60px);
  }
  @media (max-width: 768px) {
    #sidebar {
      display: none;
    }

    #content {
      margin-left: 0;
    }
  }
</style>


<script>
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        var sidebar = document.getElementById('sidebar');
        var content = document.getElementById('content');

        // Adiciona ou remove a classe 'hidden' para alternar a visibilidade da barra lateral
        sidebar.classList.toggle('hidden');
        
        // Ajusta a margem do conteúdo à direita conforme a visibilidade da barra lateral
        content.style.marginLeft = sidebar.classList.contains('hidden') ? '0' : '250px';
    });

    function mostrarConteudo(conteudoId) {
        // Oculta todos os elementos de conteúdo
        var elementosConteudo = document.querySelectorAll('#content > div');
        elementosConteudo.forEach(function (elemento) {
        elemento.classList.add('d-none');
        });

        // Mostra o elemento de conteúdo correspondente ao ID
        var elementoSelecionado = document.getElementById(conteudoId);
        elementoSelecionado.classList.remove('d-none');
    }
</script>

</head>


<body>

<div class="container-fluid">
  <div class="row">
        <button class="btn btn-dark d-md-none" id="sidebarToggle">
        <i class="bi bi-list"></i>
        </button>
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="mostrarConteudo('dashboard')"><i class="bi bi-speedometer2"> Dashboard</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="mostrarConteudo('adduser')"><i class="bi bi-person-fill-add"></i> Adicionar</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="mostrarConteudo('userlist')"><i class="bi bi-people"> Utilizadores</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="bi bi-chevron-left"> Voltar</i></a>
                </li>
                
                </ul>
            </div>
        </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 overflow-y:auto" id="content">
      <h2>Bem-vindo ao painel Administrativo</h2>

      <div id="dashboard" >
            
      

  <!-- Button to generate report -->
        <div class="row mt-4">
          <div class="col-12 text-center">
            <a href="relatorio.php" target="_blank" class="btn btn-primary">Gerar Relatório</a>
          </div>
        </div>
      </div>

      <div id="adduser" class='d-none'>

      </div>

      <div id="userlist" class="d-none">
      <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                        <tr>
                            <th>Utilizador</th>
                            <th>Nome</th>
                            <th>Entidade</th>
                            <th>Departamento</th>
                            <th>Registado</th>
                            <th>Nivel de Acesso</th>
                        </tr>
                    </thead>
                        
                    <tbody>
                        <?= $user->showAllUsers(); ?>
                    </tbody>
                </table>
        </div>

      </div>



    </main>
  </div>
</div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

</body>
</html>
