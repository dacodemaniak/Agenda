<?php
/**
* @name deconnexion.php : Supprime les variables de session et redirige vers la page d'identification
**/
session_start();

unset($_SESSION["nom"]);
unset($_SESSION["prenom"]);
unset($_SESSION["age"]);

header("Location: age_confirmation.php");