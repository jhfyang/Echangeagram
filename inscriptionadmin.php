<?php
$ma = 0;
if (isset($_POST["prenom"])) {

 $prenom =$_POST["prenom"];

 $nom =$_POST["nom"];

 $sex =$_POST["sex"];

 $date =$_POST["jour"]."/".$_POST["mois"]."/".$_POST["annee"];

 $email =$_POST["email"];

 $pass =$_POST["pass"];
try {
	// VOUS DEVEZ MODIFIER ICI LES ATTRIBUTS CAR  C EN FONCTION DE VOTRE BDD
    $conn = new PDO("mysql:host=localhost;dbname=librarie", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // set the PDO error mode to exception

  }
catch(Exception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
$sql = "SELECT email FROM profil WHERE email=\"$email\"";
$query=$conn->query($sql);
$count=$query->rowCount();
if ($count==1) {

    $ma = 2;
   
}
else
{

   $sql ="INSERT INTO profil VALUES ('$email','$pass','$nom','$prenom','$date','$sex','images/profil_start.jpg','0')";
$req = $conn->query($sql);
header('Location: admin.php');
 // C EST ICI QU ON REDIRIGE L UTILISATEUR SI LE MDP ET EMAIL CORRECT ( J AI CHOISIT CETTE PAGE MAIS CA PEUT ETRE CHANGE)
}
}
?>
<html>
<head>
 		<meta charset="utf-8" />
 		<title> Inscription </title>
 		<link rel ="stylesheet"
 			  href="style.css"/>
 		<script src="script.js"></script>
 		 <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
 		 <?php include("barreoutils.php");?>


 	</head>
 	<h1 id="titreInscription">Echangeagram</h1>
 	<div class="login">
 		<form name="inscription" onSubmit="return formValidation();" action="inscriptionadmin.php" method="post">
 			<h2 id="inscriptionH2">Inscription d'un nouveau membre</h2>
 			<p>
 				<label for="prenom"></label>
 				<input type="text" name="prenom" placeholder="Prénom" required class="form inp2" /> &nbsp;
 				<label for="nom"></label>
 				<input type="text" name="nom" placeholder="Nom" required class="form inp2"  />
 			</p>
 			<p>
 				Sexe: <br>
 				<div id="sxe">
 				<input type="radio" name="sex" value="h"/> <label>Homme</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 				<input type="radio" name="sex" value="f"/> <label>Femme</label>
 				</div>
 			</p>
 			<p>Date de naissance : <br><br>
 				<table id="tab_date">
 				<!--<label></label>
 				<input type="date" name="date" class="inp form" id="design" required></code>-->
 				<tr>
 					<td>Jour <br></td>
 					<td>Mois <br></td>
 					<td>Année <br></td>
 				</tr>
 				<tr>
 					<td><label for="jour"></label>
			       <select name="jour" class="inp3">
							<?php
							for ($i=1 ; $i <=31; $i++)
							{
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
							?>
					</select></td>
					<td><label for="mois"></label>
			       <select name="mois" class="inp3" placeholder="Nom">
							<?php
							for ($i=1 ; $i <=12; $i++)
							{
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
							?>
					</select></td>
					<td><label for="annee"></label>
			       <select name="annee" class="inp3">
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
 			</p>
 				<input type="email" name="email" placeholder="Adresse mail"required class="inp form"  />
 			<p>
 			<p>	<label for="pass"></label>
 				<input type="password" name="pass"  placeholder="Mot de passe" class="inp form" minlength="6" required/>
 			</p>
 			<p>	<label for="confipass"></label>
 				<input type="password" name="confipass"  placeholder="Confirmation mot de passe" class="inp form" minlength="6" required/>
 			</p>
 				<label></label>
 				<input  type="submit" value="Confirmer l'inscription" class="inp bouton" ></code>
 			</p>
 		</form>
 	</div>
<?php
if ($ma==2){
    echo'<script > connexion(2);</script>';
}?>
</html>