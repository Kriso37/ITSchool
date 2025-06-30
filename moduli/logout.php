<?php
    require_once ("../classes/Session.php");
    new Session(); 
    session_destroy();
    
    header("Location: ../index.php");
