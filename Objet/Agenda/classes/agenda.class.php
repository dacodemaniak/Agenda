<?php
/**
 * @name agenda.class.php Collection des événements à traiter pour affichage
* @author webDev - Déc. 2016
* @package Objet/Agenda/Classes
* @version 1.0
**/
class agenda {
	/**
	 * Tableau contenant les objets événements créés dans le contrôleur
	 *	@var array $evenements
	 **/
	private $evenements = array();

	/**
	 * Ajoute un événement à la collection courante en calculant une clé, qui servira
	 *	à traiter les extractions ultérieurement
	 * @return \Agenda
	 **/
	public function addEvenement($evenement){
		// Calcule la clé à partir du nombre de lignes du tableau
		$indice = sizeof($this->evenements) + 1;
		
		$cle = "event_" . $indice;
		
		if(is_object($evenement)){
			$this->evenements[$cle] = $evenement;
		}

		return $this;
	}

	public function __toString(){
		$sortie = "<ul>";

		foreach($this->evenements as $cle => $evenement){
			$sortie .= "<li>[" . $cle . "] contient l'événement : " . $evenement->titre . " qui débutera le : " . $evenement->dateDebut() . "</li>";
		}

		$sortie .= "</ul>";

		return $sortie;
	}

	/**
	 * Trie les événements par ordre chronologique inverse et retourne le tableau trié
	 * @return array
	 **/
	public function getAllByDate(){
		//1. Parcourt le tableau d'origine pour lister générer un tableau associatif
		//	avec la clé et la date de l'événement pour chaque occurrence
		$datesEvenement = array();
		
		foreach($this->evenements as $cle => $evenement){
			$datesEvenement[$cle] = $evenement->dateDebut();
		}
		
		// 2. Applique la fonction asort() pour trier le tableau temporaire
		asort($datesEvenement); // Du plus petit au plus grand... ça ne va pas...
		//$eventsChrono = array_reverse($datesEvenement);
		
		//3. Parcourt le tableau trié pour récupérer les objets Evenement
		$tableauFinal = array(); // Reset le tableau temporaire utilisé
		foreach($datesEvenement as $cle => $value){
			$tableauFinal[$cle] = $this->evenements[$cle];
		}
		
		return $tableauFinal;
	}
	
	public function getAllByTitre(){
		$titresEvenement = array();
	
		foreach($this->evenements as $cle => $evenement){
			$titresEvenement[$cle] = $evenement->titre;
		}
	
		asort($titresEvenement);
	
		$tableauFinal = array();
	
		foreach($titresEvenement as $cle => $value){
			$tableauFinal[$cle] = $this->evenements[$cle];
		}
	
		return $tableauFinal;
	
	}
}