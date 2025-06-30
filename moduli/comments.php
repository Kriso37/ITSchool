<?php 
    require_once ($_SERVER['DOCUMENT_ROOT']. "/Projekat2/funkcije.php");
    require_once "../header.php";
    require_once ("../classes/Session.php");
    new Session();
    
    checkLoginAndPaidorTeacher();

    require_once "../classes/Lectures.php";
    $lecture = new Lectures();
    if(isset($_SESSION['teacher']))
    {
        $comments = $lecture->getAllCommentsTeacher($_SESSION['name']);
    }
    else
    {
        $comments = $lecture->getAllComments($_SESSION['name']);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script></head>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Komentari</title>
</head>
<body>
    <div class = "container">

        <div class="options">
            
            <?php foreach($comments as $comment):?>
                <div class="option-box" style = "border-color:rgb(0, 123, 255);">  
                    <h1><b><?= $comment['lecturename']?></b></h1>
                    <h4><b>Mentor: <?= $comment['teacher']?></b></h4>
                    <?php if(isset($_SESSION['teacher'])):?>
                    <h4><b>Ucenik: <?= $_SESSION['name'];?></b></h4>
                    <?php endif;?>  
                    <br>
                    <h3><b>Komentar:</b></h3>
                    <h4><?= $comment['text']?></h4>
                    <h3><b>Odgovor:</b></h3>
                    <?php if(empty($comment['respond'])):?>
                    <h4>Mentor nije odgovorio.</h4>   

                    <?php if(isset($_SESSION['teacher'])):?>
                        <form action="commentrespond.php" method="post" class = "flexCenter" style = "flex-direction: column; margin-top:0.5vh;">
                            <input type="hidden" name="teacher" value="<?= $_SESSION['name']; ?>">
                            <input type="hidden" name="name" value="<?= $comment['name']; ?>">
                            <input type="hidden" name="lecture" value="<?= $comment['lecture']; ?>">
                            <input class="input-group-text" style = "margin-top:1.5vh;" type="text" name="text" Placeholder = "Unesite odgovor">
                            <button style = "margin-top:-1.5vh;"class="btn btn-primary">Odgovori</button>
                        </form>
                    <?php endif;?>  

                    <?php else:?>
                    <h4><?= $comment['respond'];?></h4>   

                    <?php if(isset($_SESSION['teacher'])):?>
                        <form action="commentresponddel.php" method="post" class = "flexCenter" style = "flex-direction: column; margin-top:0.5vh;">
                            <input type="hidden" name="name" value="<?= $comment['name']; ?>">
                            <input type="hidden" name="teacher" value="<?= $comment['teacher']; ?>">
                            <input type="hidden" name="lecture" value="<?= $comment['lecture']; ?>">
                            <button style = "background-color:red;"class="btn btn-primary">Obrisi komentar</button>
                        </form>
                    <?php endif;?>  
                    <?php endif;?>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</body>
<style>
    .option-box {
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
    .container {
        width: 100%;
        font-family: cursive;
        max-width: 114vh;
        margin: auto;
        background-color: white;
        padding: 3vh;
        border-radius: 1.2vh;
        box-shadow: 0 0 4vh rgb(0, 123, 255);
        margin-bottom:15vh;
        margin-top:10vh;
        justify-content:start;
    }
    .options {
      display: flex;
      justify-content: space-between;
      gap: 3vh;
      flex-wrap: wrap;
    }
</style>
</html>