<?php 
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/header.php");
    require_once ("../classes/Session.php");
    new Session();
    if(!isset($_SESSION['admin']))
    {
        header("Direction: ../index.php");
    }
    require_once "../classes/Users.php";


    $users = new Users();
    $allusers = $users->GetAllUsers();
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
        <?php if(isset($_SESSION['admin'])): ?>
        <div class = "newFont flex">
            <form action="/Projekat2/moduli/teacheradd.php" method="post" enctype="multipart/form-data">
                <div class = "flexCenter">
                    <input class="input-group-text" required type="text" name="name" Placeholder = "Unesite ime korisnika">
                    <input class="input-group-text" required type="text" name="realname" Placeholder = "Unesite pravo ime">
                    <input class="input-group-text" required type="number" name="expyear" Placeholder = "Unesite godina iskustva">
                    <input class="input-group-text" required type="file" name="photo" accept="image/*">
                    <button class="btn btn-primary">Dodaj mentora</button>
                </div>
            </form>
            </div>
        <div class = "newFont flex">
            <form action="/Projekat2/moduli/teacherremove.php" method="post">
                <div class = "flexCenter">
                    <input class="input-group-text"  required type="text" name="name" Placeholder = "Unesite ime mentora">
                    <button class="btn btn-primary" style = "background-color:red;">Obrisi mentora</button>
                </div>
            </form>
        </div>
        <?php endif; ?>
    </body>
</html>