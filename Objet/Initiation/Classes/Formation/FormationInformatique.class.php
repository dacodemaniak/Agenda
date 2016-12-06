<?php
/**
 * @name FormationInformatique.class.php Etend la classe Formation pour ne définir que les parties spécifiques informatique
* @package /Objet/Initiation/Classes/Formation
* @see Formation.class.php
**/
class FormationInformatique extends Formation {

	/**
	 * @var private string $chapitre Chapitre de la formation
	 **/
	private $chapitre;

	/**
	 * public function __construct(string $nomChapitre [, int $duree])
	 *	@param string $nomChapitre : définit la valeur de l'attribut $this->chapitre
	 *	@param int optionnal $duree : définit la propriété parente $this->duree, mais par l'utilisation de la méthode setDuree()
	 **/
	public function __construct($nomChapitre,$duree=null){
		$this->titre = "Informatique"; // Directement, on accède à la propriété protégée de la classe parente
		$this->chapitre = $nomChapitre;

		if(!is_null($duree)){
			$this->setDuree($duree); // Appelle la méthode parente, pour filtrer la durée
		} else {
			$this->duree = 15; // Fixe arbitrairement la durée du chapitre à 15h
		}

	}

	public function setChapitre($chapitre){
		$this->chapitre = $chapitre;
	}

	public function getChapitre(){
		return $this->chapitre;
	}
}