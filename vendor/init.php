<?php

session_start();

$GLOBALS['config'] = [
    'mysql' => array(
        'host' => 'localhost',
        'username' => 'id21563761_muvi',
        'password' => 'muvi.Dev10',
        'db' => 'id21563761_lr',
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800,
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    ),
];  

spl_autoload_register(function($class) {

    if(file_exists('classes/'.$class.'.php')){
    require 'classes/'. $class.'.php';}
    else{
        require 'classes/fpdf/'. $class.'.php';   
    }

});

require_once 'functions/sanitize.php';

if (Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

    if ($hashCheck->count()) {
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }
}