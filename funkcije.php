<?php

    function dieNew($message)
    {
        return die('
        <div style="
            font-family:cursive;
            position: fixed;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            font-family: Arial, sans-serif;
            text-align: center;
            z-index: 9999;
            max-width: 90vw;
        ">
            <p style="font-size: 18px; margin-bottom: 25px;">' . $message . '</p>
            <button onclick="window.location.href=\'/Projekat2/index.php\';" style="
                background-color: #007bff;
                color: white;
                border: none;
                padding: 10px 25px;
                font-size: 16px;
                border-radius: 6px;
                cursor: pointer;
            ">Nazad</button>
        </div>
        ');
    }
    function checkLogin()
    {
        if(!isset($_SESSION['loggined']))
        {
            header("Location: moduli/login.php");
        }
    }
    function checkLoginAndPaid()
    {
        if(!isset($_SESSION['loggined']))
        {
            header("Location: moduli/login.php");
        }
        else 
        {
            if(isset($_SESSION['paid']))
            {
                if($_SESSION['paid'] == 0)
                {
                    header("Location: ../index.php");
                }
            }
            else 
            {
                header("Location: ../index.php");
            }
        }
    }
    function checkLoginAndPaidorTeacher()
    {
        if(!isset($_SESSION['loggined']))
        {
            header("Location: moduli/login.php");
        }
        else 
        {
            if(isset($_SESSION['paid']))
            {
                if($_SESSION['paid'] == 0)
                {
                    header("Location: ../index.php");
                }
            }
            else 
            {
                if(!isset($_SESSION['teacher']))
                {
                    header("Location: ../index.php");
                }
            }
        }
    }
    function checkLoginAndTeacher()
    {
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
    }
    function prikazi_popup($poruka) {
        if (!empty($poruka)) {
            echo '
            <div style="
                font-family:cursive;
                position: fixed;
                top: 30%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: white;
                padding: 20px;
                border: 7px solid #333;
                box-shadow: 0 0 15px rgba(0,0,0,1);
                z-index: 9999;
                width:45vh;
                text-align: center;
            ">
                <strong>' . $poruka . '</strong><br><br>
                <a href="' . strtok($_SERVER["REQUEST_URI"], '?') . '">Zatvori</a>
            </div>
            <div style="
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.5);
                z-index: 9998;
            "></div>';
        }
    }
        function prikazi_popupbuy($poruka) {
        if (!empty($poruka)) {
            echo '
            <div style="
                font-family:cursive;
                position: fixed;
                top: 30%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: white;
                padding: 20px;
                border: 7px solid #333;
                box-shadow: 0 0 15px rgba(0,0,0,1);
                z-index: 9999;
                width:45vh;
                text-align: center;
            ">
                <strong>' . $poruka . '</strong><br><br>
                <a href="' . "/Projekat2/moduli/buysuccess.php?type=".$_POST['type'] . '">Kupi</a>
            </div>
            <div style="
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.5);
                z-index: 9998;
            "></div>';
        }
    }
?>