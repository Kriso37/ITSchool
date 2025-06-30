<?php 
    require_once "header.php";
    require_once ("classes/Session.php");
    new Session(); 

    if(!isset($_SESSION['loggined']))
    {
        header("Location: moduli/login.php");
    }
    else 
    {
        $paid = 0;
        if(isset($_SESSION['paid']))
        {
            $paid = $_SESSION['paid'];
        }
        if(isset($_SESSION['teacher']))
        {
            $_SESSION['paid'] = 3;
            $paid = 3;
        }
    }
    require_once "classes/Teacher.php";

    $listteacher = new Teacher();
    $listteachers = $listteacher->getAllTeachers();
    require_once "classes/Stars.php";
    $star = new Star();


    if(isset($_SESSION['nomoney']) && $_SESSION['nomoney'] == true)
    {
        $_SESSION['nomoney'] = false;
        prikazi_popup("Nemate dovoljno novca na racunu.");
    }
    else if(isset($_SESSION['alreadypaid']) && $_SESSION['alreadypaid'] == true)
    {
        $_SESSION['alreadypaid'] = false;
        prikazi_popup("Vec imate taj ili veci paket kupljen.");
    }
    else if(isset($_SESSION['successbuy']) && $_SESSION['successbuy'] == true)
    {
        $_SESSION['successbuy'] = false;
        prikazi_popup("Uspesno ste kupili paket.");
    }
?>
    
    
<!DOCTYPE html>
<html lang="sr">
<head>
    
    <title>IT Skola</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class = "flex" style = "margin-top:50px;">
    <img src = "slike/logo.png" width = 400px; class="logo-animation photo">
  </div>
  <?php if(isset($_SESSION['paid'])):?>
  <div class="container" style = "margin-top:100px">
    <h2>Predavanja od:</h2>
    
    <div class="options">
      <?php foreach($listteachers as $teacher):?>
        <div class="option-box" style = "border-color:rgb(0, 123, 255);">  
        <h3><?= $teacher['realname'];?></h3>
        <div style="margin-bottom:1vh">Mentor sa preko <?=$teacher['expyear']?> godina iskustva.</div>
        <div style="margin-bottom:1vh"><b> Ocena: <?= ($rate = $star->getAverageStar($teacher['name'])) > 0 ? $rate : 'Nema'; ?> </b></div>
        <img src = "slike/teachers/<?=$teacher['photo']?>" style = "width:100%; height:20vh; margin-bottom:2vh;">
        <form action="moduli/lectures.php" method="GET">
          <input type="hidden" name="type" value="<?=$teacher['name'];?>">
          <button type="submit" class="pay-button" style = "background-color:rgb(0, 123, 255);">Izaberi</button>
        </form>
        </div>
        <?php endforeach;?>
      
      </div>
    </div>
  </div>
  <?php endif;?>
  <div class="container" style = "margin-top:100px;">
    <h2>Izaberite tip vezbi</h2>
    <div class="options" style = "justify-content:space-evenly; ">

      <div class="option-box" style="<?= ($paid < 1) ? 'border-color: rgb(0, 123, 255);' : 'border-color: rgb(0, 255, 76);' ?>">
        <h3>Običan</h3>
        <div class="price">10€</div>
        <div style="margin-bottom:2vh">Osnovni paket sa pristupom materijalima.</div>
        <form action="moduli/buy.php" method="post">
          <input type="hidden" name="type" value="1">
          <input type="hidden" name="money" value="10">
          <button type="submit" class="pay-button" style = "<?= ($paid < 1) ? 'background-color: rgb(0, 123, 255);' : 'background-color: rgb(0, 255, 76);' ?> "><?= ($paid < 3) ? 'Plati' : 'Kupljeno'?></button>
        </form>
      </div>
        
      
      <div class="option-box" style="<?= ($paid < 2) ? 'border-color: rgb(0, 123, 255);' : 'border-color: rgb(0, 255, 76);' ?>">
        <h3>Mentorski</h3>
        <div class="price">30€</div>
        <div style="margin-bottom:2vh">Ukljucuje mentorstvo i dodatnu podrsku.</div>
        <form action="moduli/buy.php" method="post">
          <input type="hidden" name="type" value="2">
          <input type="hidden" name="money" value="30">
          <button type="submit" class="pay-button" style = "<?= ($paid < 2) ? 'background-color: rgb(0, 123, 255);' : 'background-color: rgb(0, 255, 76);' ?> "><?= ($paid < 3) ? 'Plati' : 'Kupljeno'?></button>
        </form>
      </div>

      
      <div class="option-box" style="<?= ($paid < 3) ? 'border-color: rgb(0, 123, 255);' : 'border-color: rgb(0, 255, 76);' ?>"> 
        <h3>Napredan</h3>
        <div class="price">100€</div>
        <div style="margin-bottom:2vh">Sve iz mentorskog + ekskluzivni sadrzaji.</div>
        <form action="moduli/buy.php" method="post">
          <input type="hidden" name="type" value="3">
          <input type="hidden" name="money" value="100">
          <button type="submit" class="pay-button" style = "<?= ($paid < 3) ? 'background-color: rgb(0, 123, 255);' : 'background-color: rgb(0, 255, 76);' ?> "><?= ($paid < 3) ? 'Plati' : 'Kupljeno'?></button>
        </form>
      </div>
  </div>
  </div>
</body>
</html>

<style>
    h3,h2
    {
        font-family: cursive;
        text-align: center;
        margin-bottom: 3vh;
        font-weight: bold;
    }
    body 
    {
      font-family: cursive;
      background-color:rgb(242, 242, 242);
    }

    .logo-animation 
    {
      animation: pulse 2s infinite ease-in-out;
    }
    .photo
    {
      box-shadow: 0 0 4vh rgb(0, 123, 255);
      border-radius: 50px;
    }


    @keyframes pulse 
    {
      0%,100%
      {
        transform: scale(1);
      }
      50% 
      {
        transform: scale(1.05);
      }
    }

</style>