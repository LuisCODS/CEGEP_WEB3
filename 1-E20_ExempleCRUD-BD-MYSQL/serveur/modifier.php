<?php
	require_once("../BD/connexion.inc.php");
	$num=$_POST['num'];
	$titre=$_POST['titre'];
	$duree=$_POST['duree'];
	$res=$_POST['res'];
	$dossier="../pochettes/";
	$requette="SELECT pochette FROM films WHERE idf=$num";
	$resultat=@mysql_query($requette);
	$ligne=@mysql_fetch_array($resultat);
	$pochette=$ligne['pochette'];
	if($_FILES['pochette']['tmp_name']!==""){
		//enlever ancienne pochette
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
		$nomPochette=sha1($titre.time());
		//Upload de la photo
		$tmp = $_FILES['pochette']['tmp_name'];
		$fichier= $_FILES['pochette']['name'];
		$extension=strrchr($fichier,'.');
		$pochette=$nomPochette.$extension;
		@move_uploaded_file($tmp,$dossier.$nomPochette.$extension);
		// Enlever le fichier temporaire chargé
		@unlink($tmp); //effacer le fichier temporaire
	}
	$requette="UPDATE films SET titre='$titre',duree=$duree,res='$res',pochette='$pochette' WHERE idf=$num";
	@mysql_query($requette);
	@mysql_close();
	echo "<br><b>LE FILM : ".$num." A ETE MODIFIE</b>";
?>
<br><br>
<a href="../films.html">Retour à la page d'accueil</a>