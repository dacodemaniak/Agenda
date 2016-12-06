<?php
/**
 *
**/
class classFille extends classParente {

	public function __construct(){
		parent::__construct();
		echo "Ici, dans la classe fille, protege répond : " . $this->protege . "<br />\n";
	}
	
	public function getProtege(){
		return $this->protege . " [en passant par un getter pour être visible du monde extérieur]";
	}
	
	public function getPrive(){
		return parent::getPrive();
	}
}