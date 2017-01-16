<?php
/**
 * @name evenement.class.php Service de gestion d'une ligne d'événement
 * @author webdev - 2016 - 2017
 * @package back-end/Evenements/modele
 * @version 1.0
**/
class evenement {
	/**
	 * @property string evenement_id : Valeur de l'identifiant de la table evenement
	 * @property string titre : Titre de l'événement
	 * @property string description : Description
	 * @property string date_debut : Date de début
	 * @property string date_fin : Date de fin
	 * @property string heure_debut : Heure de début
	 * @property string heure_fin : Heure de fin
	 * @property int type : Type de l'événement
	 * @property string lieu : Lieu éventuel
	 * @property int places_disponibles : Nombre de places disponibles
	 * @property string ordre_du_jour : Ordre du jour
	 * @property string commission : Commission pour un événement privé
	 * @property string image : Illustration
	 * @property string programme : Programme
	**/
	
	/**
	 * Contenu d'une ligne de résultat de requête
	 * @var PDO Object
	 */
	private $rowContent;
	
	/**
	 * Instancie un nouvel enregistrement spécifique Evénement
	 * @param PDO Object $rowContent
	 */
	public function __construct($rowContent){
		$this->rowContent = $rowContent;
	}
	
	/**
	 * Retourne une colonne, si elle existe, d'une ligne d'événement...
	 * @param unknown $colName
	 * @return unknown
	 */
	public function __get($colName){
		if(property_exists($this->rowContent, $colName)){
			return $this->rowContent->{$colName};
		}
		
		// On a peut être demandé clePrimaire
		if($colName == "clePrimaire"){
			return $this->rowContent->evenement_id;
		}
	}
}