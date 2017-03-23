<!DOCTYPE html>
<html>
  <head>
          <meta charset="utf-8" />
      <title>Gallerie</title>
      <link rel = "stylesheet" href="style.css"/>
      <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
      <script src="script.js"></script>

  </head>


  <body>
			<?php include("barreoutils.php"); ?>
      <?php
      $theme = $_GET['theme'];
      $bdd = new PDO("mysql:host=localhost;dbname=librarie", "root", "");
      $mailSes=$_SESSION['email'];
      $requete =  $bdd->query("SELECT * FROM photos WHERE theme=\"$theme\" AND statut='0'");

      if(isset($_POST['photoid'])){
          $tmpma = $_SESSION['email'];
          $tmpid = $_POST['photoid'];
          echo $tmpid;
          echo $tmpma;
          $jafav = $bdd->query("INSERT INTO favoris VALUES ('$tmpma', '$tmpid', NULL)");
      }

      ?>

      <div class="popup_img">
          <?php
          while($result = $requete->fetch())
          {
            $tempemail = $result['email'];
            $requetePf = $bdd->query("SELECT * FROM profil WHERE email=\"$tempemail\"");
            $resultPf = $requetePf->fetch();
          ?>
          <div id="popup_img<?php echo $result['idphoto']; ?>" class="popup_block">
               <img src="<?php echo $result['path']; ?>" class="popup_image portrait" alt="Cedric Content">
               <div class="comments" >
                  <a href="profil.php?email=<?php echo $result['email'];?>" id="Xprofil" ><?php echo $resultPf['prenom']; ?> <?php echo $resultPf['nom']; ?> <?php echo $result['commentaire']; ?>Lieu :<?php echo $result['lieu']; ?> Date :
                    <?php echo $result['date']; ?></a>
                    <form name="ajoutfav" action="profil.php?email=<?php echo $tempemail;?>" method="post">
                     <input type="text" name="photoid" value="<?php echo $result['idphoto'];?>" required class="form inp2 photoid">
                    <input type="submit" class="bouton" id="like" value="<3" >
                  </form>
                  <?php
                  if($tempemail==$mailSes){


                  ?>
                  <form name="modifierphotos" action="modifierphoto.php?idphoto=<?php echo $result['idphoto'];?>" method="post">
                  <a href="modifierphoto.php?idphoto=<?php echo $result['idphoto'];?>">
                   <input type="text" name="photoid2" value="<?php echo $result['idphoto'];?>" required class="form inp2 photoid">
                    <input type="submit" class="bouton2" id="plus" value="...">
                    </a>
                  </form>
                  <?php
                    }
                   ?>
               </div>
          </div>
          <?php
          }
          ?>
      </div>

      <?php

      $bdd2 = new PDO("mysql:host=localhost;dbname=librarie", "root", "");

      $requete2 =  $bdd2->query("SELECT * FROM photos WHERE statut='0' AND theme=\"$theme\"");
      ?>

      <div class="fullcontent" >
          <div id="gallerie" class="gallerie">

          <?php
          while($result2 = $requete2->fetch())
          {
          ?>

              <div class="thumbnail">
                <div class="thumno">
                  <a target="_blank" href="#" data-width="60%" data-rel="popup_img<?php echo $result2['idphoto']; ?>" class="poplight">
                      <img src="<?php echo $result2['path']; ?>" class="landscape" alt="Cedric Content">
                  </a>
                </div>
                <div class="titlealbum">
                    <p class="soustitre"><?php echo $result2['titre_photo']; ?></p>
                </div>
              </div>

          <?php
          }
          ?>

          </div>
      </div>
  </body>
</html>
