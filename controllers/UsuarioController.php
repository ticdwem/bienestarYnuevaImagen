<?php
require_once 'models/usuario.php';
class UsuarioController{
    /*este es una clase de prueba para saber que todo esta bien relacionado */
    public function index(){
        echo "controllador usuario, acction index";
    }
    
    /*vista de registro del usuario*/
    public function registro(){
        require_once 'views/usuario/registro.php';
    }
    /*funcion para guardar el usuario*/
    public function save() {

        
}
