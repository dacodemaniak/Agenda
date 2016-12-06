<?php
/**
 * @name Formation.class.php Schéma d'un objet de type Formation
* @author webdev - 2016 - 2017
* @package /Objet/Initiation/Classes/Formation
* @version 1.0
**/
class Formation {

	/**
	 * @var string $titre Titre de la formation
	 **/
	protected $titre;

	/**
	 * @var int $duree : Durée de la formation >0 et <= 30
	 **/
	protected $duree;

	public function __construct(){
		$this->duree = 1; // Par défaut, on définit la durée à 1h
	}

	public function setTitre($titre){
		$this->titre = $titre;
	}

	public function getTitre(){
		return $this->titre;
	}

	public function setDuree($duree){
		if(is_int($duree)){
			if($duree > 0 && $duree <= 30){
				$this->duree = $duree;
			} else {
				if($duree == 0){
					$this->duree = 1;
				} elseif($duree > 30){
					$this->duree = 30;
				}
			}
		} else {
			$this->duree = 1; // Par défaut
		}
	}



	public function getDuree(){
		return $this->duree;
	}
}