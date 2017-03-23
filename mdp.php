<html>
	<head>
 		<meta charset="utf-8" />
 		<title> Mot de passe oublié </title>
 		<link rel ="stylesheet"
 			  href="style.css"/>
 		<link href='http://fonts.googleapis.com/css?family=Dancing+Script:700' rel='stylesheet' type='text/css'>
 	</head>
<body>

	<h1 id="titreMDP">Mot de Passe retrouver</h1>

	<div id="mdpo">
		<p>Voici votre mot de passe, veuillez ne pas l'oublier la prochaine fois!</p>
		<p>
			<?php
      $bdd = new PDO("mysql:host=localhost;dbname=librarie", "root", "");
      $mailSes = 	$_GET['email'];
      $requete = $bdd->query("SELECT * FROM profil WHERE email=\"$mailSes\"");
      $result = $requete->fetch();
      ?>

      <p>
          <?php echo $result['pass'];?>
      </p>

		</p>
	</div>
</body>
