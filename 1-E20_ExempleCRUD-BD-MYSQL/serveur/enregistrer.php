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
		$tmp = $_FILES['pochette']['tmp_name'];
		$fichier= $_FILES['pochette']['name'];
		$extension=strrchr($fichier,'.');
		@move_uploaded_file($tmp,$dossier.$nomPochette.$extension);
		// Enlever le fichier temporaire chargé
		@unlink($tmp); //effacer le fichier temporaire
		$pochette=$nomPochette.$extension;
	}
	$requette="INSERT INTO films VALUES(0,'$titre',$duree,'$res','$pochette')";
	@mysql_query($requette);
	$idf=@mysql_insert_id();
	echo "<br><b>AJOUT DU FILM NUMERO : <h2>".$idf."</h2></b>";
	@mysql_close();
?>
<br><br>
<a href="../films.html">Retour à la page d'accueil</a>