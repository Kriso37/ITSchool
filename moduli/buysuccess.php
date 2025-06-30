<?php 

    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/header.php");
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/classes/Session.php");
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/classes/Users.php");
    new Session();
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/funkcije.php");
    checkLogin();
    $price = [0,10,30,100];
    if(isset($_SESSION['loggined']))
    {
        if($_SESSION['paid'] < $_GET['type'])
        {
            if($_SESSION['money'] >= $price[$_GET['type']])
            {
                if($_SESSION['paid'] < $_GET['type'])
                {
                    $user = new Users();
                    $user->buy($_GET['type'],$price[$_GET['type']]);
                }
            }
            else 
            {
                header ("Location: ../index.php");
                $_SESSION['nomoney'] = true;
                $_SESSION['alreadypaid'] = false;
            }
        }
    }

?>