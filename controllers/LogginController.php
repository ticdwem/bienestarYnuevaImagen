<?php
require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/models/logginModel.php";

class LogginController{
    /*este es una clase de prueba para saber que todo esta bien relacionado */
    public function index(){
        $loginConsultorio = new Login();
        $consutorio = $loginConsultorio-> getAll('consultorio');

        require_once 'views/loggin/index.php';
    }
}