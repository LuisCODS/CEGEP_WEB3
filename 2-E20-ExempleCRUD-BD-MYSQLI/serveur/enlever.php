<?php
	require_once("../BD/connexion.inc.php");
	$num=$_POST['num'];	
	$requete="SELECT * FROM films WHERE idf=?";
	$stmt = $connexion->prepare($requete);
	$stmt->bind_param("i", $num);
	$stmt->execute();
	$result = $stmt->get_result();
	if(!$ligne = $result->fetch_object()){
		echo "Film ".$num." introuvable";
		mysqli_close($connexion);
		exit;
	}
	$pochette=$ligne->pochette;
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
		  }
		}
	}
	$requete="DELETE FROM films WHERE idf=?";
	$stmt = $connexion->prepare($requete);
	$stmt->bind_param("i", $num);
	$stmt->execute();
	mysqli_close($connexion);
	echo "<br><b>LE FILM : ".$num." A ETE RETIRE</b>";
?>
<br><br>
<a href="../films.html">Retour à la page d'accueil</a>