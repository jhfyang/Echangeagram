<!DOCTYPE html>
<html>
 


<?php $prenom =$_GET["prenom"];?>

<?php $nom =$_GET["nom"];?>

<?php $sex =$_GET["sex"];?>

<?php $date =$_GET["date"];?>

<?php $email =$_GET["email"];?>

<?php $pass =$_GET["pass"];?>




 <?php
try {
    $conn = new PDO("mysql:host=localhost:8889 ;dbname=ProjetWeb", "root", "root");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }

catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
     $sql="INSERT INTO utilisateurs VALUES ('$email', '$pass', '$nom', '$prenom', '$date', '$sex')";
 
 ?>
</html>