<?php
require_once 'core/init.php';

$doc = new Document();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="./vendor/fontawesome-free/css/all.min.css">
    <link href="./vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <title>Área de Pesquisa</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Área de Pesquisa</h1>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Titulo</th>
                        <th>Autor</th>
                        <th>Tipo de Trabalho</th>
                        <th>Data de Submissao</th>
                    </tr>
                </thead>
                    
                <tbody>
                    <?= $doc->showAllDocuments(); ?>
                </tbody>
            </table>
        </div>
        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
</body>
</html>
