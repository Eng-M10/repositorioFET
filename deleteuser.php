<?php
require_once 'core/init.php';


if(Input::exists('get')){

    $_id = Input::get('id');

    $user = new User();
    try{
      
       if($user->deleteUsertByID($_id)){
            Session::flash('user_deleted', 'Successfully deleted user!');
            
        }else{
            Session::flash('user_deleted', 'Error deleting user, please try again later!');
        }
        Redirect::to('admin.php');
    }
    catch(Exception $e){
        echo " ".$e->getMessage();
    }

}