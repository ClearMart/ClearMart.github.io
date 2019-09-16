<?php

if ( ! isset( $_POST['submitted'] ) )
header('Location: ' . $_SERVER['HTTP_REFERER']);

$credentials = [
    'email' => 'guest@clearmart.com',
    'password' => 'magic123'
];

if ( $credentials['email'] !== $_POST['email'] OR $credentials['password'] !== $_POST['password'] )
{    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    
    exit();
}

session_start();

// Storing session data
$_SESSION["isLogged"] = "1";

header('Location:' . '../home.php');

exit();