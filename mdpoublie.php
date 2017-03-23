<html>
	<head>
 		<meta charset="utf-8" />
 		<title> Mot de passe oublié </title>
 		<link rel ="stylesheet"
 			  href="style.css"/>
 		<link href='http://fonts.googleapis.com/css?family=Dancing+Script:700' rel='stylesheet' type='text/css'>
 	</head>
<body>
<?php
$bdd = new PDO("mysql:host=localhost;dbname=librarie", "root", "");

		if(isset($_POST["prenom"]) AND !empty($_POST["prenom"]) AND isset($_POST["nom"]) AND isset($_POST["email"])){
			$bdd = new PDO("mysql:host=localhost;dbname=librarie", "root", "");
					$email =$_POST["email"];
					$prenom =$_POST["prenom"];
					$nom =$_POST["nom"];
					$date =$_POST["jour"]."/".$_POST["mois"]."/".$_POST["annee"];

			$requete = $bdd->query("SELECT email, prenom, nom, date FROM profil WHERE email=\"$email\" AND prenom=\"$prenom\" AND nom=\"$nom\" AND date=\"$date\"");
			$count=$requete->rowCount();
			if($count==1){
				echo "reussi";
			 			header('Location: mdp.php?email='.$email.'');

			}else{
				echo "<script> alert('Vos Informations sont incorrects');</script>";
			}
		}
 ?>

	<h1 id="titreMDP">Réinitialisation mot de passe</h1>

	<div id="mdpo">
		<p>Nous pouvons vous aider à réinitialiser votre mot de passe à l’aide de vos Informations Personnels récupérez votre mot de passe.</p>
		<p>
			<form method="post"><label></label>
			<p><input type="email" name="email" placeholder="Adresse mail" required class="form mdp"  /> </p>
			<p><input type="text" name="nom" placeholder="Nom" required class="form mdp"  /> </p>
			<p><input type="text" name="prenom" placeholder="Prénom" required class="form mdp"  /> </p>
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
				</p>
		<p>
			<label></label>
			<input  type="submit" value="Récuperer Mot de Passe" class="bouton mdp" ></code>
			</form>
		</p>
	</div>
</body>
