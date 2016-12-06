<?php
/**
 * @name Formateur.class.php Définit une Personne mais dont le rôle sera d'être formateur
**/
class Formateur extends Personne {
	
	private $matiere;

	/**
	 * public function __construct(string $nom, string $prenom)
	 *	@var string $nom Nom du formateur (c'est aussi le nom d'une personne)
	 *	@var string $prenom Prénom du formateur (c'est aussi le prénom d'une personne)
	 **/
	public function __construct($nom, $prenom){
		parent::__construct($nom, $prenom); // Appelle le constructeur parent, pour définir les nom et prénoms de la Personne
	}
	
	public function setMatiere($matiere){
		$this->matiere = $matiere;
	}
	
	public function getMatiere(){
		return $this->matiere;
	}
	
	/**
	 * overloading (surcharge de méthode)
	 **/
	public function __destruct(){}
}