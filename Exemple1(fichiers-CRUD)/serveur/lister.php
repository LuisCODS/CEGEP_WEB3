<?php
 if (!$fic=fopen("../donnees/membre.txt","r")){
	echo "Probleme";
	exit;
} 
$rep="<h3>Liste des membres</h3><br><br>";
$rep.="<table border=1>";
$rep.="<tr><th>NUMERO</th><th>NOM</th><th>AGE</th><th>SEXE</th><th>PHOTO</th></tr>";
$ligne=fgets($fic);
while(!feof($fic)){
	$tab=explode(";",$ligne);
	$rep.="<tr><td>".$tab[0]."</td><td>".$tab[1]."</td><td>".$tab[2]."</td>";
	$rep.="<td>".((trim($tab[3])==="F")?"Feminin":"Masculin")."</td>";
	$photo="../photos/".$tab[4];
	$rep.="<td><img src='".$photo."' width=80px height=80px></td></tr>";
	$ligne=fgets($fic);
}
fclose($fic);
$rep.="</table>";
echo $rep;
?>
<br><br>
<a href="../accueil.html">Retour à la page d'accueil</a>