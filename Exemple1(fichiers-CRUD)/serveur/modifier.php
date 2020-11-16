<?php
function maj($oldPhoto){
	$num=$_POST['num'];
	$nom=$_POST['nom'];
	$age=$_POST['age'];
	$sexe=$_POST['sexe'];
	$dossier="../photos/";
	$nomPhoto=sha1($nom.time());
	$photo=$oldPhoto;
if($_FILES['photo']['tmp_name']!==""){
	//Upload de la photo
	$tmp = $_FILES['photo']['tmp_name'];
	$fichier= $_FILES['photo']['name'];
	$extension=strrchr($fichier,'.');
	@move_uploaded_file($tmp,$dossier.$nomPhoto.$extension);
	// Enlever le fichier temporaire chargé
	@unlink($tmp); //effacer le fichier temporaire
	$photo=$nomPhoto.$extension;
}
	if (!$fic=fopen("../donnees/membre.txt","a+")){
		echo "Probleme";
		exit;
	} 
	$ligne=$num.";".$nom.";".$age.";".$sexe.";".$photo."\n";
	fputs($fic,$ligne);
	echo "Membre <b>".$num."</b> bien modifie";
}
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
			if($_FILES['photo']['tmp_name']!=="")
				retirerPhoto($nomPhoto);
			else
				enregistrer($nomPhoto);

		}
		$ligne=fgets($fic);
	}
	fclose($fic);
	fclose($fictmp);
	unlink("../donnees/membre.txt");
	rename("../donnees/membre.tmp","../donnees/membre.txt");
	echo "Membre ".$num." enleve";
}

?>