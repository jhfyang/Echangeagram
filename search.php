<?php session_start();

  $conn = new PDO("mysql:host=localhost;dbname=librarie", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


extract($_POST);

$q= $conn->prepare('SELECT email, nom, prenom, profil_picture FROM profil WHERE (nom LIKE :query OR prenom LIKE :query OR email LIKE  :query) LIMIT 5');

$q->execute([

	'query'=> '%'.$query.'%'

	]);

$profil = $q->fetchAll(PDO::FETCH_OBJ);

foreach ($profil as $user){


	?>

	<div id="box">
		<img src="<?php echo $user->profil_picture ;?>" id="profilphotobis">
	<div id="resu">
	<a href="profil.php?email=<?=$user->email?>">
	<?= $user->prenom?> <?= $user->nom?><br><?= $user->email?>
	</div>
	</div>


<?php


}
?>
