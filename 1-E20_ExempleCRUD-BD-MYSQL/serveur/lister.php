<?php
	require_once("../BD/connexion.inc.php");
	$rep="<caption>LISTE DES FILMS</caption>";
	$rep.="<table border=1>";
	$rep.="<tr><th>NUMERO</th><th>TITRE</th><th>DUREE</th><th>REALISATEUR</th><th>POCHETTE</th></tr>";
	$requette="SELECT * FROM films";
	$resultat=@mysql_query($requette);
	while($ligne=@mysql_fetch_array($resultat)){
		 $rep.="<tr><td>".$ligne['idf']."</td><td>".$ligne['titre']."</td><td>".$ligne['duree']."</td><td>".$ligne['res']."</td><td><img src='../pochettes/".$ligne['pochette']."' width=80 height=80></td></tr>";
		//$rep.="<tr><td>".($ligne.idf)."</td><td>".($ligne.titre)."</td><td>".($ligne.duree)."</td><td>".($ligne.res)."</td><td><img src='../pochettes/".($ligne.pochette)."' width=80 height=80></td></tr>";
	}
	$rep.="</table>";
	echo $rep;
	@mysql_close();
?>
<br><br>
<a href="../films.html">Retour à la page d'accueil</a>