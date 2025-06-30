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
        dieNew("Greska: Niste uneli ime korisnika.");
    }
    if(!isset($_POST['realname']) || empty(trim($_POST['realname']))) 
    {
        dieNew("Greska: Niste uneli pravo ime korisnika.");
    }
    if(!isset($_POST['expyear']) || empty(trim($_POST['expyear']))) 
    {
        dieNew("Greska: Niste uneli godina iskustva.");
    }
    if(!is_numeric($_POST['expyear']))
    {
        dieNew("Greska: Godine iskustva mora biti broj.");
    }
    if($_POST['expyear'] < 0 || $_POST['expyear'] > 20)
    {
        dieNew("Greska: Godine iskustva moraju biti iznad 1 i ispod 20 godina.");
    }


    if (isset($_FILES)) 
    {
        $photo = $_FILES['photo'];
        $destination = $_SERVER['DOCUMENT_ROOT']. "/Projekat2/slike/teachers/" .$_POST['name']."_". $photo["name"];
        $allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
        if (!in_array($photo['type'], $allowedTypes)) {
            dieNew("Greska: Dozvoljeni su samo JPG, PNG, GIF i WEBP tipovi fajla.");
        }
        if (move_uploaded_file($photo["tmp_name"], $destination)) 
        {
            $teacher = new Teacher();
            $teacher->Create($_POST['name'],$_POST['realname'],$_POST['expyear'],$_POST['name']."_". $photo["name"]);
        } 
        else 
        {

            dieNew("Slika nije uspesno uploadovana.");
        }
    }
    else 
    {
        dieNew("Niste dodali sliku mentoar.");
    }

    
    
    