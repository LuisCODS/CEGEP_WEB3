<?php
	$num=$_POST['num'];
	$titre=$_POST['titre'];
	$duree=$_POST['duree'];
	$res=$_POST['res'];
	
	if(!$fic=fopen("../donnees/films.txt","r")){
		echo "ERREUR: probleme avec le fichier";
		exit;
	}
	if(!$ficTmp=fopen("../donnees/films.tmp","w")){
		echo "ERREUR: probleme de creation du fichier films.tmp";
		exit;
	}
	$ligne=fgets($fic);
	$trouve=false;
	//Supprimer le film
	while(!feof($fic)){
		$tab=explode(";",$ligne);
		if($num!==$tab[0]){
			fputs($ficTmp,$ligne);
		}
		else{ $trouve=true;}
		$ligne=fgets($fic);
	}
	if($trouve){
	   $nouvelleLigne=$num.";".$titre.";".$duree.";".$res."\n";
	   fputs($ficTmp,$nouvelleLigne);
	   echo "<br><b>LE FILM : ".$num." A ETE MODIFIE</b>";
	   fclose($fic);
	   fclose($ficTmp);
	   unlink("../donnees/films.txt");
	   rename("../donnees/films.tmp","../donnees/films.txt");
	}
	else{
		echo "<br><b>LE FILM : ".$num." EST INTROUVABLE</b>";
	}
?>
<br><br>
<a href="../films.html">Retour à la page d'accueil</a>