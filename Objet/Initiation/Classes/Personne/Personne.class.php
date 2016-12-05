<?php
/**
 * @name Personne.class.php Modèle pour la création des instances de personnes physiques
* @author webDev 2016-2017
* @version 1.0.0
* @package /Objet/Initiation/Classes/Personne
**/
class Personne {
	/**
	 * @var private string $nom
	 *	Stocke le nom de la personne physique qui sera instanciée
	 **/
	private $nom;

	/**
	 * @var private string $prenom
	 *	Stocke le prénom de la personne physique qui sera instanciée
	 **/
	private $prenom;
	
	/**
	 * Définit et stocke l'âge de la personne
	 * @var int
	 */
	private $age;
	
	private $anneeNaissance;
	
	/**
	 * public void __construct(string $nom, string $prenom)
	 *	@param string $nom : Nom de la personne
	 *	@param string $prenom : Prénom de la personne
	 **/
	public function __construct($nom, $prenom){
		$this->nom = $nom;
		$this->prenom = $prenom;
	}

	/**
	 * public void __destruct(void)
	 **/
	public function __destruct(){
		echo "Vous nous quittez déjà ? " . $this->prenom . " " . $this->nom . "<br />";
	}

	/**
	 * public string __toString(void)
	 *	Méthode automatiquement appelée par PHP lorsqu'on fait echo $objet;
	 **/
	public function __toString(){
		$dump = "<pre><code>";
		$dump .= "Attribut public nom => " . $this->nom . "<br />\n";
		$dump .= "Attribut public prenom => " . $this->prenom . "<br />\n";
		$dump .= "Attribut prive age => " . $this->age . "<br />\n";
		$dump .= "Attribut prive anneeNaissance => " . $this->anneeNaissance . "<br />\n";
		$dump .= "</code></pre>";
	
		return $dump;
	}
	
	/**
	 * public void setAge(int $age)
	 *	@param int $age Age de la personne
	 *	setter
	 **/
	public function setAge($age){
		if(is_numeric($age)){
			$this->age = $age;
			$this->setAnneeNaissance();
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
			$this->setAnneeNaissance();
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
				$this->setAnneeNaissance();
				return $this;
			}
		}
		return $this->age;
	}
	
	/**
	 * public string getNom(void)
	 *	@return string Valeur de l'attribut privé $this->nom définit dans le constructeur
	 **/
	public function getNom(){
		return $this->nom;
	}
	
	/**
	 * public string getPrenom(void)
	 *	@return string Valeur de l'attribut privé $this->prenom définit dnas la constructeur
	 **/
	public function getPrenom(){
		return $this->prenom;
	}
	
	/**
	 * public string getNomComplet(void)
	 *	@return string : Concaténation de l'attribut privé $this->prenom et de l'attribut privé $this->nom
	 **/
	public function getNomComplet(){
		return $this->prenom . " " . $this->nom;
	}

	/**
	 * public string getAnneeNaissance(void)
	 *	@return string : année de naissance ou message d'erreur si le calcul n'a pas pu être fait
	 **/
	public function getAnneeNaissance(){
		if(!is_null($this->anneeNaissance)){
			return $this->anneeNaissance;
		}
		return "L'année de naissance n'a pas pu être calculée, vérifiez les appels dans votre code !";
	}
	
	/**
	 * private void setAnneeNaissance(void)
	 *	Calcule l'année de naissance à partir de l'âge qui a été défini, et de l'année courante
	 **/
	private function setAnneeNaissance(){
		$anneeCourante = 0;
		
		$anneeCourante = date("Y"); // La fonction interne PHP date() retourne la date courante
		$this->anneeNaissance = $anneeCourante - $this->age;
	}
}