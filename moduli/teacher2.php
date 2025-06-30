<?php 
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/header.php");
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/funkcije.php");
    require_once ("../classes/Session.php");
    new Session();

    if(!isset($_SESSION['loggined']))
    {
        header("Location: moduli/login.php");
    }
    else 
    {
        if(!isset($_SESSION['teacher']))
        {
            header("Location: ../index.php");
        }
    }
    require_once "../classes/Lectures.php";
    
    if(!isset($_POST['namelecture']) || empty(trim($_POST['namelecture']))) 
    {
        dieNew("Niste uneli naziv vezbe");
    }
    if(!isset($_POST['number']) || empty(trim($_POST['number'])))  
    {
        dieNew("Niste uneli broj vezbe");
    }
    $number = $_POST['number'];
    if(!is_numeric($number))
    {
        dieNew("Broj vezbe mora biti broj");
    }
    if(strlen($number) < 1 || strlen($number) > 100)
    {
        dieNew("Broj predavanja mora biti veci od 0 i manji od 100");
    }
    

    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/Projekat2/lectures/';
    $allowedTypes = ['video/mp4', 'video/avi', 'video/mov', 'video/webm', 'video/mpeg'];


    $video = $_FILES['video'];

    if ($video['error'] === UPLOAD_ERR_OK) 
    {
        $fileTmpPath = $video['tmp_name'];
        $fileName = $video['name'];
        $fileType = mime_content_type($fileTmpPath);

        if (in_array($fileType, $allowedTypes)) 
        {
            $destination = $uploadDir . $_SESSION['name'] . "_" . $fileName;
            $fileNameBase = $_SESSION['name'] . "_" . $fileName;
            if (move_uploaded_file($fileTmpPath, $destination)) 
            {
                $lecture = new Lectures();
                $lectures = $lecture->Create($_SESSION['name'],$_POST['namelecture'],$fileNameBase,$_POST['number']);
                header("Location: ../index.php");
            } 
            else 
            {
                dieNew("Fajl nije premesten iz nepoznatog razloga");
            }
            } else {
                dieNew("Nepodržan tip fajla: $fileType");
            }
    } 
    else 
    {
        echo "Greška prilikom upload-a: " . $video['error'];
    }
        

?>