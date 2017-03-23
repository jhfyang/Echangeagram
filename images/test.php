<?php

    $bdd = new PDO("mysql:host=localhost;dbname=echangeagram", "root", "");

    $requete =  $bdd->query("SELECT * FROM photos");

    $result = $requete->fetch();

    echo $result['path'];
 ?>
