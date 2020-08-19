<?php
require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/models/consultaModels.php";
/* require_once $_SERVER['DOCUMENT_ROOT']."/models/consultorioModels.php"; */
class ConsultaController {
    /*este es una clase de prueba para saber que todo esta bien relacionado */
    public function index(){
        $paciente = new Consulta();
        $paciente->setId($_GET['id']);
        $datos = $paciente->getPaciente();
        require_once 'views/consultorio/consultaNuevoIngreso.php';
    }

    public function ingreso(){
        
    }
}

