<?php
 require_once("../BD/connexion.php");
 $msgTab = array();
 //Le controleur
//  $action=$_POST['action'];
extract($_POST);//Get all data form

 switch($action)
 {
	case "enregistrer":
	   enregistrer();
	   break;
	case "lister":
		lister();
		break;
 }
 mysqli_close($connexion);
 echo json_encode($msgTab);

 function enregistrer()
 {

	global $msgTab,$connexion;
 
	try{
		 //  $titre=$_POST['titre'];
		 //  $auteur=$_POST['auteur'];
		 //  $annee=$_POST['annee'];
		 //  $pages=$_POST['pages'];
		 extract($_POST);//Get all data form
 
		  $requete="INSERT INTO livres VALUES(0,?,?,?,?)";
		  $stmt = $connexion->prepare($requete);
		  $stmt->bind_param("ssii", $titre,$auteur,$annee,$pages);
		  $stmt->execute();
		  $msgTab['code']=1;
		  $msgTab['msg']="Livre bien enregistre";
 
	 }catch(Exception $e){
		 
		 $msgTab['code']=0;
		 $msgTab['msg']="Probleme enregistrement";
	 }
 
 }
 
  function lister()
  { 
	  global $msgTab, $connexion;

	  $requete="SELECT * FROM livres";
	  $listeLivres = mysqli_query($connexion,$requete);// or die ("Oups, probleme avec lister");
	 
	  $i=0;
	  while($ligne = mysqli_fetch_array($listeLivres))
	  {
		  $msgTab[$i]=array();
		  $msgTab[$i]['idlivre']=$ligne['idlivre'];
		  $msgTab[$i]['titre']=$ligne['titre'];
		  $msgTab[$i]['auteur']=$ligne['auteur'];
		  $msgTab[$i]['annee']=$ligne['annee'];
		  $msgTab[$i]['pages']=$ligne['pages'];
		  $i++;
	  }
	  //free the memory associated with the result
	  mysqli_free_result($listeLivres);
  }

?>