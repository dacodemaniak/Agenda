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
	
	public function __construct(){
		$this->template = "vue/textarea.php";
	}
	
	public function rowsAndColsFromArray($datas){
		$this->setRows($datas[0]);
		$this->setCols($datas[1]);
		
		return $this;
	}
	
	public function anonymousRowsAndCols($datas){
		foreach($datas as $key => $value){
			if(property_exists($this,$key)){
				$method = "set" . ucfirst($key); // Première ligne $method => setRows
				$this->$method($value);
			}
		}
		return $this;
	}
	
	public function setRowsAndCols($nbRows,$nbCols){
		if(is_int($nbRows))
			$this->rows = $nbRows;
		if(is_int($nbCols))
			$this->cols = $nbCols;
		
		return $this;
	}
	
	public function defineRowsAndCols($nbRows, $nbCols){
		$this->setRows($nbRows);
		$this->setCols($nbCols);
		
		return $this;
	}
	
	public function setRows($nbRows){
		if(is_int($nbRows)){
			$this->rows = $nbRows;
		}
		return $this;
	}
	
	public function setCols($nbCols){
		if(is_int($nbCols)){
			$this->cols = $nbCols;
		}
		return $this;
	}
	
	public function getRows(){
		return $this->rows;
	}
	

	
	public function getCols(){
		return $this->cols;
	}
}