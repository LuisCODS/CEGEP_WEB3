<?php
	$num=$_POST['num'];
	$nom=$_POST['nom'];
	$age=$_POST['age'];
	$sexe=$_POST['sexe'];
	$dossier="../photos/";
	$nomPhoto=sha1($nom.time());
	$photo="avatar.png";
if($_FILES['photo']['tmp_name']!==""){
	//Upload de la photo
	$tmp = $_FILES['photo']['tmp_name'];
	$fichier= $_FILES['photo']['name'];
	$extension=strrchr($fichier,'.');
	@move_uploaded_file($tmp,$dossier.$nomPhoto.$extension);
	// Enlever le fichier temporaire chargé
	@unlink($tmp); //effacer le fichier temporaire
	$photo=$nomPhoto.$extension;
}
	if (!$fic=fopen("../donnees/membre.txt","a+")){
		echo "Probleme";
		exit;
	} 
	$ligne=$num.";".$nom.";".$age.";".$sexe.";".$photo."\n";
	fputs($fic,$ligne);
	echo "Membre <b>".$nom."</b> bien enregistre";
?>
<br><br>
<a href="../accueil.html">Retour à la page d'accueil</a>