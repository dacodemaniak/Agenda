<?php
/**
 * @name appLoader.class.php
 * 	Services de chargement des applications
 * 	Intègre la méthode autoload pour le chargement automatique des classes
 * @author webdev - 2016 - 2017
 * @package \
 * @version 1.0
**/
class appLoader {
	
	/**
	 * Stocke le dossier racine de l'application courante, base de notre recherche
	 * @var string
	 */
	private static $dossierRacine;
	
	/**
	 * Instancie un nouvel objet de chargement d'application
	**/
	public function __construct(){
		spl_autoload_register(array(__CLASS__,"autoload"));
	}
	
	/**
	 * Méthode de chargement automatique des classes
	 * @param string $className
	 */
	public static function autoload($className){
		self::$dossierRacine = $_SERVER["DOCUMENT_ROOT"] . "/Intranet/";
		
		//1. On cherche d'abord dans le dossier Classes de l'application
		
		$cheminCompletClasse = self::chercherClasse(self::$dossierRacine . "Classes/",$className);
		
		if(!$cheminCompletClasse){
			#begin_debug
			#echo "En désespoir de cause, la classe " . $className . " n'a pas été trouvé dans /Classes/, ni dans aucun de ses sous-dossiers<br />";
			#echo "On va donc parcourir le site dans son ensemble...<br />";
			#end_debug
			
			$cheminCompletClasse = self::chercherClasse(self::$dossierRacine,$className);
		}
		
		if($cheminCompletClasse){
			#begin_debug
			#echo "Ouffff... J'ai trouvé " . $className . " et elle se trouve dans " . $cheminCompletClasse . "<br />\n";
			#end_debug
			
			require_once($cheminCompletClasse);
			return true;
		}
		
		// La classe n'a jamais pu être trouvée...
		#begin_debug
		#echo "La classe " . $className . " n'a pas pu être trouvée ni dans /Classes/, ni à partir de la racine de l'application<br />\n";
		#end_debug
		
		throw new Exception("Impossible de trouver la classe " . $className, -100001);
		
		return false;
	}
	
	private static function chercherClasse($dossier, $className){
		
		#begin_debug
		#echo "Instancie un iterator avec " . $dossier . " pour chercher " . $className . " à partir de " . $_SERVER["PHP_SELF"] . "<br />\n";
		#end_debug
		
		// \DirectoryIterator retourne la liste des dossiers et des fichiers du dossier $dossier
		$listeFichier = new \DirectoryIterator($dossier);
		
		foreach($listeFichier as $element){
			
			if($element->isDot()){
				#begin_debug
				#echo "Dans le dossier : " . $dossier . " on a un dossier \".\" ou \"..\"<br />";
				#end_debug
				
				continue; // Revient à l'instruction foreach sans exécuter tout le reste
			}
			
			if($element->isDir()){
				#begin_debug
				#echo "L'élément est un dossier, il s'appelle " . $element->getFileName() . "<br />";
				#end_debug
				
				// L'élément lu est un dossier, on vérifie le dossier commence par "_"
				if(substr($element->getFilename(),0,1) == "_"){
					#begin_debug
					#echo "Le dossier : " . $element->getFileName() . " ne sera pas traité, il commence par \"_\"<br />\n";
					#end_debug
					continue;
				}
				
				#begin_debug
				#echo "On rappelle la méthode chercherClasse() avec les paramètres : " . $dossier . $element->getFilename() . ", " . $className . "<br />";
				#end_debug
				
				// Il s'agit d'un dossier, on va entrer dans ce nouveau dossier pour le parcourir à son tour
				if($resultat = self::chercherClasse($dossier . $element->getFilename() . "/", $className)){
					
					// On a donc trouvé dans ce nouveau dossier ce qu'on cherche...
					return $resultat; // On sort de la boucle itérative avec le chemin complet à charger
				} else {
					continue; // On passe à l'élément suivant
				}
			} else {
				#begin_debug
				#echo "On traite un fichier, dont le nom est : " . $element->getFileName() . " on le compare à " . $className . "<br />\n";
				#end_debug
				
				// Il s'agit donc d'un fichier...
				if($element->getFileName() == $className . ".class.php" 
						|| $element->getFileName() == $className . ".php"
						|| $element->getFileName() == "class." . $className . ".php"){
					// Et il s'agit bien de celui qu'on recherche
					#begin_debug
					#echo "C'est le fichier qu'on recherche, " . $className . " on le retourne...<br />\n";
					#end_debug
					return $dossier . $element->getFilename();
				}
			}
		}
		
		#begin_debug
		#echo "On n'a pas pu trouver le fichier " . $className . " dans notre application.<br />";
		#end_debug
		
		return false; // Le fichier demandé n'a pas pu être trouvé...
	}
}