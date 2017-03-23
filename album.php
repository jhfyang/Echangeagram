
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Albums</title>
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
    $mailSes2 = 	$_SESSION['email'];
    $requetePro = $bdd3->query("SELECT * FROM profil WHERE email=\"$mailSes\"");
    $resultPro = $requetePro->fetch();

    if(isset($_POST['albumTitre']) AND !empty($_POST['albumTitre'])){
      $tmptitre = $_POST['albumTitre'];
      $tmpstatu = $_POST['prive'];
      if($reqalbum = $bdd3->query("INSERT INTO albums VALUES ('$mailSes', '$tmptitre', NULL, '$tmpstatu')")){
        echo $mailSes;
        echo $tmptitre;
        echo $tmpstatu;
      }
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
            <td class="encadre"><a href="album.php?email=<?php echo $mailSes;?>">Albums</a></td>
            <td><a href="favoris.php?email=<?php echo $mailSes;?>">Favoris</a></td>
          </tr>
        </table>

    <input type="button" value="<-" id="return">


    <?php
    if ($mailSes==$_SESSION['email']) {

    $requeteAlb = $bdd3->query("SELECT * FROM albums WHERE email=\"$mailSes\"");
    ?>

    <input type="button" value="+" id="addalb">
    <div id="newalb">
      <div id="alb">
      <form method="post" action="album.php?email=<?php echo $mailSes;?>">
             <input type="text" name="albumTitre" placeholder="Veuillez entrer le nom d'album" required class="form inp2 alb1"><br>
              <div id="chpri" >
                <br>
                        <input type="radio" name="prive" value="1"/> <label>Privée</label>
                        <input type="radio" name="prive" value="0"/> <label>Public</label>
                    </div>
                    <br>
             <input type="submit" class="bouton inp alb1" value="Ajouter Nouveau Album ">
       </form>
     </div>
    </div>

    <div class="fullcontent"  >
      <div id="gallerieProfil" class="gallerie album">
        <?php while($resultAlb = $requeteAlb->fetch())
        {
          $titrealbum = $resultAlb['titre_album'];
          $idalbum = $resultAlb['id_album'];
          $requeteAlbPho = $bdd3->query("SELECT * FROM albumphoto WHERE email=\"$mailSes\" AND id_album=\"$idalbum\"");
          $resultAlbPho = $requeteAlbPho->fetch();
          $tmpphoto = $resultAlbPho['idphoto'];
          $requeteAlbPhoMaster = $bdd3->query("SELECT * FROM photos WHERE idphoto=\"$tmpphoto\"");
          $resultAlbPhoMaster = $requeteAlbPhoMaster->fetch();
          ?>
          <div class="contenualbum">
              <div class="thumbnailalbum" >
                  <div class="thumno grey" >
                  <a href="#" class="albumlight" data-rel="fca<?php echo $resultAlb['id_album'];?>">
                      <img src="<?php echo $resultAlbPhoMaster['path']; ?>" class="landscape albumMaster" alt="<?php echo $resultAlb['titre_album'];?>">
                  </a>
                </div>
                  <div class="titlealbum">
                      <p><?php echo $titrealbum; ?></p>
                  </div>
                </div>
                <div class="galAlbum"  id="fca<?php echo $resultAlb['id_album'];?>">
                    <?php
                      $requeteAlbPho2 = $bdd3->query("SELECT * FROM albumphoto WHERE id_album=\"$idalbum\"");
                    ?>  <p class="titrealbumno"><?php echo $resultAlb['titre_album'];?> </p><?php
                    while($resultAlbPhoGal = $requeteAlbPho2->fetch()){
                      $tmpphotoGal = $resultAlbPhoGal['idphoto'];
                      $requeteAlbPhoMasterGal = $bdd3->query("SELECT * FROM photos WHERE idphoto=\"$tmpphotoGal\"");
                      $result2 =   $requeteAlbPhoMasterGal->fetch();
                      ?>

                      <div class="thumbnail">
                        <div class="thumno">
                          <a href="#" data-width="60%" data-rel="popup_img<?php echo $result2['idphoto']; ?>" class="poplight">
                              <img src="<?php echo $result2['path']; ?>" class="landscape" alt="<?php echo $result2['titre_photo']; ?>">
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
          <?php
          }
        ?>
      </div>
    </div>
    <?php

    $requeteAlb2 = $bdd3->query("SELECT * FROM albums WHERE email=\"$mailSes\"");
    ?>

    <div class="popup_img">
        <?php
        while($result = $requeteAlb2->fetch())
        {
          $tempid = $result['id_album'];
          $requetePf = $bdd3->query("SELECT * FROM albumphoto WHERE email=\"$mailSes\" AND id_album=\"$tempid\"");
          while($resultPf = $requetePf->fetch()){
              $tmpphotopop = $resultPf['idphoto'];
              $request= $bdd3->query("SELECT * FROM photos WHERE idphoto=\"$tmpphotopop\"");
              $requestPf = $bdd3->query("SELECT * FROM profil WHERE email=\"$mailSes\"");
              $resultPf = $requestPf->fetch();
              $result3 = $request->fetch();

        ?>
        <div id="popup_img<?php echo $result3['idphoto']; ?>" class="popup_block">
             <img src="<?php echo $result3['path']; ?>" class="popup_image portrait" alt="Cedric Content">
             <div class="exif" id="exif<?php echo $result3['idphoto'];?>">
                 <?php

                  if($exif = exif_read_data($result3['path'], 0, true)){
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
                 <input type="button" data-rel="exif<?php echo $result3['idphoto'];?>" class="bouton2 exifbut" value="Exif">
                <a href="profil.php?email=<?php echo $result3['email'];?>" id="Xprofil" ><?php echo $resultPf['prenom']; ?> <?php echo $resultPf['nom']; ?> <?php echo $result3['commentaire']; ?>Lieu :<?php echo $result3['lieu']; ?> Date :
                  <?php echo $result3['date']; ?></a>
                  <form name="ajoutfav" action="profil.php?email=<?php echo $mailSes;?>" method="post">
                   <input type="text" name="photoid" value="<?php echo $result3['idphoto'];?>" required class="form inp2 photoid">
                  <input type="submit" class="bouton" id="like" value="<3" >
                </form>
                <form name="modifierphotos" action="modifierphoto.php?idphoto=<?php echo $result3['idphoto'];?>" method="post">
                <a href="modifierphoto.php?idphoto=<?php echo $result3['idphoto'];?>">
                 <input type="text" name="photoid2" value="<?php echo $result3['idphoto'];?>" required class="form inp2 photoid">
                  <input type="submit" class="bouton2" id="plus" value="...">
                  </a>
                </form>
                <form name="ajoutalbum" method="post" class="plplplpl">
                    <input type="text" name="photoalbid" value="<?php echo $result3['idphoto'];?>" required class="form inp2 photoid">
                    <div class="albumlisto" id="list<?php echo $result3['idphoto'];?>">
                      <label for="AlbumName"></label>
                     <select name="album" class="albumlist">
                              <?php
                                  $requestListe = $bdd3->query("SELECT * FROM albums WHERE email=\"$mailSes\"");
                                  while($resultListe = $requestListe->fetch()){
                                      echo '<option value="'. $resultListe['id_album'] . '">' . $resultListe['titre_album'] .'</option>';
                                  }
                              ?>
                      </select>
                      <input type="submit" class="bouton validerajoutalbum" id="validerajoutalbum<?php echo $result3['idphoto'];?>" value="valider">
                      <input type="button" class="bouton closeem" id="closeem<?php echo $result3['idphoto'];?>" value="x">
                  </div>
                    <input type="button" data-rel="list<?php echo $result3['idphoto'];?>" class="bouton ajoutalbum" value="+">
                </form>
             </div>
        </div>
        <?php
            }
        }
        ?>
    </div>
    <?php
    }
    ?>

    <?php
    if ($mailSes!=$_SESSION['email']) {

    $requeteAlb = $bdd3->query("SELECT * FROM albums WHERE email=\"$mailSes\" AND statut='0'");
    ?>



    <div class="fullcontent"  >
      <div id="gallerieProfil" class="gallerie album">
        <?php while($resultAlb = $requeteAlb->fetch())
        {
          $titrealbum = $resultAlb['titre_album'];
          $idalbum = $resultAlb['id_album'];
          $requeteAlbPho = $bdd3->query("SELECT * FROM albumphoto WHERE email=\"$mailSes\" AND id_album=\"$idalbum\"");
          $resultAlbPho = $requeteAlbPho->fetch();
          $tmpphoto = $resultAlbPho['idphoto'];
          $requeteAlbPhoMaster = $bdd3->query("SELECT * FROM photos WHERE idphoto=\"$tmpphoto\"");
          $resultAlbPhoMaster = $requeteAlbPhoMaster->fetch();
          ?>
          <div class="contenualbum">
              <div class="thumbnailalbum" >
                  <div class="thumno grey">
                  <a href="#" class="albumlight" data-rel="fca<?php echo $resultAlb['id_album'];?>">
                      <img src="<?php echo $resultAlbPhoMaster['path']; ?>" class="landscape albumMaster" alt="<?php echo $resultAlb['titre_album'];?>">
                  </a>
                </div>
                  <div class="titlealbum">
                      <p><?php echo $titrealbum; ?></p>
                  </div>
                </div>
                <div class="galAlbum"  id="fca<?php echo $resultAlb['id_album'];?>">
                    <?php
                      $requeteAlbPho2 = $bdd3->query("SELECT * FROM albumphoto WHERE id_album=\"$idalbum\"");
                    while($resultAlbPhoGal = $requeteAlbPho2->fetch()){
                      $tmpphotoGal = $resultAlbPhoGal['idphoto'];
                      $requeteAlbPhoMasterGal = $bdd3->query("SELECT * FROM photos WHERE idphoto=\"$tmpphotoGal\"");
                      $result2 =   $requeteAlbPhoMasterGal->fetch();
                      ?>
                      <div class="thumbnail">
                        <div class="thumno">
                          <a href="#" data-width="60%" data-rel="popup_img<?php echo $result2['idphoto']; ?>" class="poplight">
                              <img src="<?php echo $result2['path']; ?>" class="landscape" alt="<?php echo $result2['titre_photo']; ?>">
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
          <?php
          }
        ?>
      </div>
    </div>
    <?php

    $requeteAlb2 = $bdd3->query("SELECT * FROM albums WHERE email=\"$mailSes\"");
    ?>

    <div class="popup_img">
        <?php
        while($result = $requeteAlb2->fetch())
        {
          $tempid = $result['id_album'];
          $requetePf = $bdd3->query("SELECT * FROM albumphoto WHERE email=\"$mailSes\" AND id_album=\"$tempid\"");
          while($resultPf = $requetePf->fetch()){
              $tmpphotopop = $resultPf['idphoto'];
              $request= $bdd3->query("SELECT * FROM photos WHERE idphoto=\"$tmpphotopop\"");
              $requestPf = $bdd3->query("SELECT * FROM profil WHERE email=\"$mailSes\"");
              $resultPf = $requestPf->fetch();
              $result3 = $request->fetch();

        ?>
        <div id="popup_img<?php echo $result3['idphoto']; ?>" class="popup_block">
             <img src="<?php echo $result3['path']; ?>" class="popup_image portrait" alt="Cedric Content">
             <div class="exif" id="exif<?php echo $result3['idphoto'];?>">
                 <?php

                  if($exif = exif_read_data($result3['path'], 0, true)){
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
                 <input type="button" data-rel="exif<?php echo $result3['idphoto'];?>" class="bouton2 exifbut" value="Exif">
                <a href="profil.php?email=<?php echo $result3['email'];?>" id="Xprofil" ><?php echo $resultPf['prenom']; ?> <?php echo $resultPf['nom']; ?> <?php echo $result3['commentaire']; ?>Lieu :<?php echo $result3['lieu']; ?> Date :
                  <?php echo $result3['date']; ?></a>
                  <form name="ajoutfav" action="profil.php?email=<?php echo $mailSes;?>" method="post">
                   <input type="text" name="photoid" value="<?php echo $result3['idphoto'];?>" required class="form inp2 photoid">
                  <input type="submit" class="bouton" id="like" value="<3" >
                </form>
                <form name="ajoutalbum" method="post" class="plplplpl">
                    <input type="text" name="photoalbid" value="<?php echo $result3['idphoto'];?>" required class="form inp2 photoid">
                    <div class="albumlisto" id="list<?php echo $result3['idphoto'];?>">
                      <label for="AlbumName"></label>
                     <select name="album" class="albumlist">
                              <?php
                                  $requestListe = $bdd3->query("SELECT * FROM albums WHERE email=\"$mailSes2\"");
                                  while($resultListe = $requestListe->fetch()){
                                      echo '<option value="'. $resultListe['id_album'] . '">' . $resultListe['titre_album'] .'</option>';
                                  }
                              ?>
                      </select>
                      <input type="submit" class="bouton validerajoutalbum" id="validerajoutalbum<?php echo $result3['idphoto'];?>" value="valider">
                      <input type="button" class="bouton closeem" id="closeem<?php echo $result3['idphoto'];?>" value="x">
                  </div>
                    <input type="button" data-rel="list<?php echo $result3['idphoto'];?>" class="bouton ajoutalbum" value="+">
                </form>
             </div>
        </div>
        <?php
            }
        }
        ?>
    </div>
    <?php
    }
    ?>
	<hr id="menu" >
</body>
</html>
