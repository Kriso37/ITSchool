<?php 
    require_once ("../classes/Session.php");
    new Session();
    if(isset($_SESSION['loggined']))
    {
        header("Location: ../index.php");
    }
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/header.php");
    require_once ($_SERVER['DOCUMENT_ROOT']. "/Projekat2/funkcije.php");
    require_once("../classes/Users.php");
    if(!isset($_POST['email']) || empty(trim($_POST['email']))) 
    {
        dieNew("Greska: Niste uneli email.");
    }
    if(!isset($_POST['password']) || empty(trim($_POST['password']))) 
    {
        dieNew("Greska: Niste uneli sifru.");
    }
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(!str_contains($email, "@")){
        dieNew("Greska: Nepravilan unos email-a.");
    }
    $user = new Users();
    $user->Login($email,$password); 
    
    
    