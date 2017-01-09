<?php
/**
* @name champHTML.class.php : abstraction de champs HTML
**/
abstract class champHTML {
	/**
	* Définit la valeur de l'attribut "name" de n'importe quel type de champ de formulaire
	*	@var string $name
	**/
	public $name;
	
	/**
	 * Définit la vue à charger pour restituer le champ
	 * @var string
	 */
	protected $template;
	
	/**
	* array $cssClasses : tableau contenant les classes CSS à utiliser pour la représentation du champ
	**/
	protected $cssClasses;
	
	/**
	* Définit si l'attribut "disabled" du champ doit être activé
	* @var boolean $disabled => true si le champ doit être désactivé, faux sinon
	**/
	public $disabled = false;
	
	public function setName($name){
		if(is_null($this->name))
			$this->name = $name;
	}
	
	/**
	* Méthode getName(bool $toUpper) => ne peut s'appeler que sous cette forme $obj->getName(true) ou $obj->getName(false)
	* Méthode getName([bool $toUpper=false]) => $obj->getName() / $obj->getName(true) / $obj->getName(false)
	**/
	public function getName($toUpper=false){
		if($toUpper == true)
			return strtoupper($this->name);
		
		return $this->name;
	}
	
	public function addCssClass($cssClass){
		if(is_array($this->cssClasses)){
			if(!in_array($cssClass, $this->cssClasses)){
				$this->cssClasses[] = $cssClass;
			}
		} else {
			$this->cssClasses[] = $cssClass;
		}
		return $this; // La méthode va retourner l'instance de l'objet concerné
	}
	
	public function getCssClasses(){
		$retour = ""; // Chaîne qui sera retournée en sortie de méthode
		
		if(sizeof($this->cssClasses) > 0){
			$retour = implode(" ", $this->cssClasses);
		}
		
		return $retour;
	}
	
	public function render(){
		$field = $this;
		include($this->template);
	}
}