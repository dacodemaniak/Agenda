<?php
/**
 * le script qui essaye d'accéder aux attributs de la classe classParente
**/
require("Classes/Portee/classParente.class.php");
require("Classes/Portee/classFille.class.php");

// Instancier un objet de la classe Parente
$portee = new classFille;

echo "Publique répond : " . $portee->publique . "<br />";
echo "Protégée répond : " . $portee->getProtege() . "<br />";
echo "Privé répond : " . $portee->getPrive() . "<br />\n";