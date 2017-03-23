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
if (isset($_FILES['modifprofil'])) {


if ($_FILES['modifprofil']['error'] > 0) $erreur = "Erreur lors du transfert";
$maxsize=103000;
if ($_FILES['modifprofil']['size'] > $maxsize) $erreur = "Le fichier est trop gros";

$name = $_FILES['modifprofil']['name'];

$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );

$extension_upload = strtolower(  substr(  strrchr($_FILES['modifprofil']['name'], '.')  ,1)  );
if ( in_array($extension_upload,$extensions_valides) ) {
    echo "Extension correcte";
}
else echo"<script>alert('Ce fichier n'est pas une image');</script>";

$nom = "profil/{$name}";

$resultat = move_uploaded_file($_FILES['modifprofil']['tmp_name'],$nom);
if ($resultat) {
  $bdd = new PDO("mysql:host=localhost;dbname=librarie", "root", "");
            $mailSes =  $_SESSION['email'];
$requeteMod = $bdd->prepare("UPDATE profil SET profil_picture = ? WHERE email=\"$mailSes\" ");
                  $requeteMod->execute(array($nom));

}
}
?>
<?php

            $bdd = new PDO("mysql:host=localhost;dbname=librarie", "root", "");
            $mailSes = 	$_SESSION['email'];
            $requetePro = $bdd->query("SELECT * FROM profil WHERE email=\"$mailSes\"");
            $resultPro = $requetePro->fetch();
            $pass = $_SESSION['pass'];

            if(isset($_POST['modprenom']) AND !empty($_POST['modprenom']))
                {
                  $requeteMod = $bdd->prepare("UPDATE profil SET prenom = ? WHERE email=\"$mailSes\" ");
                  $requeteMod->execute(array($_POST['modprenom']));
                }
            if(isset($_POST['modnom']) AND !empty($_POST['modnom']))
                {
                  $requeteMod = $bdd->prepare("UPDATE profil SET nom = ? WHERE email=\"$mailSes\" ");
                  $requeteMod->execute(array($_POST['modnom']));
                }
            if(isset($_POST['modnewpass']) AND isset($_POST['modconfinewpass']) AND isset($_POST['pass']) AND !empty($_POST['pass']) AND !empty($_POST['modnewpass']) AND !empty($_POST['modconfinewpass']))
                {
                  if($pass==$_POST['pass'])
                  {
                      if($_POST['modconfinewpass']==$_POST['modnewpass'])
                      {
                          $requeteMod = $bdd->prepare("UPDATE profil SET pass = ? WHERE email=\"$mailSes\" ");
                          $requeteMod->execute(array($_POST['modnewpass']));
                      }

                  }
                }

        ?>

    <body>

        <div class="login" id="modpro">
            <div id="inscriptionH2"> Modifier ses Informations</div>
            <br> <br>
            <form name="modifierp" onSubmit="return formValidation();" action="modifierprofil.php" method="post">
                <div class="modifierBloc">
                    <div class="infoProfil">
                        <p>
                            <?php echo $resultPro['prenom']; ?>
                        </p>
                    </div>

                          <p>
                          <label for="prenom"></label>
                          <input type="text" name="modprenom" placeholder="Prénom à modifier" class="form inp4 modif1" />
                          <input  type="submit" value="Modifier Prénom" class="inp4 bouton modif2" ></code>
                        </p>

                </div>
                <div class="modifierBloc">
                    <div class="infoProfil">
                        <p>
                            <?php echo $resultPro['nom']; ?>
                        </p>
                    </div>
                    <p>
                          <label for="nom"></label>
                          <input type="text" name="modnom" placeholder="Nom à modifier" class="form inp4 modif1"  />

                          <input  type="submit" value="Modifier Nom" class="inp4 bouton modif2" ></code>

                        </p>
                    </div>


                <div class="modifierBloc">
                    <div class="infoProfil">
                        <p>
                            Password
                        </p>
                    </div>




                       <p>  <label for="pass"></label>
                          <input type="password" name="pass"  placeholder="ancien mot de passe" class="inp4 form modif1" minlength="6"/>
                        </p>
                        <p> <label for="newpass"></label>
                          <input type="password" name="modnewpass"  placeholder="nouveau mot de passe" class="inp4 form modif1" minlength="6"/>
                        </p>


                   			<p>	<label for="confinewpass"></label>
                   				<input type="password" name="modconfinewpass"  placeholder="confirmation nouveau mot de passe" class="inp4 form modif1" minlength="6"/>

                          <input  type="submit" value="Modifier Mot de Passe" class="inp4 bouton modif2 modif3" ></code>

                        </p>


                </div>
              <p>




             </form>
                      <form method="post" action="modifierprofil.php" enctype="multipart/form-data">
                          <input type="file" id="modifprofil" class="btn" name="modifprofil">
                          <input type="submit" value="Modifier photo de profil" id="modifierprof" class="bouton">
                         </p>
                      </form>
    </div></div>
</body>
</html>
