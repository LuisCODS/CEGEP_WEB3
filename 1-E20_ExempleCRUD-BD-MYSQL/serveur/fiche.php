<script language="javascript" src="../js/global.js"></script>
<link rel="stylesheet" href="../css/films.css" type="text/css" />
<?php
	require_once("../BD/connexion.inc.php");
	$num=$_POST['num'];
	$requette="SELECT * FROM films WHERE idf=$num";
	$resultat=@mysql_query($requette);
	if (@mysql_num_rows($resultat)==0){
		echo "Film ".$num." introuvable";
		@mysql_close();
		exit;
	}
	$ligne=@mysql_fetch_array($resultat);
	echo "<form id=\"formEnreg\"  enctype=\"multipart/form-data\" action=\"modifier.php\" method=\"POST\" onSubmit=\"return valider();\">\n"; 
	echo "	<h3>Fiche du film ".$num." </h3><br><br>\n"; 
	echo "	<span onClick=\"rendreInvisible('divEnreg')\">X</span><br>\n"; 
	echo "	Numero:<input type=\"text\" id=\"num\" name=\"num\" value='".$ligne['idf']."' readonly><br>\n"; 
	echo "	Titre:<input type=\"text\" id=\"titre\" name=\"titre\" value='".$ligne['titre']."'><br>\n"; 
	echo "	Duree:<input type=\"text\" id=\"duree\" name=\"duree\" value='".$ligne['duree']."'><br>\n"; 
	echo "	Realisateur:<input type=\"text\" id=\"res\" name=\"res\" value='".$ligne['res']."'><br><br>\n"; 
	echo "  Pochette:<input type=\"file\" id=\"pochette\" name=\"pochette\"><br><br>";
	echo "	<input type=\"submit\" value=\"Envoyer\"><br>\n"; 
	echo "</form>\n";
	@mysql_close();
?>