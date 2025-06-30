<?php 

    require_once ("../classes/Session.php");
    new Session();
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/header.php");
    require_once ($_SERVER['DOCUMENT_ROOT']. "/Projekat2/funkcije.php");
    require_once("../classes/Lectures.php");

    checkLoginAndPaid();


    if(!isset($_POST['text']) || empty(trim($_POST['text']))) 
    {
        dieNew("Greska: Niste uneli text.");
    }
    if(!isset($_POST['lecture']) || empty(trim($_POST['lecture']))) 
    {
        dieNew("Greska: Niste izabarali predavanje.");
    }
    if(!isset($_POST['lecturename']) || empty(trim($_POST['lecturename']))) 
    {
        dieNew("Greska: Nema naziva predavanja.");
    }
    $text = $_POST['text'];
    $lecture = $_POST['lecture'];
    if(strlen($text) < 6 || strlen($text) > 256)
    {
        dieNew("Greska: Komentar ne moze biti kraci od 6 i duzi od 256 karaktera.");
    }
    $user = new Lectures();
    $user->addComment($_SESSION['name'],$_POST['text'],$_POST['lecture'],$_POST['teacher'],$_POST['lecturename']); 
    
    
?>