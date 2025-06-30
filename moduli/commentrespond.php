<?php 

    require_once ("../classes/Session.php");
    new Session();
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/header.php");
    require_once ($_SERVER['DOCUMENT_ROOT']. "/Projekat2/funkcije.php");
    require_once("../classes/Lectures.php");

    checkLoginAndTeacher();


    if(!isset($_POST['text']) || empty(trim($_POST['text']))) 
    {
        dieNew("Greska: Niste uneli text.");
    }
    if(!isset($_POST['teacher']) || empty(trim($_POST['teacher']))) 
    {
        dieNew("Greska: Nema mentora.");
    }
    if(!isset($_POST['lecture']) || empty(trim($_POST['lecture']))) 
    {
        dieNew("Greska: Nema predavanja.");
    }
    if(!isset($_POST['name']) || empty(trim($_POST['name']))) 
    {
        dieNew("Greska: Nema ucenika.");
    }

    if(strlen($_POST['text']) < 6 || strlen($_POST['text']) > 256)
    {
        dieNew("Greska: Komentar ne moze biti kraci od 6 i duzi od 256 karaktera.");
    }
    $user = new Lectures();
    $user->teacherRespond($_POST['teacher'],$_POST['name'],$_POST['text'],$_POST['lecture']); 
    
    
?>