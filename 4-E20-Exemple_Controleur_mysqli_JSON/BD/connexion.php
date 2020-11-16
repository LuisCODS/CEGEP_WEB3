<?php
	$connexion = new mysqli("localhost", "root", "", "bdlivres");
	if ($connexion->connect_errno) {
		echo "Gros probleme";
		exit();
	}
?>