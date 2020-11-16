<?php
function envoyerFiche($tab){
$rep= '<FORM ID="idForm" ACTION="serveur/modifier.php" ENCTYPE="multipart/form-data" METHOD="POST" onSubmit="return validerEnreg(this);">';
$rep.= '<span onClick="cacher(\'idForm\')">X</span><br><br>';
$rep.= '<h1>Modifier membre</h1>';
$rep.= 'Numero : <input type="text" id="num" name="num" value="'.$tab[0].'" readonly><br><br>';
$rep.= 'Nom : <input type="text" id="nom" name="nom" value="'.$tab[1].'"><br><br>';
$rep.= 'Age : <input type="text" id="age" name="age" value="'.$tab[2].'"><br><br>';
$rep.= 'Sexe : <input type="text" id="sexe" name="sexe" value="'.$tab[3].'"><br><br>';
$rep.= 'Photo : <input type="file" name="photo"><br><br>';
$rep.= '<input type="submit" value="Envoyer"><br><br>';
$rep.= '</FORM>';
echo $rep;
}
function obtenirFiche(){
	$num=trim($_POST['numF']);
    $trouve=false;
	if(!$fic=fopen("../donnees/membre.txt","r")){
		echo "Impossible d'ouvrir le fichier";
		exit;
	}
	$ligne=fgets($fic);
	while(!feof($fic) && !$trouve){
		$tab=explode(";",$ligne);
		if($num==$tab[0])
		   $trouve=true;
		else
			$ligne=fgets($fic);
	}
	fclose($fic);
	if($trouve)
	   	envoyerFiche($tab);
	else
		echo "Membre ".$num." introuvable";
	
}
obtenirFiche();
?>