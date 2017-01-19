<?php
/**
 * @name views.class.php Service de gestion des vues pour les applications
 * @author webdev - 2016 - 2017
 * @package Classes\Common\Views
 * @version 1.0
**/
class views {
	
	/**
	 * @property string title : Titre à afficher dans la vue
	 * @property string buttonLabel : Libellé à afficher dans le bouton de sélection
	**/
	
	/**
	 * Dossier de stockage des vues à utiliser
	 * @var string
	 */
	private $folder = "vues/";
	
	/**
	 * Nom du modèle à charger pour la vue courante
	 * @var string
	**/
	private $template;
	
	/**
	 * Instancie un nouvel objet views
	 * @param string $folder [Optionnel] Dossier de stockage des vues
	 */
	public function __construct($folder=null){
		if(!is_null($folder)){
			$this->setFolder($folder);
		}
	}
	
	/**
	 * Définit ou retourne le modèle à utiliser
	 * @param string $template
	 * @return string|views
	 */
	public function template($template=null){
		if(is_null($template)){
			return $this->folder . $this->template;
		}
		
		$this->template = $template;
		return $this;
	}
	
	/**
	 * Définit le dossier par défaut de stockage des vues
	 * @param string $folder
	 * @return views
	 */
	public function setFolder($folder){
		if(substr($folder,-1) !== "/"){
			$folder = $folder . "/";
		}
		$this->folder = $folder;
		
		return $this;
	}
	
	/**
	 * Méthode magique __set() permet de définir la valeur d'un attribut de préférence
	 * 	inexistant
	 * @param string $attributeName : Nom de l'attribut à traiter
	 * @param mixed $value : Valeur à attribuer à l'attribut
	 * @return views
	 */
	public function __set($attributeName, $value){
		if(!property_exists($this, $attributeName)){
			// L'attribut n'existant pas dans l'instance $this, on peut gérer, sinon... RISQUE
			$this->{$attributName} = $value;
		}
		
		return $this;
	}
	
	/**
	 * Méthode magique __get() Retourne la valeur d'un attribut de préférence inexistant
	 * @param string $attributeName
	 * @return mixed | null
	 */
	public function __get($attributeName){
		if(!is_null($this->{$attributeName})){
			return $this->{$attributeName};
		}
	}
	
	/**
	 * Méthode magique __call() permet d'appeler une méthode non définie dans la classe courante
	 * @param string $methodName
	 * @param array $params
	 * @return string | mixed | null
	 */
	public function __call($methodName, $params){
		switch($methodName){
			case "getPageTitle":
				return $this->title . " - [webDev]";
			break;
		}
	}
}