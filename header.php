<?php
    require_once ("classes/Session.php");
    new Session(); 
?>
    
    
<!DOCTYPE html>
<html lang="sr">

    <head>
        <link rel="stylesheet" href="/Projekat2/style.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <div class="w3-top newFont" style = "margin-bottom:100px;">
            <div class="w3-bar w3-black w3-card center">
                <a href="/Projekat2/index.php" class="w3-bar-item w3-button w3-padding-large">HOME</a>

                <?php if(!isset($_SESSION['loggined'])):?> 
                    <a href="/Projekat2/moduli/login.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">LOGIN</a>
                    <a href="/Projekat2/moduli/register.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">REGISTER</a>
                <?php else:?>
                    
                    <a href="/Projekat2/moduli/logout.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">LOGOUT</a>
                    <?php if(isset($_SESSION['admin'])):?> 
                    <a href="/Projekat2/moduli/admin.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">ADMIN</a>
                    <?php endif;?>
                    <?php if(isset($_SESSION['teacher'])):?> 
                        <a href="/Projekat2/moduli/teacher.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">TEACHER</a>
                    <?php endif;?>
                    <?php if(isset($_SESSION['paid']) > 0):?> 
                        <a href="/Projekat2/moduli/comments.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">COMMENTS</a>
                    <?php endif;?>
                    
                    <a href="/Projekat2/moduli/profile.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-right">PROFILE</a>

                <?php endif;?>
                <div class="w3-dropdown-hover w3-hide-small"></div>
            </div>
        </div>
    </body>

</html>