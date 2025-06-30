<?php 
    require_once ("../classes/Session.php");
    new Session();
    if(!isset($_SESSION['admin']))
    {
        header("Location: ../index.php");
    }
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/header.php");
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/funkcije.php");
    require_once("../classes/Teacher.php");

    if(!isset($_POST['name'])) 
    {
        dieNew("Greska: Niste uneli ime mentora.");
    }
    $teacher = new Teacher();
    $teacher->Remove($_POST['name']);
    
    
    