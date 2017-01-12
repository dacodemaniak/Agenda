<?php
/**
 * @name delete.php : Script appelé en Ajax permettant la suppression d'un événement
 **/
$id = $_POST["id"];

require_once(dirname(__FILE__) . "/../../../appLoader.class.php");
$appLoader = new appLoader();

$evenement = new evenements();
$evenement->delete($id);

// Prépare l'information à retourner au script jQuery
$resultat = array(
		"statut" => 1,
		"row" => "row_" . $id
);

// On envoie le tout vers la sortie standard
/**
 {
 "statut": 1,
 "row": "row_1"
 }
 **/
echo json_encode($resultat);