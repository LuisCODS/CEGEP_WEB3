<?php
	$nom=$_POST['nom'];
	$age=$_POST['age'];
	$sexe=$_POST['sexe'];
	/*$rep="<br>Nom=$nom".$nom;
	$rep.="<br>Age=".$age;
	$rep.="<br>Sexe=".$sexe;
	echo $rep;*/
	if (!$fic=fopen("donnees/membre.txt","a+")){
		echo "Probleme";
		exit;
	} 
	$ligne=$nom.";".$age.";".$sexe."\n";
	fputs($fic,$ligne);
	echo "Membre <b>".$nom."</b> bien enregistre";
?>
<br><br>
<a href="accueil.html">Retour à la page d'accueil</a>