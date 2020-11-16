<?php
	$num=$_POST['num'];
	$titre=$_POST['titre'];
	$duree=$_POST['duree'];
	$res=$_POST['res'];
	$dossier="../pochettes/";
	$nomPochette=sha1($titre.time());
	$pochette="avatar.jpg";
	if(!$fic=fopen("../donnees/films.txt","a")){
		echo "ERREUR: probleme avec le fichier";
		exit;
	}
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
	$ligne=$num.";".$titre.";".$duree.";".$res.";".$pochette."\n";
	fputs($fic,$ligne);
	fclose($fic);
	echo "<br><b>AJOUT DU FILM NUMERO : ".$num."</b>";
?>
<br><br>
<a href="../films.html">Retour à la page d'accueil</a>