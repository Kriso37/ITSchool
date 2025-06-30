<?php 
    require_once ("../classes/Session.php");
    new Session();
    if(!isset($_SESSION['loggined']))
    {
        header("Location: ../index.php");
    }
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/header.php");
    require_once ($_SERVER['DOCUMENT_ROOT']. "/Projekat2/funkcije.php");
    require_once("../classes/Users.php");

?>
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Profile</title>
</head>
<body>
    <div class="container " style = "margin-top:100px">
        <div class="options " style = "justify-content:center;">

            <div class="profile-box" style = "border-color:rgb(0, 123, 255);">  
                <div>
                <h2><?= $_SESSION['name']?></h2>

                <h4><?= $_SESSION['email']?></h4>
                <h4>Novac: <?= $_SESSION['money']?>$</h4>
                </div>
            </div>
        </div>
    </div>
</body>
<style>
    .profile-box {
        flex: 1;
        min-width: 29vh;
        max-width: 33vh;
        border: 0.2vh solid rgb(204, 204, 204);
        border-radius: 1.2vh;
        padding: 2.6vh;
        background-color:rgb(250, 250, 250);
        text-align: center;
        transition: all 0.3s ease;
    }

</style>
</html>
    
    