<?php 
    require_once ("../classes/Session.php");
    new Session();
    if(isset($_SESSION['loggined']))
    {
        header("Location: ../index.php");
    }
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/header.php");
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/funkcije.php");
    require_once("../classes/Users.php");
    if(!isset($_POST['email']) || empty(trim($_POST['email']))) 
    {
        dieNew("Greska: Niste uneli email.");
    }
    if(!isset($_POST['password']) || empty(trim($_POST['password']))) 
    {
        dieNew("Greska: Niste uneli sifru.");
    }
    if(!isset($_POST['name']) || empty(trim($_POST['name']))) 
    {
        dieNew("Greska: Niste uneli ime.");
    }
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    if(!str_contains($email, "@")){
        dieNew("Greska: Nepravilan unos email-a.");
    }
    if(str_contains($name, " ")){
        dieNew("Greska: Ime ne moze imate razmake.");
    }
    if(strlen($email) < 6 || strlen($password) > 32)
    {
        dieNew("Greska: Email mora imati vise od 5 karaktera i manje od 32.");
    }
    if(strlen($name) < 5 || strlen($name) > 32)
    {
        dieNew("Greska: Ime mora imati vise od 4 karaktera i manje od 32.");
    }
    if(strlen($password) < 6 || strlen($password) > 25)
    {
        dieNew("Greska: Sifra mora imati vise od 5 karaktera i manje od 25.");
    }
    $user = new Users();
    $user->Register($email,$password,$name);

    
    
    