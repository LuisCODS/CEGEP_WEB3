<?php
	require_once("../BD/connexion.inc.php");
	$rep="<table border=1>";
	$rep.="<caption>LISTE DES FILMS</caption>";
	$rep.="<tr><th>NUMERO</th><th>TITRE</th><th>DUREE</th><th>REALISATEUR</th><th>POCHETTE</th></tr>";
	$requette="SELECT * FROM films";
	 try{
		 $listeFilms=mysqli_query($connexion,$requette);
		 while($ligne=mysqli_fetch_object($listeFilms)){
			$rep.="<tr><td>".($ligne->idf)."</td><td>".($ligne->titre)."</td><td>".($ligne->duree)."</td><td>".($ligne->res)."</td><td><img src='../pochettes/".($ligne->pochette)."' width=80 height=80></td></tr>";		 
		}
		mysqli_free_result($listeFilms);
	 }catch (Exception $e){
		echo "Probleme pour lister";
	 }finally {
		$rep.="</table>";
		echo $rep;
	 }
	 mysqli_close($connexion);
?>
<br><br>
<a href="../films.html">Retour à la page d'accueil</a>