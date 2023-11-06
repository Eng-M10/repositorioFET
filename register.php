<?php
require_once 'core/init.php';

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
            /*'email' => array(
                'required' => true,

            ),*/
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
        )
        );

        if ($validation->passed()) {
            $user = new User();

            $salt = Hash::salt(32);

            try {
                $user->create(array(
                    'username' => Input::get('username'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt,
                    'name' => Input::get('name'),
                    'joined' => date('Y-m-d H:i:s'),
                    'group' => 1,
                ));

                Session::flash('home', 'You have been registered and can now log in!');
                
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
            max-width: 500px;
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
    
        }
        .form-control {
            background-color: #fff;
            border-color: #fff;
           
        }

        .btn-primary:hover {
            background-color: #555;
            border:none;
        }
        footer{
            margin-top: 20px;
            text-decoration: none;
            text-emphasis-color: none;
            color: black;
        }
        img{
            width: 80px;
            height: 80px;
        }
    </style>

</head>
<body>
    <div class="container ">
        <div class="d-flex">
        <img src="./resources/img/logoup.png" alt="" class="img-fluid rounded mx-auto d-block">
        </div>

        <h1>Cadastrar</h1>
        <div class="conteudo">
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
                <input type="password" class="form-control" placeholder="Password" name = "password"  id="password">
            </div>
            <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                <input type="password" class="form-control" placeholder="Confirm password" name="password_again" id="password_again">
            </div>
            <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                <input type="text" class="form-control" placeholder="Name" name="name" id="name" value="<?= escape(Input::get('name')) ?>">
            </div>
            <input type="hidden" name="token" value="<?= Token::generete() ?>">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
