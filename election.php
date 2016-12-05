<?php
/**
 * @name election.php : Résolution du cas élection v. 1
 */

/**
 * Définition des fonctions utiles
 */

/**
 * Calcul le nombre total de votants
 * @param array $votes Tableau contenant les résultats obtenus par les candidats
 */
 function totalVote($votes){
 	$total = 0; // Stocke le total des votes
 	
 	for($i=0; $i < sizeof($votes); $i++){
 		$total += $votes[$i];
 	}
 	return $total;
 }
 
 /**
  * Calcule le score en pourcentage pour un candidat
  * @param int $voix Voix gagnées
  * @param int $totalVoix Total des votes
  */
 function score($voix, $totalVoix){
 	$score = ($voix / $totalVoix) * 100;
 	return $score;
 }
 
 /**
  * Affiche le résultat du scrutin au premier tour
  * @param array $scrutin Résultats obtenus au premier tour
  */
 function afficheResultat($scrutin){
 	$sortie = "<ul>\n";
 	for($i = 0; $i < sizeof($scrutin); $i++){
 		$sortie .= "<li>" . $scrutin[$i] . "</li>\n";
 	}
 	$sortie .= "</ul>";
 	
 	return $sortie;
 }
 
/**
 * Début du script
**/
 $totalVotant = 250; // Total des participants au scrutin
 $resultats = array(50, 30, 20, 25, 75, 50); // Résultats obtenus par les 4 candidats
 $resultat = array(); // Stocke le résultat final de l'élection
 $totalVote = 0; // Résultat du nombre de votants
 
 $totalVote = totalVote($resultats); // Appelle la fonction totalVote pour déterminer le total des votes exprimés
 
 if($totalVote <= $totalVotant){
	 for($i = 0; $i < sizeof($resultats); $i++){
	 	$score = score($resultats[$i], $totalVote); // Calcule le score du candidat courant
	 	$numCandidat = $i + 1;
	 	if($score > 50){
	 		// Le candidat est élu au premier tour.
	 		$resultat[] = "Le candidat n° " . $numCandidat . " est élu au premier tour avec : " . $score . " % des voix";
	 	} elseif($score >= 12.5){
	 		$resultat[] = "Le candidat n° " . $numCandidat . " est éligible au second tour : " . $score . " % des voix";
	 	} else {
	 		$resultat[] = "Le candidat n° " . $numCandidat . " est éliminé au premier tour : " . $score . " % des voix";
	 	}
	 }
	 // En fin de parcours, on peut afficher le résultat du premier tour
	 echo afficheResultat($resultat);
 } else {
 	echo "Le nombre total de votants " . $totalVote . " dépasse 200, l'élection est annulée !";
 }