<?php 
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/header.php");
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

?>

<!DOCTYPE html>
<html lang="en">
    
    <head> 
        <link rel="stylesheet" type="text/css" href="/Projekat2/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script></head>
       
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       
    </head>

    <body>
        <?php if(isset($_SESSION['loggined']) && isset($_SESSION['teacher']) ): ?>
        <div class = "newFont flex">
            <form action="/Projekat2/moduli/teacher2.php" method="post" enctype="multipart/form-data">
            <div class = "flexCenter">
                <input class="input-group-text" required type="text" name="namelecture" Placeholder = "Unesite naziv predavanja">
                <input class="input-group-text" required type="number" name="number" Placeholder = "Broj vezbe">
                <input class="input-group-text" required type="file" id="video" name="video" accept="video/*">
                <button class ="btn btn-primary">Dodaj vezbu</button>
            </div>
        </div>
        <?php endif; ?>
    </body>
</html>