<?php
	$rep="<table border=1>";
	$rep.="<caption>LISTE DES FILMS</caption>";
	$rep.="<tr><th>NUMERO</th><th>TITRE</th><th>DUREE</th><th>REALISATEUR</th><th>POCHETTE</th></tr>";
	if(!$fic=fopen("../donnees/films.txt","r")){
		echo "ERREUR: probleme avec le fichier";
		exit;
	}
	$ligne=fgets($fic);
	while(!feof($fic)){
		$tab=explode(";",$ligne);
		$rep.="<tr><td>".$tab[0]."</td><td>".$tab[1]."</td><td>".$tab[2]."</td><td>".$tab[3]."</td><td><img src='../pochettes/".$tab[4]."' width=80 height=80></td></tr>";
		$ligne=fgets($fic);
	}
	$rep.="</table>";
	echo $rep;
	fclose($fic);
?>
<br><br>
<a href="../films.html">Retour à la page d'accueil</a>