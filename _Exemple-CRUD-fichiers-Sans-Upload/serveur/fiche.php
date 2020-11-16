<script language="javascript" src="../js/global.js"></script>
<link rel="stylesheet" href="../css/films.css" type="text/css" />
<?php
	$num=$_POST['num'];
	if(!$fic=fopen("../donnees/films.txt","r")){
		echo "ERREUR: probleme avec le fichier";
		exit;
	}
	$ligne=fgets($fic);
	$trouve=false;
	while(!feof($fic) && !$trouve){
		$tab=explode(";",$ligne);
		if($num===$tab[0])
			$trouve=true;
		else
			$ligne=fgets($fic);
	}
	fclose($fic);
	if($trouve){
		echo "<form id=\"formEnreg\" action=\"modifier.php\" method=\"POST\" onSubmit=\"return valider();\">\n"; 
		echo "	<h3>Fiche du film ".$num." </h3><br><br>\n"; 
		echo "	<span onClick=\"rendreInvisible('divEnreg')\">X</span><br>\n"; 
		echo "	Numero:<input type=\"text\" id=\"num\" name=\"num\" value='".$tab[0]."' readonly><br>\n"; 
		echo "	Titre:<input type=\"text\" id=\"titre\" name=\"titre\" value='".$tab[1]."'><br>\n"; 
		echo "	Duree:<input type=\"text\" id=\"duree\" name=\"duree\" value='".$tab[2]."'><br>\n"; 
		echo "	Realisateur:<input type=\"text\" id=\"res\" name=\"res\" value='".$tab[3]."'><br><br>\n"; 
		echo "	<input type=\"submit\" value=\"Envoyer\"><br>\n"; 
		echo "</form>\n";
	}
	else
		echo "<br><b>LE FILM : ".$num." INTROUVABLE</b>";
?>