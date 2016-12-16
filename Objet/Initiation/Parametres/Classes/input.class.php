<?php
/**
* @name input.class.php : Définition des attributs et de la balise HTML input
**/

/**
* Inclure la classe parente abstraite champHTML
**/
require("Classes/champHTML.class.php");

class input extends champHTML{
	
	/**
	* Définit la valeur de l'attribut "type" du champ input
	* @var string $type
	**/
	protected $type;
	
	/**
	* Stocke les types autorisés pour la construction de l'objet de type input
	*	@var array
	*	@see __construct()
	**/
	private $types;
	
	/**
	* Constructeur de la classe, appelé automatiquement lors de l'instanciation
	**/
	public function __construct(){
		// Initialiser les types autorisés
		$this->types = array(
			"text",
			"radio",
			"checkbox",
			"email",
			"date",
			"url",
			"numeric"
		);
	}
	
	/**
	* Retourne la valeur de l'attribut privé $type
	*	public string getType(void)
	*	@return string Type du champ de type input
	**/
	public function getType(){
		return $this->type;
	}
	
	/**
	* Définit la valeur de l'attribut $type en vérifiant qu'il s'agit bien d'un type autorisés
	* @param string $type : Type à affecter à l'attribut
	* @return void
	**/
	public function setType($type){
		if(in_array(strtolower($type), $this->types)){
			$this->type = $type;
		}
	}
	
	/**
	* Méthode de lecture ou d'écriture de la valeur de l'attribut protégé $type
	*	@param string $type optionnel, si null retourner la valeur de l'attribut, sinon, définir la valeur de cet attribut
	*	@return \input | string | boolean
	**/
	public function type($type=null){
		if(!is_null($type)){
			// La méthode a donc été appelée avec un paramètre
			if(in_array(strtolower($type), $this->types)){
				$this->type = strtolower($type);
				return true;
			} else {
				return false;
			}
		} else {
			// La méthode appelée sans paramètre retourne la valeur de l'attribut input::$type
			return is_null($this->type) ? "Type non défini" : $this->type;
		}
	}
}