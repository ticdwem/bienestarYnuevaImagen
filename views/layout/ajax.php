<?php 
require_once "../../controllers/PacienteController.php";
require_once "../../models/pacienteModels.php";
require_once "../../helpers/validacion.php";


class Ajax{
	public $arraySent;
	public $arrayLinea;
	private $dato;
	public $producto;

public function getDato()
{
    return $this->dato;
}

public function setDato($archivo)
{
    $this->dato = $archivo;
    return $this;
}


	public function selectMun(){
		$query = $this->getDato();
		$sent = new PacienteController();
		$sent->getMunicipio($query);
	}
	public function verifCorreo(){
		$query = $this->getDato();
		$sent = new PacienteController();
		$sent->getCorreoExistent($query);
	}


}
// echo "<pre>";
// var_dump($_SERVER['DOCUMENT_ROOT']."\config\modeloBase.php");
// echo "</pre>";
// exit();

if(isset($_POST["idEstado"])){
	$sent = new Ajax();
	$sent -> setDato($_POST["idEstado"]);
	$sent -> selectMun();
}

if(isset($_POST["correo"])){
	$sent = new Ajax();
	$sent -> setDato($_POST["correo"]);
	$sent -> verifCorreo();
}
