<?php
    require_once 'core/init.php';

    if(Input::exists('get')){
        $doc = new Document();
        $_id = Input::get('id');
        $doc->documentData($_id);

    }

    if(Input::exists('post')){
        $doc = new Document();


        
    }


?>



<form action="" method="post">

<input type="text" value = "<?= escape($docu) ?>">





</form>