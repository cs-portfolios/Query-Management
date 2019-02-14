<?php
session_start();

$_SESSION = [];

if(ini_set("session.use_cookies")){
    setcookie(session_name(),"", time() -4200);
}

session_destroy();

header('location: index.php');
exit();