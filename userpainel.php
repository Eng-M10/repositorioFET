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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans flex">

<!-- Barra Lateral à Esquerda -->
<div class="w-1/4 bg-gray-300 p-4 h-screen">
    <div class="w-full h-1/8 mb4">
    <img src="../../Resourses/img/logo-fet.png" alt="">    
    </div>
    <ul class="space-y-2 py-10">
        <li><button id="view-documents"class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Meus Carregamentos</button></li>
        <li><button id="add-document" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Adicionar Documento</button></li>
        <li><button id="add-article" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Escrever Artigo</button></li>
        <li><button id="profile-info" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ver informações do Perfil</button></li>
        <li><button id="backTo" class="w-full bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" href="index.php" > Voltar a Página Inicial</button></li>
        
        
    </ul>
</div>

<!-- Conteúdo Principal à Direita -->
    <div class="w-3/4 p-4">
        <h1 class="text-3xl font-semibold mb-4 text-center">Painel do Utilizador</h1>

    <!-- Formulário de Adicionar Documento -->
    <form action="http://localhost/v2repofet/Document/documentSubmit" method="POST" enctype="multipart/form-data" class="add-document-form bg-white p-6 rounded shadow-md" style="display: none;">
        <h2 class="text-xl font-semibold mb-4">Adicionar Novo Carregamento</h2>
        <div class="mb-4">
            <label for="document-title" class="block text-gray-700">Título/Tema do Trabalho:</label>
            <input type="text" id="document-title" name="document-title" class="w-full border border-gray-300 rounded px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="document-title" class="block text-gray-700">Autore(s):</label>
            <input type="text" id="document-authors" name="document-authors" class="w-full border border-gray-300 rounded px-4 py-2" required>
        </div>

        <div>
            <label for="document-type" class = "block text-gray-700">Tipo de trabalho:</label>
            <select name="document-type" id="document-type"  class="w-full border border-gray-300 rounded px-4 py-2" required>
                <option value="Dissertacao">Dissertação</option>
                <option value="Monografia">Monografia</option>
                <option value="Tese">Tese</option>
            </select>


        </div>


        <div class="mb-4">
            <label for="document-content" class="block text-gray-700">Resumo do Trabalho:</label>
            <textarea id="document-content" name="document-summary" class="w-full border border-gray-300 rounded px-4 py-2" rows="4" required></textarea>
        </div>
        <div class="mb-4">
            <label for="imagem" class="block text-gray-700 text-sm font-bold mb-2">Selecione um arquivo:</label>
            <input type="file" name="doc-file" id="doc-file" accept=".pdf, .pptx, .doc, .docx, .ppt" required
                class="px-4 py-2 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
    </div>
        <input type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" value="Adicionar Carregamento">
    </form>

    <!-- Lista de Documentos -->
    <div class="document-list space-y-4">
        <h2 class="text-xl font-semibold mb-4">Seus documentos</h2>
        <table class="table text-black-700 border-separate space-y-6 text-sm">
        <thead class="bg-blue-500 text-black">
                <tr>
                    <th>Título</th>
                    <th>Tipo de Trabalho</th>
                    <th>Data Submissão</th>
                </tr>
            </thead>
            <?php $doc->showAllDocumentsByUserID(1); ?>
        </table>
        


        <hr class="w-full h-2">
        <h2 class="text-xl font-semibold mb-4">Seus Artigos</h2>
    </div>
    <!-- Formulario de Artigos -->
    <form actiom="" method="POST" enctype="multipart/form-data" class="add-article-form bg-white p-6 rounded shadow-md" style="display: none;">
        <h2 class="text-xl font-semibold mb-4">Adicionar Novo Artigo</h2>
        <div class="mb-4">
            <label for="document-title" class="block text-gray-700">Título/Tema do Artigo:</label>
            <input type="text" id="article-title" name="document-title" class="w-full border border-gray-300 rounded px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="document-title" class="block text-gray-700">Autore(s):</label>
            <input type="text" id="article-title" name="document-authors" class="w-full border border-gray-300 rounded px-4 py-2" required>
        </div>

        <div class="mb-4">
            <label for="article-summary" class="block text-gray-700">Resumo do Trabalho:</label>
            <textarea id="article-summary" name="article-summary" class="w-full border border-gray-300 rounded px-4 py-2" rows="4" required></textarea>
        </div>
        <div class="mb-4">
            <label for="article-content" class="block text-gray-700">Corpo do Artigo:</label>
            <textarea id="document-content" name="article-content" class="w-full border border-gray-300 rounded px-4 py-2" rows="4" required></textarea>
        </div>

        <input type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" value="Adicionar Carregamento">
    </form>    




    <!-- Formulário de Edição de Documento -->
    <form class="edit-document-form bg-white p-6 rounded shadow-md" style="display: none;">
        <h2 class="text-xl font-semibold mb-4">Editar Documento</h2>
        <div class="mb-4">
            <label for="edit-document-title" class="block text-gray-700">Novo Título:</label>
            <input type="text" id="edit-document-title" name="edit-document-title" class="w-full border border-gray-300 rounded px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="edit-document-content" class="block text-gray-700">Novo Conteúdo:</label>
            <textarea id="edit-document-content" name="edit-document-content" class="w-full border border-gray-300 rounded px-4 py-2" rows="4" required></textarea>
        </div>
        <input type="hidden" id="edit-document-id" name="edit-document-id">
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Salvar Alterações</button>
    </form>

    <!-- Informacoes do Utilizador -->
    <form class="profile-info-form bg-white p-6 rounded shadow-md" style="display: none;" method="" action="">
        <h2 class="text-xl font-semibold mb-4">Informações do Perfil</h2>
        <div class="mb-4">
            <label for="namefield" class="block text-gray-700">Nome:</label>
            <input type="text" class="w-full border border-gray-300 rounded px-4 py-2" id="namefield" name="username" value="<?=escape($data->name)?>">
        </div>
        <div class="mb-4">
            <label for="emailfield" class="block text-gray-700">Email:</label>
            <input type="text"  class="w-full border border-gray-300 rounded px-4 py-2" id="emailfield" name="email" value="<?=escape($data->email)?>">
        </div>
       <!-- <div class="mb-4">
            <label for="deptfield" class="block text-gray-700">Departamento:</label>
            <input type="text"  class="w-full border border-gray-300 rounded px-4 py-2" id="deptfield" name="departamento" value= "?" >
        </div>-->
        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Editar</button>
        <button type="button" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Salvar</button>
        <a href="./changepassword.php" class="btn">Change Password</a>
        
    </form>
</div>


<script>
    // JavaScript para mostrar/ocultar os formulários
    document.getElementById("view-documents").addEventListener("click", function() {
        document.querySelector(".add-document-form").style.display = "none";
        document.querySelector(".edit-document-form").style.display = "none";
        document.querySelector(".profile-info-form").style.display = "none";
        document.querySelector(".add-article-form").style.display="none";
        document.querySelector(".document-list").style.display="block"
    });

    document.getElementById("add-document").addEventListener("click", function() {
        document.querySelector(".add-document-form").style.display = "block";
        document.querySelector(".edit-document-form").style.display = "none";
        document.querySelector(".profile-info-form").style.display = "none";
        document.querySelector(".add-article-form").style.display="none";
        document.querySelector(".document-list").style.display="none"
    });

    document.getElementById("profile-info").addEventListener("click", function() {
        document.querySelector(".add-document-form").style.display = "none";
        document.querySelector(".edit-document-form").style.display = "none";
        document.querySelector(".add-article-form").style.display="none";
        document.querySelector(".profile-info-form").style.display = "block";
        document.querySelector(".document-list").style.display="none"
    });
    document.getElementById("add-article").addEventListener("click", function() {
        document.querySelector(".add-document-form").style.display = "none";
        document.querySelector(".edit-document-form").style.display = "none";
        document.querySelector(".profile-info-form").style.display = "none";
        document.querySelector(".document-list").style.display="none";
        document.querySelector(".add-article-form").style.display="block";
    });
    document.getElementById("backTo").addEventListener("click", function() {
        window.location.href = "http://localhost/repositorioFET/index.php";

    });


    
    
</script>

</body>
</html>
