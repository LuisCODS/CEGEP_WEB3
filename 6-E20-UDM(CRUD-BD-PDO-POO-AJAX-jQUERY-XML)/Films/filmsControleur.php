<?php
	//NOTA : JAMAIS une ligne vide avant la ligne 1 ou aprés la fin du programme 
	require_once("../includes/modele.inc.php");
	function retourMessage($msg){
		global $action;
		header ("Content-Type: text/xml");
			$rep="<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
			$rep.="<messages>";
				$rep.="<action>".$action."</action>";
				$rep.="<msg>";
					$rep.=$msg;
				$rep.="</msg>";
			$rep.="</messages>";
			echo $rep;
	}
	
	function listerFilms($stmt){
		global $action;
			header ("Content-Type: text/xml");
			$rep="<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
			$rep.="<reponse>\n";
				$rep.="<action>".$action."</action>\n";
				$rep.="<listefilms>";
					while($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
						$rep.="<film>\n";
							$rep.="<idf>\n";
								$rep.=$ligne->idf;
							$rep.="</idf>\n";
							$rep.="<titre>\n";
								$rep.=$ligne->titre;
							$rep.="</titre>\n";
							$rep.="<duree>\n";
								$rep.=$ligne->duree;
							$rep.="</duree>\n";
							$rep.="<res>\n";
								$rep.=$ligne->res;
							$rep.="</res>\n";
							$rep.="<pochette>\n";
								$rep.=$ligne->pochette;
							$rep.="</pochette>\n";
						$rep.="</film>\n";
					}
				$rep.="</listefilms>\n";
			$rep.="</reponse>\n";
			echo $rep;
	}
	
	function enregistrer(){
		global $action;
		$titre=$_POST['titre'];
		$duree=$_POST['duree'];
		$res=$_POST['res'];
		try{
			$unModele=new filmsModele();
			$pochete=$unModele->verserFichier("pochettes", "pochette", "avatar.jpg",$titre);
			$requete="INSERT INTO films VALUES(0,?,?,?,?)";
			$unModele=new filmsModele($requete,array($titre,$duree,$res,$pochete));
			$stmt=$unModele->executer();
			retourMessage("Film bien enregistre");
		}catch(Exception $e){
		}finally{
			unset($unModele);
		}
	}
	
	function lister(){
		global $action;
		$requete="SELECT * FROM films";
		try{
			 $unModele=new filmsModele($requete,array());
			 $stmt=$unModele->executer();
			 listerFilms($stmt); 
		}catch(Exception $e){
		}finally{
			unset($unModele);
		}
	}
	
	function enlever(){	
		global $action;
		$idf=$_POST['numE'];
		try{
			$requete="SELECT * FROM films WHERE idf=?";
			$unModele=new filmsModele($requete,array($idf));
			$stmt=$unModele->executer();
			if($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
				$unModele->enleverFichier("pochettes",$ligne->pochette);
				$requete="DELETE FROM films WHERE idf=?";
				$unModele=new filmsModele($requete,array($idf));
				$stmt=$unModele->executer();
				retourMessage("Film ".$idf." bien enleve");
			}
			else{
				retourMessage("Film ".$idf." introuvable");
			}
		}catch(Exception $e){
		}finally{
			unset($unModele);
		}
	}
	
	function fiche(){
		global $action;
		$idf=$_POST['numF'];
		$requete="SELECT * FROM films WHERE idf=?";
		try{
			 $unModele=new filmsModele($requete,array($idf));
			 $stmt=$unModele->executer();
			 listerFilms($stmt);
		}catch(Exception $e){
		}finally{
			unset($unModele);
		}
	}
	
	function modifier(){
		global $action;
		$titre=$_POST['titreF'];
		$duree=$_POST['dureeF'];
		$res=$_POST['resF'];
		$idf=trim($_POST['idf']); 
		try{
			//Recuperer ancienne pochette
			$requette="SELECT pochette FROM films WHERE idf=?";
			$unModele=new filmsModele($requette,array($idf));
			$stmt=$unModele->executer();
			$ligne=$stmt->fetch(PDO::FETCH_OBJ);
			$anciennePochette=$ligne->pochette;
			$pochette=$unModele->verserFichier("pochettes", "pochette",$anciennePochette,$titre);	
			
			$requete="UPDATE films SET titre=?,duree=?, res=?, pochette=? WHERE idf=?";
			$unModele=new filmsModele($requete,array($titre,$duree,$res,$pochette,$idf));
			$stmt=$unModele->executer();
			retourMessage("Film ".$idf." bien modifie");
		}catch(Exception $e){
		}finally{
			unset($unModele);
		}
	}
	//******************************************************
	//Contrôleur
	$action=$_POST['action'];
	switch($action){
		case "enregistrer" :
			enregistrer();
		break;
		case "lister" :
			lister();
		break;
		case "enlever" :
			enlever();
		break;
		case "fiche" :
			fiche();
		break;
		case "modifier" :
			modifier();
		break;
	}
?>