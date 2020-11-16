<?php
	define("SERVEUR","localhost");
	define("USAGER","root");
	define("PASSE","");
	define("BD","h18bdfilms");
	if(!$connexion=@mysql_connect(SERVEUR,USAGER,PASSE)){
		echo "Probleme de connexion au serveur de bd";
		exit;
	}
	@mysql_select_db(BD,$connexion);
?>