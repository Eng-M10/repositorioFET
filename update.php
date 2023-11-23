<?php 

require_once 'core/init.php';

$user = new User();

if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'name' => array(
                'required' => true,
                'min' => 2,
                'max' => 50,
            ),
            'email' => array(
                'required' => true,
                'min' => 2,
                'email' => true
            )
        ));

        if ($validation->passed()) {
            try {
                $user->update(array(
                    'name'=> Input::get('name'),
                    'email'=>Input::get ('email')
                ));

                Session::flash('home', 'Your details have been updated.');
                Redirect::to('index.php');
            } catch (\Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach($validation->errors() as $error) {
                echo $error ,'<br>';
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
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./resorces/css/bootstrap-icons.css">
    <title>Your Form</title>
</head>
<body>

<div class="container mt-5">
    <form action="" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= escape($user->data()->name) ?>">
        </div>
        <div class="form-group">
            <label for="name">Email</label>
            <input type="text" class="form-control" name="email" id="email" value="<?= escape($user->data()->email) ?>">
        </div>

        <input type="submit" class="btn btn-primary" value="Update">
        <a href="userpainel.php"class="btn btn-secondary">voltar</a>
        <a href="userpainel.php"class="btn btn-primary">Alterar a Password</a>
        <input type="hidden" name="token" value="<?= Token::generete() ?>">
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
