<?php 


    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/header.php");
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/classes/Session.php");
    new Session();
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/funkcije.php");
    checkLogin();
    if(isset($_SESSION['loggined']))
    {
        if($_SESSION['paid'] < $_POST['type'])
        {
            if($_SESSION['money'] >= $_POST['money'])
            {
                if($_SESSION['paid'] < $_POST['type'])
                {
                    prikazi_popupbuy("Da li ste sigurno da zelite da kupite ovaj paket?");
                }
            }
            else 
            {
                header ("Location: ../index.php");
                $_SESSION['nomoney'] = true;
                $_SESSION['alreadypaid'] = false;
            }
        }
        else
        {
            $_SESSION['alreadypaid'] = true;
            header ("Location: ../index.php");         
        }
    }
?>