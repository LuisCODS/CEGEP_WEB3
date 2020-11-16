<?php
	require_once("../BD/connexion.inc.php");
	$num=$_POST['num'];
	$requette="SELECT pochette FROM films WHERE idf=$num";
	$resultat=@mysql_query($requette);
	
	if (@mysql_num_rows($resultat)==0){
		echo "Film ".$num." introuvable";
		@mysql_close();
		exit;
	}
	$ligne=@mysql_fetch_array($resultat);
	$pochette=$ligne['pochette'];
	if($pochette!="avatar.jpg"){
		$rmPoc='../pochettes/'.$pochette;
		$tabFichiers = glob('../pochettes/*');
		//print_r($tabFichiers);
		// parcourir les fichier
		foreach($tabFichiers as $fichier){
		  if(is_file($fichier) && $fichier==trim($rmPoc)) {
			// enlever le fichier
			unlink($fichier);
			break;
			//
		  }
		}
	}
	$requette="DELETE FROM films WHERE idf=$num";
	@mysql_query($requette);
	@mysql_close();
	echo "<br><b>LE FILM : ".$num." A ETE RETIRE</b>";
?>
<br><br>
<a href="../films.html">Retour à la page d'accueil</a>