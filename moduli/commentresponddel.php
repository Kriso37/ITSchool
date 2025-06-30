<?php 

    require_once ("../classes/Session.php");
    new Session();
    require_once($_SERVER['DOCUMENT_ROOT']. "/Projekat2/header.php");
    require_once ($_SERVER['DOCUMENT_ROOT']. "/Projekat2/funkcije.php");
    require_once("../classes/Lectures.php");

    checkLoginAndTeacher();

    $lecture = new Lectures();
    $lecture->teacherRespondDel($_POST['teacher'],$_POST['name'],$_POST['lecture']); 

?>