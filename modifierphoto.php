 <html>
    <head>
        <meta charset="utf-8" />
        <title> Modifier Profil </title>
        <link rel ="stylesheet"  href="style.css"/>
        <script src="script.js"></script>
<?php
  include("barreoutils.php");
?>
</head>
<?php


$idtest=$_GET['idphoto'];
echo $idtest;


            $bdd = new PDO("mysql:host=localhost;dbname=librarie", "root", "");
            $requetePro = $bdd->query("SELECT * FROM photos WHERE idphoto=\"$idtest\"");
            $resultPro = $requetePro->fetch();
            if(isset($_POST['theme']) AND !empty($_POST['theme']))
                {
                  $requeteMod = $bdd->prepare("UPDATE photos SET theme = ? WHERE idphoto=\"$idtest\"");
                  $requeteMod->execute(array($_POST['theme']));
                }

            if(isset($_POST['description']) AND !empty($_POST['description']))
                {
                  $requeteMod = $bdd->prepare("UPDATE photos SET commentaire = ? WHERE idphoto=\"$idtest\"");
                  $requeteMod->execute(array($_POST['description']));
                }
                if(isset($_POST['nom']) AND !empty($_POST['nom']))
                {
                  $requeteMod = $bdd->prepare("UPDATE photos SET titre_photo = ? WHERE idphoto=\"$idtest\"");
                  $requeteMod->execute(array($_POST['nom']));
                }
                 if(isset($_POST['prive']))
                {
                  $requeteMod = $bdd->prepare("UPDATE photos SET statut = ? WHERE idphoto=\"$idtest\"");
                  $requeteMod->execute(array($_POST['prive']));
                }
                 if(isset($_POST['supprimer']) AND !empty($_POST['supprimer']))
                {
                  $tmpidsup = $_POST['supprimer'];
                  $requeteMod = $bdd->prepare("DELETE FROM photos WHERE idphoto=\"$idtest\"");
                  $requeteMod->execute(array($idtest));
                  $requeteMod2 = $bdd->prepare("DELETE FROM albumphoto WHERE idphoto=\"$idtest\"");
                  $requeteMod2->execute(array($idtest));
                  $requeteMod3 = $bdd->prepare("DELETE FROM favoris WHERE idphoto=\"$idtest\"");
                  $requeteMod3->execute(array($idtest));
                  echo "Deleted data successfully\n";
                }

 ?>


 <body>
<?php
   $url_id = $idtest;
$sql = "SELECT idphoto FROM photos WHERE idphoto='$url_id'";
$result = $bdd->query($sql);

if($result->rowCount() >0){
  ?>
  <div class="login" id="modpho">
           <div id="inscriptionH2"> Modifier les Informations de la photo</div>
           <br> <br>
           <form name="modifierp" onSubmit="return formValidation();" action="modifierphoto.php?idphoto=<?php echo $idtest?>" method="post">

              <div class="modifierBloc">
                   <div class="infoProfil">
                       <p>
                           <?php echo 'nom'; ?>
                       </p>
                   </div>

                         <p>
                         <label for="nom"></label>
                         <input type="text" name="nom" placeholder="Titre à modifier" class="form inp4 modif1" />
                         <input  type="submit" value="Modifier nom" class="inp4 bouton modif2" ></code>
                       </p>

               </div>
               <div class="modifierBloc">
                   <div class="infoProfil">
                       <p>
                           <?php echo 'album'; ?>
                       </p>
                   </div>

                         <p>
                         <label for="album"></label>

                      <select name="album">
                          <option value="alb1">album 1</option>
                          <option value="alb2">album 2</option>
                          <option value="alb3">album 3</option>
                          <option value="alb4">album 4</option>
                      </select>
                      <input type="submit" value="Modifier album" class="inp4 bouton modif2">
                       </p>

               </div>
               <div class="modifierBloc">
                 <div class="infoProfil">
                   <p> Description</p>
                 </div>


                         <label for="nom"></label>
                         <textarea name="description" rows="8" cols="20"> <?php echo $resultPro['commentaire'] ; ?></textarea>

                         <input  type="submit" value="Modifier commentaire" class="inp4 bouton modif2" ></code>


                   </div>

                   <p>

                  <div class="modifierBloc">
                     <div class="infoProfil">
                       <p>
                         <?php echo $resultPro['theme']; ?>
                       </p>
                     </div>
                   <label for="theme"></label>
                      <select name="theme">
                          <option value="th1">Thème 1</option>
                          <option value="th2">Thème 2</option>
                          <option value="th3">Thème 3</option>
                          <option value="th4">Thème 4</option>
                      </select>
                      <input type="submit" value="Modifier theme" class="inp4 bouton modif2">
                   </div>
                 </p>
                 <p>
                   <div class="modifierBloc">
                     <div class="infoProfil">
                       <p>
                         <?php echo $resultPro['statut']; ?>
                       </p>
                     </div>

                   <div>
                       <input type="radio" name="prive" value="0"/> <label>Privée</label><br>
                       <input type="radio" name="prive" value="1"/> <label>Public</label>
                       <input type="submit" value="Modifier statut" class="inp4 bouton modif2">
                   </div>
                   </p>
                   </form>
                   <form name="supprimerpho" action="modifierphoto.php?idphoto=<?php echo $idtest?>" method="post">
                        <input type="text" name="supprimer" class="form inp2" id="suppphotolo" value="<?php echo $resultPro['idphoto'];?>">
                       <input type="submit" value="Supprimer" id="supphoto" class="adminsup">
                   </form>

               </div>
               <?php
 }else{?>
  <h1> Photo Inexistante ou supprimer!</h1>
  <?php
}
 ?>

            </body>


  </html>
