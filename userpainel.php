<?php
require_once 'core/init.php';

$user = new User();
$doc = new Document();
$data = $user->data();

if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
    if (Session::exists('doc')) {
      echo "<script> window.alert(".Session::flash('doc').")"."</script>";
     
    }
    if (Session::exists('file')) {
      echo "<script> window.alert(".Session::flash('file').")"."</script>";
    }

    if (Input::exists()) {
      if (Token::check(Input::get('token'))) {
          $validate = new Validate();
          $validation = $validate->check($_POST, array(
              'titulo' => array(
                  'min' => 5,
                  'unique' => 'document',
                  'required' => true
  
              ),
              'autortrabalho' => array(
                  'min' => 5,
                  'required' => true
  
              ),
              'tipotrabalho' => array(
                  'min' => 5,
                  'required' => true
  
              ),
              'resumotrabalho' => array(
                  'min' => 5,
                  'required' => true
  
              )
              )
          );
  
          if ($validation->passed()) {
              $doc = new Document();
              $user = new User();
              $data = $user->data();
  
              $upload_result = $doc->upload($_FILES['ficheiro']);
  
              try {
                  $doc->createDocument(
                      array(
                          'titulo' => Input::get('titulo'),
                          'resumo' => Input::get('resumotrabalho'),
                          'autores' => Input::get('autortrabalho'),
                          'tipo_trabalho' => Input::get('tipotrabalho'),
                          'id_user' => $data->id,
                          'estado' => 'Verificado',
                          'arquivo' => $upload_result
                      )
                  );
                  Redirect::to('userpainel.php');
                  Session::flash('file', 'Foi Registado com sucesso, agora pode verificar o documento!');
  
              } catch (Exception $e) {
                  echo "<p class='alert alert-danger text-center'>" . $e->getMessage() . "</p>";
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
            <a class="nav-link" onclick="mostrarConteudo('document-list')"><i class="bi bi-grid-3x3-gap-fill"> Home</i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick="mostrarConteudo('add-document-form')"><i class="bi bi-file-earmark-plus-fill"> Adicionar</i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  onclick="mostrarConteudo('user-info')"><i class="bi bi-person-circle"> Perfil</i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php"><i class="bi bi-chevron-left"> Voltar</i></a>
          </li>
          
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 overflow-y:auto" id="content">
      <h2>Bem-vindo ao seu painel</h2>

      <div id="add-document-form" class="d-none">
      <form action="" method="POST" enctype="multipart/form-data" class="bg-white p-3 rounded shadow-md" >
        <h2 class="text-xl font-semibold mb-3">Adicionar Novo Carregamento</h2>
        <div class="mb-4">
            <label for="document-title" class="block text-gray-700">Título/Tema do Trabalho:</label>
            <input type="text" id="titulotrabalho" name="titulo" class="w-full border border-gray-300 rounded px-4 py-2"  value="<?=escape(Input::get('titulo'))?>">
        </div>
        <div class="mb-4">
            <label for="document-title" class="block text-gray-700">Autor:</label>
            <input type="text" id="autortrabalho" name="autortrabalho" class="w-full border border-gray-300 rounded px-4 py-2" 
            value="<?=escape(Input::get('autortrabalho'))?>">
        </div>

        <div>
            <label for="document-type" class = "block text-gray-700">Tipo de trabalho:</label>
            <select name="tipotrabalho" id="document-type"  class="w-full border border-gray-300 rounded px-4 py-2"  value="<?=escape(Input::get('tipotrabalho'))?>">
                <option value="Dissertacao">Dissertação</option>
                <option value="Monografia">Monografia</option>
                <option value="Tese">Tese</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="document-content" class="block text-gray-700">Resumo do Trabalho:</label>
            <textarea id="document-content" name="resumotrabalho" class="w-full border border-gray-300 rounded px-4 py-2" rows="4" value="<?=escape(Input::get('resumotrabalho'))?>" ></textarea>
        </div>
        <div class="mb-4">
            <label for="imagem" class="block text-gray-700 text-sm font-bold mb-2">Selecione um arquivo:</label>
            <input type="file" name="ficheiro" id="doc-file" accept=".pdf,.doc, .docx"  class="px-4 py-2 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required >
        </div>
        <input type="hidden" name="token" value="<?= Token::generete(); ?>">
        <input type="submit" class="btn btn-primary rounded hover:bg-blue-600" value="Adicionar Carregamento">
    </form>
      </div>

      <div id="document-list" >
      <h2 class="text-xl font-semibold mb-4">Seus documentos</h2>
        <table class="table table-bordered table-striped">
            <thead>       
                <tr>
                    <th>Título</th>
                    <th>Tipo de Trabalho</th>
                    <th>Data Submissão</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <?php $doc->showAllDocumentsByUserID($data->id); ?>
        </table>
      </div>

      <div id="user-info" class="d-none">
      <p>Nome de Utilizador: <?= $data->username ?></p>
        <p>Nome Completo: <?= $data->name ?></p>
        <p>Email: <?= $data->email ?></p>
        <p>Departamento: <?= $data->departamento ?></p>
        <p>Entidade: <?= $data->entidade ?></p>
        <hr>
        <a href="update.php" class="btn btn-primary">Atualizar Informações</a>
      </div>
    </main>
  </div>
</div>

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

</body>
</html>
