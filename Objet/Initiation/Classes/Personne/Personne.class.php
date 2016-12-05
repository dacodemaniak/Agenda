<?php
/**
 * @name Personne.class.php Modèle pour la création des instances de personnes physiques
* @author webDev 2016-2017
* @version 1.0.0
* @package /Objet/Initiation/Classes/Personne
**/
class Personne {
	/**
	 * @var public string $nom
	 *	Stocke le nom de la personne physique qui sera instanciée
	 **/
	public $nom;

	/**
	 * @var public string $prenom
	 *	Stocke le prénom de la personne physique qui sera instanciée
	 **/
	public $prenom;
	
	/**
	 * Définit et stocke l'âge de la personne
	 * @var int
	 */
	private $age;
	
	/**
	 * public void setAge(int $age)
	 *	@param int $age Age de la personne
	 *	setter
	 **/
	public function setAge($age){
		if(is_numeric($age)){
			$this->age = $age;
		}
	}

	/**
	 *	public boolean definitAge(int $age)
	 *	@param int $age : Age qui doit être affecté à la propriété privée $this->age
	 *	@return boolean : Vrai si l'affectation a réussi, faux sinon
	 **/
	public function definitAge($age){
		if(is_numeric($age) && $age > 0){
			$this->age = $age;
			return true;
		}
		return false;
	}
	
	/**
	 * public int getAge(void)
	 *	@return int Age de l'instance de classe Personne
	 *	getter pour retourner le contenu d'un attribut de la classe
	 **/
	public function getAge(){
		return $this->age;
	}
	
	/**
	 * public int | Personne age([int $age])
	 *	@param optionnal int $age Age à définir si le paramètre est non null
	 *	@return int | Personne
	 * Définit ou retourne l'âge de la personne courante
	 **/
	public function age($age = null){
		if(!is_null($age)){
			if(is_numeric($age)){
				$this->age = $age;
				return $this;
			}
		}
		return $this->age;
	}
}