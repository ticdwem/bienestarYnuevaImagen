<?php
require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/models/logginModel.php";

class LogginController{
    /*este es una clase de prueba para saber que todo esta bien relacionado */
    public function index(){
        // $loginConsultorio = new Login();
        // $consutorio = $loginConsultorio-> getAll('consultorio');
        // $password = password_hash('123456789',PASSWORD_BCRYPT,['cost'=>4]);
        // $pass = '$2y$04$oeeUk0Ngo3dQafoULp.hxODhg0RKuJ5BUBypfzua5.p';
        // echo $password."<br>";
        // $verify = password_verify('123456789',$password);
        // if($verify){
        //     echo 'correcto';
        // }else{
        //     echo 'salio algo mal';
        // }
        require_once 'views/loggin/index.php';
    }
}