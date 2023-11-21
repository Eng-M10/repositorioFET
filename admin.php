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
<nav class="w-25 bg-gray-300 p-4 h-full bg-gray-300">
    <div class="w-100 h-12 mb-4">
        <img src="../../Resourses/img/logo-fet.png" alt="">    
    </div>
    <ul class="list-group">
        <li class="list-group-item"><button id="view-documents" class="w-100 btn btn-primary">Home</button></li>
        <li class="list-group-item"><button id="add-document" class="w-100 btn btn-primary">Adicionar Documento</button></li>
        <li class="list-group-item"><button id="profile-info" class="w-100 btn btn-primary">Ver informações do Perfil</button></li>
        <li class="list-group-item"><a id="backTo" class="w-100 btn btn-danger" href="index.php">Voltar a Página Inicial</a></li>
    </ul>
</nav>

<!-- Conteúdo Principal à Direita -->
<div class="w-75 p-4">
    <h1 class="text-3xl font-semibold mb-4 text-center">Painel do Utilizador</h1>

    <!-- Formulário de Adicionar Documento -->
    
    <!-- Lista de Documentos -->
    <div class="document-list space-y-4">
        <h2 class="text-xl font-semibold mb-4">Seus documentos</h2>
 
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
