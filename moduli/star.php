<?php 


    require_once "../funkcije.php";
    require_once "../classes/Stars.php";
    require_once ("../classes/Session.php");
    new Session();
    
    checkLoginAndPaid();

    if(!isset($_POST['lecture'])  || empty(trim($_POST['lecture'])) )
    {
        dieNew("Greska: Niste uneli lekciju.");
    }
    if(!isset($_POST['star']) || empty(trim($_POST['star'])))
    {
        dieNew("Greska: Niste izabrali zvezdicu.");
    }
    if(!isset($_POST['teacher']) || empty(trim($_POST['teacher'])))
    {
        dieNew("Greska: Niste izbarali mentora.");
    }
    $star = $_POST['star'];
    $lecture = $_POST['lecture'];
    $nameuser = $_SESSION['name'];
    $teacher = $_POST['teacher'];
    if($star < 1 || $star > 5)
    {
        dieNew("Greska: Ocena mora biti veca od 0 i manja od 6.");
    }
    
    $newstar = new Star();
    $newstar->CreateStar($nameuser,$star,$lecture,$teacher);
    
