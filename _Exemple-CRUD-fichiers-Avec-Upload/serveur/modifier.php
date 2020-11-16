<?php
	$num=$_POST['num'];
	$titre=$_POST['titre'];
	$duree=$_POST['duree'];
	$res=$_POST['res'];
	$dossier="../pochettes/";
	if(!$fic=fopen("../donnees/films.txt","r")){
		echo "ERREUR: probleme avec le fichier";
		exit;
	}
	if(!$ficTmp=fopen("../donnees/films.tmp","w")){
		echo "ERREUR: probleme de creation du fichier films.tmp";
		exit;
	}
	$ligne=fgets($fic);
	while(!feof($fic)){
		$tab=explode(";",$ligne);
		if($num!==$tab[0])
			fputs($ficTmp,$ligne);
	    else{//ont modifie le film
		    if($_FILES['pochette']['tmp_name']!==""){
				//enlever ancienne pochette
				if($tab[4]!="avatar.jpg"){
					$rmPoc='../pochettes/'.$tab[4];
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
				@move_uploaded_file($tmp,$dossier.$nomPochette.$extension);
				// Enlever le fichier temporaire chargé
				@unlink($tmp); //effacer le fichier temporaire
				$pochette=$nomPochette.$extension;
				$nouvelleLigne=$num.";".$titre.";".$duree.";".$res.";".$pochette."\n";
			}
			else
			   $nouvelleLigne=$num.";".$titre.";".$duree.";".$res.";".trim($tab[4])."\n";
			fputs($ficTmp,$nouvelleLigne);
		}
	    $ligne=fgets($fic);
	}
	fclose($fic);
	fclose($ficTmp);
	unlink("../donnees/films.txt");
	rename("../donnees/films.tmp","../donnees/films.txt");
	echo "<br><b>LE FILM : ".$num." A ETE MODIFIE</b>";
?>
<br><br>
<a href="../films.html">Retour à la page d'accueil</a>