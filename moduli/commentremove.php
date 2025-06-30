<?php 

    require_once ("../classes/Session.php");
    new Session();
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/header.php");
    require_once ($_SERVER['DOCUMENT_ROOT']. "/Projekat2/funkcije.php");
    require_once("../classes/Lectures.php");

    checkLoginAndPaid();

    
    if(!isset($_POST['lecture']) || empty(trim($_POST['lecture']))) 
    {
        dieNew("Greska: Niste izbarali predavanje.");
    }
    if(!isset($_POST['teacher']) || empty(trim($_POST['teacher']))) 
    {
        dieNew("Greska: Niste izbarali mentora.");
    }
    $user = new Lectures();
    $user->removeComment($_SESSION['name'],$_POST['lecture'],$_POST['teacher']); 
