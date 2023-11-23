<?php
require_once 'core/init.php';
$user = new User();
$doc = new Document();
$total = $doc->getTotal();
$monografia = $doc->getTotalbyType('monografia');
$tese = $doc->getTotalbyType('tese');
$dissertacao = $doc->getTotalbyType('dissertacao');
 

if ($user->isLoggedIn()) {
   if(!$user->hasPermission('admin')){
    Redirect::to('index.php');
   }
        
}else{
    Redirect::to('index.php'); 
}


if (Input::exists()) {
  if (Token::check(Input::get('token'))) {
      $validate = new Validate();
      $validation = $validate->check($_POST, array(
          'username' => array(
              'required' => true,
              'min' => 2,
              'max' => 20,
              'unique' => 'users',
          ),
          'email' => array(
              'required' => true,
              'email' => true,
          ),
          'password' => array(
              'required' => true,
              'min' => 6,
          ),
          'password_again' => array(
              'required' => true,
              'matches' => 'password',
          ),
          'name' => array(
              'required' => true,
              'min' => 2,
              'max' => 50,
          ),
          'departamento' =>array(
              'required' => true,
          ),
          'entidade' =>array(
              
             'required' => true,
          ),

          
      )
      );

      if ($validation->passed()) {
          $user = new User();

          $salt = Hash::salt(32);

          try {
              $user->create(array(
                  'username' => Input::get('username'),
                  'password' => Hash::make(Input::get('password'), $salt),
                  'email' => Input::get('email'),
                  'salt' => $salt,
                  'name' => Input::get('name'),
                  'departamento' => Input::get('departamento'),
                  'entidade' => Input::get('entidade'),
                  'joined' => date('Y-m-d H:i:s'),
                  'group' => Input::get('group'),
              ));

              Session::flash('home', 'Foi Registado com sucesso, agora pode aceder!');
              
              Redirect::to("index.php");
          } catch ( Exception $e ) {
              die($e->getMessage());
          }
      } else {
          foreach ($validation->errors() as $error) {
              echo "<p class='alert alert-danger text-center' >".$error ."</p>";
          }
      }
  }

}



?>


<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Inclua os arquivos do Bootstrap (CSS e JS) -->
     <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./resorces/css/bootstrap-icons.css">
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

      <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-bar-chart"></i></h5>
                    <p class="card-text">Total de Documentos Arquivados.</p>
                </div>
                <div class="card-footer">

                         <p style="text: size 24px;"><?= $total[0]->{'COUNT(*)'} ?></p> 
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-mortarboard"></i></h5>
                    <p class="card-text">Monografias Registadas.</p>
                </div>
                <div class="card-footer">
                   <p style="text: size 24px;"><?=$monografia[0]->{'COUNT(*)'};?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-book"></i></h5>
                    <p class="card-text">Teses Registadas.</p>
                </div>
                <div class="card-footer">
                    <p style="text: size 24px;"><?=$tese[0]->{'COUNT(*)'};?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-patch-check"></i></h5>
                    <p class="card-text">Dissertações Registadas.</p>
                </div>
                <div class="card-footer">
               <p style="text: size 24px;"> <?=$dissertacao[0]->{'COUNT(*)'};?></p>
                </div>
            </div>
        </div>
    </div>
            
      

  <!-- Button to generate report -->
                <div class="row mt-4">
                  <div class="col-12 text-center">
                    <a href="relatorio.php" target="_blank" class="btn btn-primary">Gerar Relatório</a>
                  </div>
                </div>
      </div>

      <div id="adduser" class='d-none'>
        <h2>Adicionar Usuário</h2>
      <form action="" method="post">
            <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                <input type="text" class="form-control" name="username" placeholder="Username" id="username" value="<?= escape(Input::get('username')) ?>" autocomplete="off">
            </div>
            <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                <input type="text" class="form-control" name="email" placeholder="Email" id="email" value="<?= escape(Input::get('email')) ?>" autocomplete="off">
            </div>
            <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                <input type="text" class="form-control" placeholder="Name" name="name" id="name" value="<?= escape(Input::get('name')) ?>">
            </div>
            <div class="input-group mb-3 d-flex">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                  <select name="entidade" id="type" class="form-select form-select-sm" aria-label="small select example">
                    <option value="Estudante">Estudante</option>
                    <option value="Docente">Docente</option>
                    <option value="Funcionario">Funcionario</option>
                    <option value="Outro">Outro</option>
                  </select>
                </div>
                <div class="input-group mb-3 d-flex">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                    <select name="departamento" id="type"  class="form-select form-select-sm" aria-label="small select example" >
                    <option value="Informatica">Informatica</option>
                    <option value="Eletronica">Eletronica</option>
                    <option value="Agro-Pecuaria">Agro-Pecuaria</option>
                    <option value="Agroprocessamento">Agroprocessamento</option>
                    <option value="Edução-visual">Edução-visual</option>
                    <option value="Design">Design</option>
                  </select>
                  </select>
                </div>

                <div class="input-group mb-3 d-flex">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                    <select name="group" id="type"  class="form-select form-select-sm" aria-label="small select example" >
                    <option value="1">Utilizador Normal</option>
                    <option value="2">Administrador</option>
                  </select>
                  </select>
                </div>

                <input type="hidden" class="form-control" placeholder="Password" name = "password"  id="password" value = "password">
                <input type="hidden" class="form-control" placeholder="Confirm password" name="password_again" id="password_again" value = "password">
            <input type="hidden" name="token" value="<?= Token::generete() ?>">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>

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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

</body>
</html>
