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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="" download>Gerar Relatorio</a>
    
</body>
</html>