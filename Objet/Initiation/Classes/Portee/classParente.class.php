<?php
/**
 *
**/
class classParente{
	public $publique;
	protected $protege;
	private $prive;

	public function __construct(){
		$this->publique = "Bonjour, le monde extérieur peut me voir directement";

		$this->protege = "Bonjour, je suis protégé, on ne peut accéder à moi que par moi-même, ou mes classes filles";

		$this->prive = "Bonjour, moi je suis très timide, on ne peut pas accéder à moi directement...";
	}
	
	protected function getPrive(){
		return $this->prive . " [En passant par un getter de la classe parente]";
	}
}