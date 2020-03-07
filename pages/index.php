<?php 
    include("html/top.php");
    session_start();

    if(isset($_COOKIE["userCurrentId"]) && ($_COOKIE["userCurrentId"] != 0)){
        require 'main.php';
    }

    else {
        require 'entry/body.php';
        if(isset($_SESSION["userCurrentRegister"]) && ($_SESSION["userCurrentRegister"] == 1)){
            require 'entry/register.php';
        }
        else {
            require 'entry/login.php';
        }
    }
    include("html/bottom.php");
?>