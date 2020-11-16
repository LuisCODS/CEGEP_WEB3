<?php
$num=$_POST['numE'];

function retirerPhoto($nomPhoto){
if (trim($nomPhoto) !== "avatar.png"){
	$rmPhoto='../photos/'.$nomPhoto;
	$tabFichiers = glob('../photos/*');
	//print_r($tabFichiers);
	// parcourir les fichier
	foreach($tabFichiers as $fichier){
	  if(is_file($fichier) && $fichier==trim($rmPhoto)) {
		// enlever le fichier
		unlink($fichier);
		break;
	  }
	}
}
}
function enlever(){
	global $num;
	$oldPhoto="";
	if(!$fic=fopen("../donnees/membre.txt","r")){
		echo "Impossible d'ouvrir le fichier";
		exit;
	}
	if(!$fictmp=fopen("../donnees/membre.tmp","a+")){
		echo "Impossible d'ouvrir le fichier";
		exit;
	}
	$dossier="../photos/";
	$ligne=fgets($fic);
	while(!feof($fic)){
		$tab=explode(";",$ligne);
		if($num!==$tab[0]){
		   fputs($fictmp,$ligne);
		}
		else{//on a trouvé
			$nomPhoto=$tab[4];
			retirerPhoto($nomPhoto);
		}
		$ligne=fgets($fic);
	}
	fclose($fic);
	fclose($fictmp);
	unlink("../donnees/membre.txt");
	rename("../donnees/membre.tmp","../donnees/membre.txt");
	echo "Membre ".$num." enleve";
}
enlever();
?>
<br><br>
<a href="../accueil.html">Retour à la page d'accueil</a>