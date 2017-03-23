<?php session_start();?>
<?php
$_email=$_SESSION['email'];

if(isset($_POST['theme'])){
    $tptp=  $_POST['theme'];
      header('Location: theme.php?theme='.$tptp.'');
}

if (isset($_FILES['icone'])) {


    $titrephoto = $_POST['titrephoto'];
    $theme =$_POST["theme"];
    $prive =$_POST["prive"];
    $date =$_POST["jour"]."/".$_POST["mois"]."/".$_POST["annee"];
    $description =$_POST["description"];
    $lieu =$_POST["lieu"];


    if ($_FILES['icone']['error'] > 0) $erreur = "Erreur lors du transfert";
    $maxsize=103000;
    if ($_FILES['icone']['size'] > $maxsize) $erreur = "Le fichier est trop gros";

    $name = $_FILES['icone']['name'];

    $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );

    $extension_upload = strtolower(  substr(  strrchr($_FILES['icone']['name'], '.')  ,1)  );
    if ( in_array($extension_upload,$extensions_valides) ) {
        echo "Extension correcte";
    }
    else echo"<script>alert('Ce fichier n'est pas une image');</script>";

    $nom = "images/{$name}";

    $bdd4 = new PDO("mysql:host=localhost;dbname=librarie", "root", "");

    $resultat = move_uploaded_file($_FILES['icone']['tmp_name'],$nom);
    if ($resultat) {

        $sql = "INSERT INTO photos VALUES (NULL, '$lieu', '$date', '$prive', '$theme', '$_email', '$description', '$nom', '$titrephoto')";
        $req = $bdd4->exec($sql);
        echo $sql;
        header('Location: gallerie.php');

    }
}

?>

      <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="script.js"></script>
<header>
		<div id="outils">
				<div>
						<a  href="gallerie.php">
								<h3 id="tiouti">Echangeagram</h3>
						</a>
				</div>
				<div id="barech">
						<input id="rech" placeholder="Recherche un utilisateur" type="search" ></code>
						<div id="display-results">


					</div>
						<img src="icons/catego.jpg" class="pos" alt="categorie" id="catego" onmouseover="this.src='icons/catego_hover.jpg';" onmouseout="this.src='icons/catego.jpg';"/>

				</div>

				<div id="boite">
						<img src="icons/upload.jpg" alt="imprort" id="import" class="imgbutton" onmouseover="this.src='icons/upload_hover.jpg';" onmouseout="this.src='icons/upload.jpg';">


						<a href="gallerie.php">
							<img src="icons/photo.jpg" alt="photo" id="photo" class="imgbutton" onmouseover="this.src='icons/photo_hover.jpg';" onmouseout="this.src='icons/photo.jpg';" /></a>


						<a href="profil.php?email=<?= $_SESSION['email']?> ">
								<img src="icons/perso.jpg" alt="profile" id="perso" class="imgbutton" onmouseover="this.src='icons/perso_hover.jpg';" onmouseout="this.src='icons/perso.jpg';"/></a>


						<img src="icons/setting.jpg" alt="reglages" id="setting" class="imgbutton" onmouseover="this.src='icons/setting_hover.jpg';" onmouseout="this.src='icons/setting.jpg';" onclick="modifPos()"/>

				</div>
		</div>



		<div>

            <div id="chth">
                            <form name="choosetheme" method="post">
                                <br><br>
                                <input type="radio" name="theme" value="th1"/> <label for="theme1">Portrait</label>&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="theme" value="th2"/> <label for="theme2">Party</label>&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="theme" value="th3"/> <label for="theme3">Jeux-Video</label><br/><br/>&nbsp;&nbsp;
                                <input type="radio" name="theme" value="th4"/> <label for="theme4">Hight-Tech</label>&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="theme" value="th5"/> <label for="theme5">Paysage</label>&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="theme" value="th6"/> <label for="theme6">Faune</label>&nbsp;&nbsp;&nbsp;
                                <input type="submit" value="Rechercher" class="bouton" id="formth">
                            </form>

                    </div>

            <form method="post" action="barreoutils.php" enctype="multipart/form-data">


                <div id="dandd">
                    <div id="rect">
                    </div>
                    <input type="file" id="fil" class="btn" name="icone">

                    <label for="theme"></label>
                       <select name="theme" id="theme" required>
                           <option value="th1">Portrait</option>
                           <option value="th2">Party</option>
                           <option value="th3">Jeux-Video</option>
                           <option value="th4">High-Tech</option>
                           <option value="th5">Paysage</option>
                           <option value="th6">Faune</option>
                       </select>
                    <div id="pri">
                        <input type="radio" name="prive" value="1"/> <label>Privée</label><br>
                        <input type="radio" name="prive" value="0"/> <label>Public</label>
                    </div>
                          <label for="description"></label>
                       <textarea name="description" id="description" rows="8" cols="38"> Description de la photo</textarea>
                        <label for="lieu"></label>
                        <input type="text" name="lieu" id="lieu" placeholder="Lieu" required/>
                        <label for="titrephoto"></label>
                        <input type="text" name="titrephoto" id="titrephoto" placeholder="Titre" required/>
                        <table id="tab_date2">

                            <tr>
                                <td>Jour <br></td>
                                <td>Mois <br></td>
                                <td>Année <br></td>
                            </tr>
                            <tr>
                                <td><label for="jour"></label>
                               <select name="jour" class="dat2">
                                        <?php
                                        for ($i=1 ; $i <=31; $i++)
                                        {
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                        ?>
                                </select></td>
                                <td><label for="mois"></label>
                               <select name="mois" class="dat2" placeholder="Nom">
                                        <?php
                                        for ($i=1 ; $i <=12; $i++)
                                        {
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                        ?>
                                </select></td>
                                <td><label for="annee"></label>
                               <select name="annee" class="dat2">
                                        <?php
                                        for ($i=1916 ; $i <=2016; $i++)
                                        {
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                        ?>
                                </select>
                                </td>
                            </tr>
                        </table>
                        <input type="submit" value="Valider" class="btn bouton" id="subdd" name="validation" selected>
                        <input type="button" value="Fermer" class="btn bouton" id="quidd">

                </div>
             </form>

		<div id="menu_set" class="ss_menu">
			<table>
				<tr>
					<td> <a href="modifierprofil.php">Modifier profil </a></td>
				</tr>
				<tr>
					<td><a href="deconnexion.php">Deconnexion</a></td>
				</tr>
				<tr>
          <?php
          $bdd5 = new PDO("mysql:host=localhost;dbname=librarie", "root", "");
          $requetead = $bdd5->query("SELECT * FROM profil WHERE email=\"$_email\" and admin=1");
          $count=$requetead->rowCount();
          if ($count==1) {
          ?>
          <td id="admin"><a href="admin.php">Administrateur</a></td>
          <?php
        }
          ?>
				</tr>
			</table>
		</div>

		</div>
</header>

 <script src="script.js"></script>
<script src="recherche.js"></script>
 <script src="script.js"></script>
