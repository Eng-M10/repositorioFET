<?php
require_once 'core/init.php';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate;
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true),
        ));

        if ($validation->passed()) {
            $user = new User;

            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('username'), Input::get('password'), $remember);

            if ($login) {
                Redirect::to('index.php');
            } else {
                echo '<p>Sorry, logging in failed.</p>';
            }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error. '<br>';
            }
        }
    }    
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link rel="shortcut icon" href="../img/up_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./resorces/css/bootstrap-icons.css">
   
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #000;
            color: #fff;
            flex-direction: column;
            margin: 0;
        }
        .container {
            max-width: 400px;
            padding: 20px;
            background-color: #333;
            border-radius: 10px;
            text-align: center;
        }
        .conteudo {
            margin-top: 20px;
        }
        .input-group-text {
            background-color: #444;
            color: #0000;
        }
        .form-control {
            
            border-color: #fff;
            
        }

        .btn-primary:hover {
            background-color: #555;
            border:none;
        }
        footer{
            margin-top: 20px;
        }
    </style>

    
</head>
<body class="bg-dark">
    <div class="container">
        <img src="./resources/img/logoup.png" alt="" class="w-20">
        <h1>Entrar</h1>
        <div class="conteudo text-center">

            <form action="" method="post">
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" autocomplete="off">
                </div>

              
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                    <input type="password" name="password" id="password" class="form-control"  placeholder="Password" autocomplete="off">
                </div>

                <div class="field">
                    <label for="remember">
                        <input type="checkbox" name="remember" id="remember"> Remember me
                    </label>
                </div> <br>
                <input type="hidden" name="token" value="<?=Token::generete()?>">
                <input type="submit" class = "btn btn-primary" value="Log in">
                <a href="register.php" class = "btn btn-secondary">Sign Up</a>
            </form>

        </div>
    </div>



    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Adicione o link para os ícones do Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.20.0/font/bootstrap-icons.css">
</body>
</html>
