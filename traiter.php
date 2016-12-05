<?php
/**
* traiter.php : Traite les données du formulaire de contact
**/
$mailContent = "";

// Pour récupérer les données postées, on va utiliser le tableau "interne" PHP : $_POST[]
// Pour accéder aux valeurs du tableau $_POST, on va utiliser une boucle foreach()
foreach($_POST as $cle_tableau => $valeur_tableau){
	$mailContent .= $cle_tableau . " : " . $valeur_tableau . "<br />";
}

header("Location:formulaire_jquery_rc4.php?process=ok"); // header