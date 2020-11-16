<?php
	require_once("../BD/connexion.inc.php");
	$titre=$_POST['titre'];
	$duree=$_POST['duree'];
	$res=$_POST['res'];
	$dossier="../pochettes/";
	$nomPochette=sha1($titre.time());
	$pochette="avatar.jpg";
	
	if($_FILES['pochette']['tmp_name']!==""){
		//Upload de la photo
		$tmp = $_FILES['pochette']['tmp_name'];//vaervavkjnds;knvbdkjdsav j. 
		$fichier= $_FILES['pochette']['name']; //007Spectre.jpg
		$extension = strrchr($fichier,'.');//007Spectre.jpg
		//../pochettes/dfbnfdsbnfbfgbfgbgng.jpg
		@move_uploaded_file($tmp,$dossier.$nomPochette.$extension);
		// Enlever le fichier temporaire chargé
		@unlink($tmp); //effacer le fichier temporaire
		$pochette=$nomPochette.$extension;
	}
	
	$requete="INSERT INTO films VALUES(0,?,?,?,?)";
	$stmt = $connexion->prepare($requete);
	$stmt->execute(array($titre,$duree,$res,$pochette));
	echo "Film ". $connexion->lastInsertId()." bien enregistre";
	unset($connexion);
	unset($stmt);
?>
<br><br>
<a href="../films.html">Retour à la page d'accueil</a>