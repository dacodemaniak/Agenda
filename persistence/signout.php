<?php
/**
* @name signout.php Met fin à la session utilisateur et retourne à la page de login
**/
session_start();

// Effacer la variable de session "utilisateur"
unset($_SESSION["utilisateur"]);

// Rediriger vers la page login.php
header("Location: login.php");