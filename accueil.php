<?php session_start();?>
<?php
 $co=0;
if (isset($_POST["email"]))
{
 $email =$_POST["email"];
$_SESSION['email']=$_POST["email"];
 $pass =$_POST["pass"];
 $_SESSION['pass'] = $pass;

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
$sql = "SELECT email, pass FROM profil WHERE email=\"$email\" and pass=\"$pass\"";
$query=$conn->query($sql);
$count=$query->rowCount();
if ($count==1) {
// C EST ICI QU ON REDIRIGE L UTILISATEUR SI LE MDP ET EMAIL CORRECT ( J AI CHOISIT CETTE PAGE MAIS CA PEUT ETRE CHANGE)
header('Location: gallerie.php');

}
else
{
  $co=1;
 $_SESSION=array();
 session_destroy();
}
}
?>


<html>
	<head>
 		<meta charset="utf-8" />
 		<title> Accueil </title>
 		<link rel ="stylesheet"
 			  href="style.css"/>
 		<link href='http://fonts.googleapis.com/css?family=Dancing+Script:700' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="http://malsup.github.com/jquery.cycle2.js"></script>
 		<script src="script.js"></script>
 	</head>
<body>

	<div class="cycle-slideshow">
	<img src="accueil/image-accueil.jpg" class="bandeau" >
	<img src="accueil/japon.jpg" class="bandeau" >
	<img src="accueil/usa.jpg" class="bandeau" >
	<img src="accueil/afrique.jpg" class="bandeau" >
	</div>
	<div class="login">
		<h1>Echangeagram</h1>

		<form name="connexion" action="accueil.php" method="post">
   			<p>
       			<label></label>
       			<input type="email" name="email" placeholder="Adresse mail"required class="inp form"  />
       		</p>
       		<p>

		       <label></label>
		       <input type="password" name="pass"  placeholder="Mot de passe" class="inp form"  required/>
		       <a href="mdpoublie.php" id="oubli" >Mot de passe oublie ?</a>

   			</p>
   			<div >
   			<input  type="submit" value="Se Connecter" class="inp bouton" ></code>
   			</div>
		</form>

		<br>

		<hr id="ligne" >

			<p id="mdp">Pas encore inscrit?</p>


			<a href="inscription.php"><input  type="button" value="S'inscrire" class="inp bouton" ></code>
			</code></a>


	</div>

<?php
if ($co==1) {
	echo "<script> connexion(1);</script>";
}
?>


</body>
</html>
