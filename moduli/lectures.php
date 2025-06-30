<?php 
    require_once ($_SERVER['DOCUMENT_ROOT']. "/Projekat2/funkcije.php");
    require_once "../header.php";
    require_once ("../classes/Session.php");
    new Session();

    checkLoginAndPaid();

    if(!isset($_GET['type']))
    {
        header("Location: ../index.php");
    }
    require_once "../classes/Lectures.php";
    require_once "../classes/Stars.php";
    $lecture = new Lectures();
    $lectures = $lecture->getLecture($_GET['type']);
    $starLecture = new Star();
    
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
    <title>Predavanja od <?= $_GET['type']?></title>
</head>
<body>
    <div class = "container newFont">
        <h1 style = "text-align: center;">Predavanja od: <?= $_GET['type']?></h1>
        <div class="options">
            
            <?php foreach($lectures as $lectur):?>
                <div class="option-box" style = "border-color:rgb(0, 123, 255);">  
                    <h3><?= $lectur['number']?>. <?= $lectur['name']?></h3>
                    <video width="100%" height="240" controls>
                        <?php echo $lectur['video'];?>
                        <source src="../lectures/<?=$lectur['video']?>" type="video/mp4">
                        Video od predavanja
                        
                    </video>




                    <?php for($star = 1;$star<6;$star++):?>

                        <form action="star.php" method="post" style="display:inline;">
                            <input type="hidden" name="star" value="<?= $star ?>">
                            <input type="hidden" name="lecture" value="<?= $lectur['id'] ?>">
                            <input type="hidden" name="teacher" value="<?= $_GET['type'] ?>">
                            <button type="submit" class = "star"> <?= ($starLecture->getStars($lectur['id'],$_SESSION['name'],$star)) ? "&#9733;" : "&#9734;";?></button>
                        </form>
                    <?php endfor;?>

                    <?php if($lecture->getComment($lectur['id'],$_SESSION['name'])):?>
                        <form action="commentadd.php" method="post" class = "flexCenter" style = "flex-direction: column; margin-top:0.5vh;">
                            <input type="hidden" name="lecture" value="<?= $lectur['id'] ?>">
                            <input type="hidden" name="teacher" value="<?= $_GET['type'] ?>">
                            <input type="hidden" name="lecturename" value="<?= $lectur['name'] ?>">
                            <input class="input-group-text"  type="text" name="text" Placeholder = "Unesite komentar">
                            <button class="btn btn-primary">Napisi komentar</button>
                        </form>
                    <?php else:?>
                        <h4 style = "margin-top:4.5vh;"><b>Komentar je poslan mentoru.</b></h4>
                        <form action="commentremove.php" method="post" class = "flexCenter" style = "flex-direction: column; margin-top:0.5vh;">
                            <input type="hidden" name="lecture" value="<?= $lectur['id'] ?>">
                            <input type="hidden" name="teacher" value="<?= $_GET['type'] ?>">
                            <button class="btn btn-primary" style = "background-color:red;">Obrisi komentar</button>
                        </form>
                    <?php endif;?>

                </div>
            <?php endforeach;?>
        </div>
    </div>
</body>
<style>
    .star {
        border: none; 
        background: none; 
        cursor: pointer; 
        font-size:25px;
    }
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