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
    <title>Trabalhando Nisso</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Inclua a biblioteca Bootstrap CSS -->
 
</head>
<body>
    <div class="container text-center">
        <div class="row mt-5">
            <div class="col-12">
                <div class="col-12">
                <img src="./resources/img/Under.jpg" height="100px" width="100px">
                </div>
                <h1>Trabalhando Nisso</h1>
                <p>Em breve teremos novidades.</p>
                <i class="fas fa-tools fa-5x"></i> <!-- Ícone de ferramentas/obras -->
            </div>
        </div>
        <div class="row mt-5">
        <div class="col-12">
                <a href="index.php" class="btn btn-primary btn-lg">Voltar ao Inicio</a>
            </div>
        </div>
    </div>

    <!-- Inclua a biblioteca Font Awesome para o ícone -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Inclua a biblioteca Bootstrap JS (opcional, mas necessária para alguns recursos do Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
