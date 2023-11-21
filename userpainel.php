<?php
require_once 'core/init.php';

$user = new User();
$doc = new Document();
$data = $user->data();

if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Usuário</title>
    <link href="../../Resourses/css/css.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100 font-sans flex">

<!-- Barra Lateral à Esquerda -->
<div class="w-25 bg-gray-300 p-4 h-100 bg-gray-300">
    <div class="w-100 h-12 mb-4">
        <img src="../../Resourses/img/logo-fet.png" alt="">    
    </div>
    <ul class="list-group">
        <li class="list-group-item"><button id="view-documents" class="w-100 btn btn-primary">Meus Carregamentos</button></li>
        <li class="list-group-item"><button id="add-document" class="w-100 btn btn-primary">Adicionar Documento</button></li>
        <li class="list-group-item"><button id="profile-info" class="w-100 btn btn-primary">Ver informações do Perfil</button></li>
        <li class="list-group-item"><a id="backTo" class="w-100 btn btn-danger" href="index.php">Voltar a Página Inicial</a></li>
    </ul>
</div>

<!-- Conteúdo Principal à Direita -->
<div class="w-75 p-4">
    <h1 class="text-3xl font-semibold mb-4 text-center">Painel do Utilizador</h1>

    <!-- Formulário de Adicionar Documento -->
    <form action="submitdocument.php" method="POST" enctype="multipart/form-data" class="add-document-form bg-white p-3 rounded shadow-md" style="display: none;">
        <h2 class="text-xl font-semibold mb-3">Adicionar Novo Carregamento</h2>
        <div class="mb-4">
            <label for="document-title" class="block text-gray-700">Título/Tema do Trabalho:</label>
            <input type="text" id="titulotrabalho" name="titulotrabalho" class="w-full border border-gray-300 rounded px-4 py-2" >
        </div>
        <div class="mb-4">
            <label for="document-title" class="block text-gray-700">Autor:</label>
            <input type="text" id="autortrabalho" name="autortrabalho" class="w-full border border-gray-300 rounded px-4 py-2" 
            value="<?=escape($data->name)?>">
        </div>

        <div>
            <label for="document-type" class = "block text-gray-700">Tipo de trabalho:</label>
            <select name="tipotrabalho" id="document-type"  class="w-full border border-gray-300 rounded px-4 py-2" >
                <option value="Dissertacao">Dissertação</option>
                <option value="Monografia">Monografia</option>
                <option value="Tese">Tese</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="document-content" class="block text-gray-700">Resumo do Trabalho:</label>
            <textarea id="document-content" name="resumotrabalho" class="w-full border border-gray-300 rounded px-4 py-2" rows="4" ></textarea>
        </div>
        <div class="mb-4">
            <label for="imagem" class="block text-gray-700 text-sm font-bold mb-2">Selecione um arquivo:</label>
            <input type="file" name="ficheiro" id="doc-file" accept=".pdf,.doc, .docx"  class="px-4 py-2 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
        </div>
        <input type="hidden" name="token" value="<?= Token::generete(); ?>">
        <input type="submit" class="btn btn-primary rounded hover:bg-blue-600" value="Adicionar Carregamento">
    </form>

    <!-- Lista de Documentos -->
    <div class="document-list space-y-4">
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


</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
      document.getElementById("view-documents").addEventListener("click", function() {
        document.querySelector(".add-document-form").style.display = "none";
        document.querySelector(".document-list").style.display="block"
    });

    document.getElementById("add-document").addEventListener("click", function() {
        document.querySelector(".add-document-form").style.display = "block";
        document.querySelector(".document-list").style.display="none"
    });

    document.getElementById("profile-info").addEventListener("click", function() {
        window.location.href = "http://localhost/repositorioFET/update.php";
    });
</script>

</body>
</html>
