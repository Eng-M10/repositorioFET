<?php
    require_once 'core/init.php';

    $user = new User();

    if (!$user->isLoggedIn()) {
        Redirect::to('login.php');
    }

    if (Input::exists()) {
        if (Token::check(Input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'password_current' => array(
                    'required'=> true,
                    'min' => 6,
                ),
                'password_new' => array(
                    'required'=> true,
                    'min' => 6,
                ),
                'password_new_again' => array(
                    'required'=> true,
                    'min' => 6,
                    'matches' => 'password_new',
                )
            ));
            if ($validation->passed()) {
                if (Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
                    echo 'Your current password is wrong';
                } else {
                    $salt = Hash::salt(32);
                    $user->update(array(
                        'password' => Hash::make(Input::get('password_new'), $salt),
                        'salt' => $salt
                    ));

                    Session::flash('home', 'Your password has been changed');
                    Redirect::to('index.php');
                }

            } else {
                foreach ($validate->errors() as $error) {
                    echo $error, '<br>';
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Your Form Title</title>
</head>
<body>

<div class="container mt-5">
    <form action="" method="post">
        <div class="form-group">
            <label for="password_current">Password Atual</label>
            <input type="password" class="form-control" name="password_current" id="password_current" required>
        </div>

        <div class="form-group">
            <label for="password_new">Nova Password</label>
            <input type="password" class="form-control" name="password_new" id="password_new" required>
        </div>

        <div class="form-group">
            <label for="password_new_again">Confirma a nova password</label>
            <input type="password" class="form-control" name="password_new_again" id="password_new_again" required>
        </div>

        <input type="submit" class="btn btn-primary" value="Change">
        <a href="update.php" class="btn btn-secondary" >Voltar</a>
        <input type="hidden" name="token" value="<?= Token::generete() ?>">
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
