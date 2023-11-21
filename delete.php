<?php
require_once 'core/init.php';


if(Input::exists('get')){

    $_id = Input::get('id');

    $doc = new Document();
    try{
      
        if($doc->deleteDocumentByID($_id)){
            Session::flash('delete_success', 'Successfully deleted document!');
            
        }else{
            Session::flash('delete_error', 'Error deleting document, please try again later!');
        }
        Redirect::to('userpainel.php');
    }
    catch(Exception $e){
        echo " ".$e->getMessage();
    }

}