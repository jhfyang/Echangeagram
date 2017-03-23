
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Profil</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href='http://fonts.googleapis.com/css?family=Dancing+Script:700' rel='stylesheet' type='text/css'>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="script.js"></script>
    </head>

		<body>

            <?php
                include("barreoutils.php");
            ?>

      <?php
          $bdd3 = new PDO("mysql:host=localhost;dbname=librarie", "root", "");
          $requeteMesP = $bdd3->query("SELECT * FROM profil");
            if (isset($_POST['confemail']) AND !empty($_POST['confemail']) AND isset($_POST['adm']) AND !empty($_POST['adm'])) {
              $tmpmail = $_POST['confemail'];
              $requeteMod = $bdd3->prepare("UPDATE profil SET admin = ? WHERE email=\"$tmpmail\" ");
              $requeteMod->execute(array($_POST['adm']));
              echo $_POST['adm'] .   $tmpmail ;
            }

            if (isset($_POST['confemailsupp']) AND !empty($_POST['confemailsupp'])) {
              $requeteMod = $bdd3->prepare("DELETE FROM profil WHERE email=? ");
              $requeteMod->execute(array($_POST['confemailsupp']));
            }
       ?>

           <?php
           while($result = $requeteMesP->fetch())
           {

           ?>
           <a href="inscriptionadmin.php">
           <input type="button" value="+" id="addprof" class="plus">
           </a>
         <div class="profiladmin">
             <form name="suprim" action="admin.php" method="post">
                 <hr class="traitadmin1">
                 <img src="<?php echo $result['profil_picture'];?>" class="photoadmin">
                 <div class="info">
                     <a href="profil.php?email=<?php echo $result['email'];?>"><p><?php echo $result['nom'] . " " . $result['prenom'];?>  </p></a>
                     <p><?php echo $result['email'];?></p>
                 </div>
                <input type="button" name="<?php echo $result['email'];?>" value="Privilèges" data-id="bloca<?php echo $result['nom'] . $result['prenom'];?>" class="adminprivi bouton">
                 <input type="button" class="adminsup" value="Supprimer"  data-id="blocs<?php echo $result['nom'] . $result['prenom'];?>">
                 <hr class="traitadmin2">
             </form>
           </div>
             <div class="choix_admin" id="bloca<?php echo $result['nom'] . $result['prenom'];?>">
                <form name="modifiera" onSubmit="return formValidation();" action="admin.php" method="post">
                 <p>Information: <?php echo $result['email'];?></p>
                 <p>- Un auteur peut publier ses photos, les renommer, modifier ses paramètres. </p>
                 <p>- Un administrateur peut, en plus, supprimer ou ajouter des utilisateurs.</p>
                 <div id="choix_radio">
                    <input type="radio" name="adm" value="1"/> <label>Administrateur</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="adm" value="0"/> <label>Auteur</label>
                 </div>
                 <input type="text" name="confemail" value="<?php echo $result['email'];?>" required class="form inp2" id="confmail" />
                 <input type="submit" class="bouton choiradio" value="Valider">
                 </form>
             </div>
             <div class="supp_admin" id="blocs<?php echo $result['nom'] . $result['prenom'];?>">
                <form name="supprimera" action="admin.php" method="post">
                 <p>Information: <?php echo $result['email'];?></p>
                 <p> Voulez-vous vraiement supprimer ce compte ? </p>
                 <input type="text" name="confemailsupp" placeholder="Confirmez e-mail pour la supression" required class="form inp2" id="confmail" value="<?php echo $result['email'];?>" />
                 <input type="submit" class="bouton" id="asuppBouton" value="Valider">
                 </form>
             </div>

           <?php
           }
           ?>
  

        </body>
</html>
