
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Profil</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="script.js"></script>
    </head>

		<body>
      <?php
          include("barreoutils.php");
      ?>
      <?php
          $bdd3 = new PDO("mysql:host=localhost;dbname=librarie", "root", "");
          $mailSes = 	$_GET['email'];
          $mailSes2 = $_SESSION['email'];
          $requetePro = $bdd3->query("SELECT * FROM profil WHERE email=\"$mailSes\"");
          $resultPro = $requetePro->fetch();
          if(isset($_POST['photoid'])){
              $tmpma = $_SESSION['email'];
              $tmpid = $_POST['photoid'];
              echo $tmpid;
              echo $tmpma;
              $jafav = $bdd3->query("INSERT INTO favoris VALUES ('$tmpma', '$tmpid', NULL)");
          }
          if(isset($_POST['album'])){
              $tmpidal = $_POST['album'];
              $tmpidphoto = $_POST['photoalbid'];
              $jajou = $bdd3->query("INSERT INTO albumphoto VALUES ('$tmpidal', '$mailSes', '$tmpidphoto', NULL)");
          }
      ?>
			<div>
				<h3 id="profil_nom"><?php echo $resultPro['prenom'] . " " . $resultPro['nom']; ?></h3>
			</div>
              <div ><img src="<?php echo $resultPro['profil_picture'] ;?>" id="profilphoto"></div>

			<table id="profilmenu">
				<tr>
					<td><a href="profil.php?email=<?php echo $mailSes;?>">Photos</a></td>
					<td><a href="album.php?email=<?php echo $mailSes;?>">Albums</a></td>
					<td class="encadre"><a href="favoris.php?email=<?php echo $mailSes;?>">Favoris</a></td>
				</tr>
			</table>

      <?php

if ($mailSes==$_SESSION['email']) {
          $requeteProF = $bdd3->query("SELECT * FROM favoris WHERE email=\"$mailSes\"");
          ?>
          <div class="popup_img">
            <?php
          while($resultProF = $requeteProF->fetch())
          {
            $idphoto = $resultProF['idphoto'];
            $emailfav = $resultProF['email'];
            $requetePhoF = $bdd3->query("SELECT * FROM photos WHERE idphoto=\"$idphoto\"");
            $resultPhoF = $requetePhoF->fetch();
            $emailphoto = $resultPhoF['email'];
            $reqemailPho = $bdd3->query("SELECT * FROM profil WHERE email=\"$emailphoto\"");
            $resemailPro = $reqemailPho->fetch();
            ?>
            <div id="popup_img<?php echo $resultPhoF['idphoto']; ?>" class="popup_block">
                 <img src="<?php echo $resultPhoF['path']; ?>" class="popup_image portrait" alt="Cedric Content">
                 <div class="exif" id="exif<?php echo $resultPhoF['idphoto'];?>">
                     <?php

                      if($exif = exif_read_data($resultPhoF['path'], 0, true)){
                        foreach ($exif as $key => $section) {
                            foreach ($section as $name => $val) {
                                echo "$key.$name: $val<br />\n";
                            }
                        }
                      } else {
                        echo "Exif info non disponible";
                      }
                      ?>
                  <input type="button" class="adminsup closeExif" value="x">
                 </div>
                 <div class="comments" >
                     <input type="button" data-rel="exif<?php echo $resultPhoF['idphoto'];?>" class="bouton2 exifbut" value="Exif">
                    <a href="profil.php?email=<?php echo $mailSes?>" id="Xprofil" ><?php echo $resemailPro['prenom'];?> &nbsp; <?php echo $resemailPro['nom']; ?> <?php echo $resultPhoF['commentaire']; ?> Lieu :<?php echo $resultPhoF['lieu']; ?> Date :
                      <?php echo $resultPhoF['date']; ?></a>
                      <form name="ajoutfav" action="profil.php?email=<?php echo $mailSes;?>" method="post">
                       <input type="text" name="photoid" value="<?php echo $resultPhoF['idphoto'];?>" required class="form inp2 photoid">
                      <input type="submit" class="bouton" id="like" value="<3" >
                    </form>
                    <form name="modifierphotos" action="modifierphoto.php?idphoto=<?php echo $resultPhoF['idphoto'];?>" method="post">
                    <a href="modifierphoto.php?idphoto=<?php echo $resultPhoF['idphoto'];?>">
                     <input type="text" name="photoid2" value="<?php echo $resultPhoF['idphoto'];?>" required class="form inp2 photoid">
                      <input type="submit" class="bouton2" id="plus" value="...">
                      </a>
                    </form>
                    <form name="ajoutalbum" method="post" class="plplplpl">
                        <input type="text" name="photoalbid" value="<?php echo $resultPhoF['idphoto'];?>" required class="form inp2 photoid">
                        <div class="albumlisto" id="list<?php echo $resultPhoF['idphoto'];?>">
                          <label for="AlbumName"></label>
                         <select name="album" class="albumlist">
                                  <?php
                                      $requestListe = $bdd3->query("SELECT * FROM albums WHERE email=\"$mailSes\"");
                                      while($resultListe = $requestListe->fetch()){
                                          echo '<option value="'. $resultListe['id_album'] . '">' . $resultListe['titre_album'] .'</option>';
                                      }
                                  ?>
                          </select>
                          <input type="submit" class="bouton validerajoutalbum" id="validerajoutalbum<?php echo $resultPhoF['idphoto'];?>" value="valider">
                          <input type="button" class="bouton closeem" id="closeem<?php echo $resultPhoF['idphoto'];?>" value="x">
                      </div>
                        <input type="button" data-rel="list<?php echo $resultPhoF['idphoto'];?>" class="bouton ajoutalbum" value="+">
                    </form>
                 </div>
            </div>
            <?php
          }
          ?>
        </div>

     <?php
         $requeteProF2 = $bdd3->query("SELECT * FROM favoris WHERE email=\"$mailSes\"");
    ?>

      <div class="fullcontent"  >
          <div id="gallerieProfil" class="gallerie">

            <?php
            while($resultProF2 = $requeteProF2->fetch())
            {
              $idphoto = $resultProF2['idphoto'];
              $emailfav = $resultProF2['email'];
              $requetePhoF2 = $bdd3->query("SELECT * FROM photos WHERE idphoto=\"$idphoto\"");
              $resultPhoF2 = $requetePhoF2->fetch();
            ?>
                <div class="thumbnail">
                  <div class="thumno">
                    <a href="#" data-width="60%" data-rel="popup_img<?php echo $resultPhoF2['idphoto']; ?>" class="poplight">
                        <img src="<?php echo $resultPhoF2['path']; ?>" class="landscape" alt="<?php echo $resultPhoF2['titre_photo']; ?>">
                    </a>
                  </div>
                  <div class="titlealbum">
                      <p class="soustitre"><?php echo $resultPhoF2['titre_photo']; ?></p>
                  </div>
                </div>

                <?php
                }
                ?>
                </div>
            </div>
            <?php
              }
      ?>
      <?php

if ($mailSes!=$_SESSION['email']) {
          $requeteProF = $bdd3->query("SELECT * FROM favoris WHERE email=\"$mailSes\"");
          ?>
          <div class="popup_img">
            <?php
          while($resultProF = $requeteProF->fetch())
          {
            $idphoto = $resultProF['idphoto'];
            $emailfav = $resultProF['email'];
            $requetePhoF = $bdd3->query("SELECT * FROM photos WHERE idphoto=\"$idphoto\" AND statut=0");
            $resultPhoF = $requetePhoF->fetch();
            $emailphoto = $resultPhoF['email'];
            $reqemailPho = $bdd3->query("SELECT * FROM profil WHERE email=\"$emailphoto\"");
            $resemailPro = $reqemailPho->fetch();
            ?>
            <div id="popup_img<?php echo $resultPhoF['idphoto']; ?>" class="popup_block">
                 <img src="<?php echo $resultPhoF['path']; ?>" class="popup_image portrait" alt="Cedric Content">
                 <div class="exif" id="exif<?php echo $resultPhoF['idphoto'];?>">
                     <?php

                      if($exif = exif_read_data($resultPhoF['path'], 0, true)){
                        foreach ($exif as $key => $section) {
                            foreach ($section as $name => $val) {
                                echo "$key.$name: $val<br />\n";
                            }
                        }
                      } else {
                        echo "Exif info non disponible";
                      }
                      ?>
                  <input type="button" class="adminsup closeExif" value="x">
                 </div>
                 <div class="comments" >
                     <input type="button" data-rel="exif<?php echo $resultPhoF['idphoto'];?>" class="bouton2 exifbut" value="Exif">
                    <a href="profil.php?email=<?php echo $mailSes?>" id="Xprofil" ><?php echo $resemailPro['prenom'];?> &nbsp; <?php echo $resemailPro['nom']; ?> <?php echo $resultPhoF['commentaire']; ?> Lieu :<?php echo $resultPhoF['lieu']; ?> Date :
                      <?php echo $resultPhoF['date']; ?></a>
                      <form name="ajoutfav" action="profil.php?email=<?php echo $mailSes;?>" method="post">
                       <input type="text" name="photoid" value="<?php echo $resultPhoF['idphoto'];?>" required class="form inp2 photoid">
                      <input type="submit" class="bouton" id="like" value="<3" >
                    </form>
                    <form name="ajoutalbum" method="post" class="plplplpl">
                        <input type="text" name="photoalbid" value="<?php echo $resultPhoF['idphoto'];?>" required class="form inp2 photoid">
                        <div class="albumlisto" id="list<?php echo $resultPhoF['idphoto'];?>">
                          <label for="AlbumName"></label>
                         <select name="album" class="albumlist">
                                  <?php
                                      $requestListe = $bdd3->query("SELECT * FROM albums WHERE email=\"$mailSes2\"");
                                      while($resultListe = $requestListe->fetch()){
                                          echo '<option value="'. $resultListe['id_album'] . '">' . $resultListe['titre_album'] .'</option>';
                                      }
                                  ?>
                          </select>
                          <input type="submit" class="bouton validerajoutalbum" id="validerajoutalbum<?php echo $resultPhoF['idphoto'];?>" value="valider">
                          <input type="button" class="bouton closeem" id="closeem<?php echo $resultPhoF['idphoto'];?>" value="x">
                      </div>
                        <input type="button" data-rel="list<?php echo $resultPhoF['idphoto'];?>" class="bouton ajoutalbum" value="+">
                    </form>
                 </div>
            </div>
            <?php
          }
          ?>
        </div>

     <?php
         $requeteProF2 = $bdd3->query("SELECT * FROM favoris WHERE email=\"$mailSes\"");

    ?>

      <div class="fullcontent"  >
          <div id="gallerieProfil" class="gallerie">

            <?php
            while($resultProF2 = $requeteProF2->fetch())
            {
              $idphoto = $resultProF2['idphoto'];
              $emailfav = $resultProF2['email'];
              $requetePhoF2 = $bdd3->query("SELECT * FROM photos WHERE statut=0 AND idphoto=\"$idphoto\" ");

              while($resultPhoF2 = $requetePhoF2->fetch())
              {
            ?>
                <div class="thumbnail">
                  <div class="thumno">
                    <a href="#" data-width="60%" data-rel="popup_img<?php echo $resultPhoF2['idphoto']; ?>" class="poplight">
                        <img src="<?php echo $resultPhoF2['path']; ?>" class="landscape" alt="<?php echo $resultPhoF2['titre_photo']; ?>">
                    </a>
                  </div>
                  <div class="titlealbum">
                      <p class="soustitre"><?php echo $resultPhoF2['titre_photo']; ?></p>
                  </div>
                </div>

                <?php
                }

                ?>
            <?php
            }

            ?>
          </div>
      </div>
            <?php
              }
      ?>
			<hr id="menu" >

 		</body>
</html>
