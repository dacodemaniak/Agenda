<?php
/**
 * @name evenements.class.php Services de relation entre le contrôleur et la table evenements de la base de données
* @author webdev - Déc. 2016
* @package Agenda/back-end/Evenements/modele
* @version 1.0
*	- Une méthode permettant de lister tous les événements : select()
*	- Une méthode permettant de ne récupérer que l'événement par son identifiant : selectById()
*	- Une méthode pour dispatcher la mise à jour : save()
*	- Une méthode privée pour l'insertion : add()
*	- Une méthode privée pour la mise à jour : update()
* @see Intranet/Modele/civilite.class.php
**/

class evenements extends Modele{
	/**
	 * Tableau de stockage des colonnes de la table Evenements
	 * @var array $colonnes;
	 **/
	private $colonnes;

	/**
	 * Données postées depuis un formulaire
	 * @var array $postedDatas
	 **/
	private $postedDatas;
	
	/**
	 * Stocke l'ensemble des événements à traiter
	 * @var array $evenements;
	 **/
	public $evenements;


	public function __construct(){
		// Créer un tableau avec le nom des colonnes de la table concernée
		$this->colonnes = array(
				"type",
				"date_debut",
				"date_fin",
				"heure_debut",
				"heure_fin",
				"titre",
				"description",
				"lieu",
				"places_disponibles",
				"ordre_du_jour",
				"commission",
				"image",
				"programme"
		);
		
		$this->primaryKeyName = "evenement_id";
		$this->tableName = "evenements";

		$this->evenements = array();
	}
	
	/**
	 * Méthode magique appelée par PHP à chaque fois qu'on veut accéder à une donnée de la classe courante
	 * @param string $nomAttribut : Nom de l'attribut de la classe à retourner
	 */
	public function __get($nomAttribut){
		if(in_array($nomAttribut, $this->colonnes)){
			return sizeof($this->evenements) ? $this->evenements[$nomAttribut] : "";
		}
		
		return false;
		
		if(!property_exists($this,$nomAttribut)){ // la valeur de $nomAttribut ne correspond pas à un attribut de la classe courante
			#echo "L'attribut : " . $nomAttribut . " n'existe pas dans la classe courante evenements<br />\n";
			// Est-ce que par hasard, l'attribut ne serait pas une clé du tableau $this->evenements
			#echo "Le tableau evenements contient : " . sizeof($this->evenements) . "<br />\n";
			if(sizeof($this->evenements)){
				if(in_array($nomAttribut, $this->colonnes)){
					// J'ai une ligne dans l'attribut $this->evenements, je suis donc passé par $this->selectById()
					if(array_key_exists($nomAttribut, $this->evenements)){
						// Et en plus, $nomAttribut correspond à une clé de ce tableau...
						return $this->evenements[$nomAttribut];
					}
				}
			}
		}
		return "Attribut non accessible directement !";
	}
	
	/**
	 * Crée et exécute un SELECT sur la table evenements pour l'ensemble des données
	 **/
	public function select(){
		// La variable $select contiendra la requête SQL "SELECT... FROM..." à exécuter, cette variable n'est visible que de la méthode elle-même
		$select = "SELECT " . $this->primaryKeyName . ",";
		$select .= implode(",", $this->colonnes); // La fonction implode() assemble les éléments d'un tableau en les séparant par une chaîne et retourne une chaîne de caractères.
		$select .= " FROM " . $this->tableName;

		#begin_debug
		#echo "Chaîne de requête : " . $select . "<br />";
		#end_debug

		// Instancie un objet de connexion à la base de données
		$connexion = new dbConnect();
		$base = $connexion->getBase(); // $base est un objet de type PDO

		if(!is_null($base)){
			// On a bien une instance de PDO de connexion à la base de données
			// On peut donc exécuter la requête (Méthode PDO::query()) et récupérer le jeu de résultats dans la variable $resultats
			$resultats = $base->query($select);
				
			// Vérifie si $resultats est différent de faux ($resultats est faux si la requête n'a pas pu être exécutée)
			if($resultats !== false){
				$resultats->setFetchMode(PDO::FETCH_OBJ); // Parcourt le jeu de résultat en créant un objet à chaque ligne parcourue
				// Boucle sur chaque ligne de résultats, et on stocke la valeur dans l'objet $ligne
				while($ligne = $resultats->fetch()){
					$evenement = array(); // Créer pour chaque ligne parcourue un tableau vide
					$evenement["clePrimaire"] = $ligne->{$this->primaryKeyName}; // Stocke la valeur de l'identifiant de l'événement
					foreach($this->colonnes as $colonne){
						if($colonne == "date_debut" || $colonne == "date_fin"){
							$evenement[$colonne] = dateHelper::toFrDate($ligne->{$colonne});
						} else {
							$evenement[$colonne] = $ligne->{$colonne};
						}
					}
					// Ajoute la ligne dans le tableau final
					$this->evenements[] = $evenement;
				}
			}
		}
	}

	/**
	 * public void selectById(int $id)
	 *	@param int $id : Valeur de l'identifiant sur lequel exécuter la requête SQL
	 *	@return void
	 **/
	public function selectById($id){
		if($id > 0){
			// Crée la requête de sélection d'un seul enregistrement (une seule ligne) à partir de la valeur d'un identifiant ($id)
			$select = "SELECT " . $this->primaryKeyName . ",";
			$select .= implode(",", $this->colonnes);
			$select .= " FROM " . $this->tableName;
			// Ajoute la contrainte : clé-primaire = paramètre $id transmis
			$select .= " WHERE " . $this->primaryKeyName . "=" . $id . ";";
				
			#begin_debug
			#echo "Requête générée : " . $select . "<br />";
			#end_debug
			// Instancie un objet de connexion à la base de données
			$connexion = new dbConnect();
			$base = $connexion->getBase(); // $base est un objet de type PDO
				
			if(!is_null($base)){
				// On a bien une instance de PDO de connexion à la base de données
				// On peut donc exécuter la requête (Méthode PDO::query()) et récupérer le jeu de résultats dans la variable $resultats
				$resultats = $base->query($select);

				// Vérifie si $resultats est différent de faux ($resultats est faux si la requête n'a pas pu être exécutée)
				if($resultats !== false){
					$resultats->setFetchMode(PDO::FETCH_OBJ); // Parcourt le jeu de résultat en créant un objet à chaque ligne parcourue
					// Une seule ligne ne peut être retournée par cette requête... ou aucune
					$ligne = $resultats->fetch();
					if($ligne !== false){
						// La méthode "fetch()" a bien retourné la ligne correspondante à l'id ($id)
						$this->evenements["clePrimaire"] = $ligne->{$this->primaryKeyName};
						// Alimente le reste du tableau
						foreach($this->colonnes as $colonne){
							if($colonne == "date_debut" || $colonne == "date_fin"){
								$this->evenements[$colonne] = dateHelper::toFrDate($ligne->{$colonne});
							} else {
								$this->evenements[$colonne] = $ligne->{$colonne};
							}
						}
					}
				}
			}
		} else {
			echo "L'id passé est incorrect : $id";
		}
	}

	/**
	 * Retourne le tableau d'événements avec une ligne vide
	 **/
	public function emptyEvents(){
		// La clé primaire est vide aussi
		$this->evenements["clePrimaire"] = "";
		foreach($this->colonnes as $colonne){
			$this->evenements[$colonne] = "";
		}

	}

	/**
	 * Met à jour la colonne image de la table evenement sur l'ID evenement_id transmis en paramètre
	 **/
	public function updateImage($id){
		$result = false; // On considère par défaut que la requête va échouer
	
		$update = "UPDATE " . $this->tableName . " SET image='' WHERE " . $this->primaryKeyName . "=" . $id . ";";

		#begin_debug
		#echo "Requête : <pre><code>" . $update . "</code></pre>";
		#end_debug
		
		$connexion = new dbConnect();
		$base = $connexion->getBase(); // $base est un objet de type PDO
	
		if(!is_null($base)){
			$result = $base->exec($update);
		}

		#begin_debug
		#echo $result ? 1 : 0;
		#end_debug
		
		return $result;
	}
	
	/**
	 * Dispatcher de requête : ajout ou modification en fonction du contexte
	 **/
	public function save($postedDatas){
		// Contrôle l'existence de la clé "clePrimaire" dans le tableau de données postées
		if(array_key_exists("clePrimaire",$postedDatas)){
			if($postedDatas["clePrimaire"] != ""){
				// Une valeur de clé primaire a été transmise... donc, mise à jour
				$this->update($postedDatas);
			} else {
				$this->insert($postedDatas);
			}
		}
	}
	
	private function insert($postedDatas){
		$connexion = new dbConnect();
		$base = $connexion->getBase(); // $base est un objet de type PDO
	
		if(!is_null($base)){
			// La connexion étant établie avec le serveur de bases de données, on peut créer la requête d'insertion
			$insert = "INSERT INTO " . $this->tableName . "(";
			//$insert .= implode(",",$this->colonnes) . ") VALUES (";
			$colonnes = array_keys($postedDatas); // array_keys retourne un tableau ne contenant que les clés d'un tableau associatif
			#begin_debug
			#var_dump($colonnes);
			#end_debug
			array_pop($colonnes); // array_pop dépile une ligne à la fin du tableau, en le raccourcissant d'une ligne
			
			#begin_debug
			#var_dump($colonnes);
			#end_debug
			
			$insert .= implode(",",$colonnes) . ") VALUES (";
			// Boucle sur les données postées, pour alimenter la requête INSERT
			foreach($postedDatas as $colName => $colValue){
				if($colName != "clePrimaire"){
					if($colName == "date_debut" || $colName == "date_fin"){
						$insert .= $base->quote(dateHelper::toUsDate($colValue)) .",";
					} else {
						if($colName == "places_disponibles"){
							if($colValue == ""){
								$insert .= "0,";
							} else {
								$insert .= (int) $colValue . ",";
							}
						} else {
							$insert .= $base->quote($colValue) . ",";
						}
					}
				}
			}
			// On supprime la virgule en trop...
			$insert = substr($insert,0,strlen($insert)-1) . ");";
				
			#begin_debug
			#echo "Requête d'insertion : " . $insert . "<br />";
			#end_debug
			
			$resultat = $base->exec($insert);
				
			return $resultat;
			
		}
	}
	
	private function update($postedDatas){
		$connexion = new dbConnect();
		$base = $connexion->getBase(); // $base est un objet de type PDO
		
		$update = "UPDATE " . $this->tableName . " SET ";
	
		foreach($postedDatas as $colName => $colValue){
			if($colName != "clePrimaire"){
				// Attention, les dates doivent être traitées de manière un peu particulière
				if($colName == "date_debut" || $colName == "date_fin"){
					$update .= $colName . " = '" . dateHelper::toUsDate($colValue) . "',";
				} else {
					$update .= $colName . " = " . $base->quote($colValue) . ",";
				}
			}
		}
		// Ne pas oublier de supprimer la dernière virgule inutile
		$update = substr($update,0,strlen($update)-1);
	
		// Attention, ne pas oublier non plus de définir quelle ligne on veut mettre à jour
		$update .= " WHERE " . $this->primaryKeyName . " = " . $postedDatas["clePrimaire"] . ";";
	
		#debug
		#echo "Requête de mise à jour : " . $update . "<br />\n";
		#end_debug
		
		$resultat = $base->exec($update);
			
		return $resultat;
	
	}
}