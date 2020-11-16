<?php
	$num=$_POST['num'];
	$titre=$_POST['titre'];
	$duree=$_POST['duree'];
	$res=$_POST['res'];
	
	if(!$fic=fopen("../donnees/films.txt","a")){
		echo "ERREUR: probleme avec le fichier";
		exit;
	}
	
	$ligne=$num.";".$titre.";".$duree.";".$res."\n";
	fputs($fic,$ligne);
	fclose($fic);
	echo "<br><b>AJOUT DU FILM NUMERO : ".$num."</b>";
?>
<br><br>
<a href="../films.html">Retour à la page d'accueil</a>