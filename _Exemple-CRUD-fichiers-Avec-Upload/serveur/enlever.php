<?php
	$num=$_POST['num'];
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
		else{
		   if(trim($tab[4])!=="avatar.jpg"){
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
		}
	    $ligne=fgets($fic);
	}
	fclose($fic);
	fclose($ficTmp);
	unlink("../donnees/films.txt");
	rename("../donnees/films.tmp","../donnees/films.txt");
	echo "<br><b>LE FILM : ".$num." A ETE RETIRE</b>";
?>
<br><br>
<a href="../films.html">Retour à la page d'accueil</a>