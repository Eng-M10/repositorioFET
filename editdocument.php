<?php
    require_once 'core/init.php';

    $user = new User();
    
    if (!$user->isLoggedIn()) {
        Redirect::to('index.php');
    }

    if(Input::exists('get')){
        $doc = new Document();
        $_id = Input::get('id');
        $doc->documentData($_id);

    }

    if(Input::exists('post')){
        $doc = new Document();





    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Carregamento</title>
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    
<form action="" method="POST" enctype="multipart/form-data" class="bg-white p-3 rounded shadow-md" >
        <h2 class="text-xl font-semibold mb-3">Atualizar Novo Carregamento</h2>
        <div class="mb-4">
            <label for="document-title" class="block text-gray-700">Título/Tema do Trabalho:</label>
            <input type="text" id="titulotrabalho" name="titulotrabalho" class="w-full border border-gray-300 rounded px-4 py-2" value = "<?=escape($doc->getTitle()) ?>">
        </div>
        <div class="mb-4">
            <label for="document-title" class="block text-gray-700">Autor:</label>
            <input type="text" id="autortrabalho" name="autortrabalho" class="w-full border border-gray-300 rounded px-4 py-2" 
            value="<?=escape($doc->getAutor())?>">
        </div>

        <div>
            <label for="document-type" class = "block text-gray-700">Tipo de trabalho:</label>
            <select name="tipotrabalho" id="document-type"  class="w-full border border-gray-300 rounded px-4 py-2"  value = "<?= escape($doc->getTipo()) ?>">
                <option value="Dissertacao">Dissertação</option>
                <option value="Monografia">Monografia</option>
                <option value="Tese">Tese</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="document-content" class="block text-gray-700">Resumo do Trabalho:</label>
            <textarea id="document-content" name="resumotrabalho" class="w-full border border-gray-300 rounded px-4 py-2" rows="4" ><?= escape($doc->getResumo()) ?></textarea>
        </div>
        <div class="mb-4">
            <label for="imagem" class="block text-gray-700 text-sm font-bold mb-2">Selecione um arquivo:</label>
            <div><span><a href="<?=escape($doc->getArquivo()) ?>" target="_blank">Ver Arquivo Carregado</a></span></div>
            <input type="file" name="ficheiro" id="doc-file" accept=".pdf,.doc, .docx"  class="px-4 py-2 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" >
        </div>
        <input type="hidden" name="token" value="<?= Token::generete(); ?>">
        <input type="submit" class="btn btn-primary rounded hover:bg-blue-600" value="Atualizar Carregamento">
    </form>
</body>
</html>