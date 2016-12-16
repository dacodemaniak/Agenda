<?php
/**
* @name textarea.class.php : Gestion des champs de type textarea
**/

/**
* Inclure la classe parente abstraite champHTML
**/
require_once("Classes/champHTML.class.php");

class textarea extends champHTML {
	/**
	* Définit le nombre de lignes visibles du champ
	* @var int $rows
	**/
	private $rows = 5;
	
	/**
	* Définit le nombre de colonnes visibles du champ
	* @var int $cols
	**/
	private $cols = 30;
	
	
	public function setRows($nbRows){
		if(is_int($nbRows)){
			$this->rows = $nbRows;
		}
	}
	
	public function getRows(){
		return $this->rows;
	}
	
	public function setCols($nbCols){
		if(is_int($nbCols)){
			$this->cols = $nbCols;
		}
	}
	
	public function getCols(){
		return $this->cols;
	}
}