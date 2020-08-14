<?php
require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/models/logginModel.php";

class LogginController{
    /*este es una clase de prueba para saber que todo esta bien relacionado */
    public function index(){
        $loginConsultorio = new Login();
        $consutorio = $loginConsultorio-> getAll('consultorio');
        //  $password = password_hash('123456789',PASSWORD_BCRYPT,['cost'=>4]);
        // $pass = '$2y$04$oeeUk0Ngo3dQafoULp.hxODhg0RKuJ5BUBypfzua5.p';
        //  echo $password."<br>";
        // $verify = password_verify('123456789',$password);
        // if($verify){
        //     echo 'correcto';
        // }else{
        //     echo 'salio algo mal';
        // }
        require_once 'views/loggin/index.php';
    }

    public function verifEmailLog($email){
        $validarEmail = Validacion::validarEmail($email);
        if($validarEmail != '0'){
            $login = new Login();
            $tipoUser = $login->getEmailExis($validarEmail);
            if($tipoUser && $tipoUser->num_rows == 1){
                $tipo = $tipoUser->fetch_object();
                $logiin["correo"] = $tipo->correoUsuario;
                $logiin["tipo"] = $tipo->tipoUsuario;
		
                header('content-type: application/json; charset=utf8');
                echo json_encode($logiin);
            }

        }
       
    }

    public function verificar(){
        Utls::deleteSession('usuario');
        $user = (Validacion::validarEmail($_POST["username"]) == '0') ? false : $_POST["username"];
        //$password = (Validacion::validarPass($_POST["pass"]) == '0') ? false : $_POST["pass"];
        $tipo = (Validacion::validarNumero($_POST["tipoUser"]) == '-1') ? false : $_POST["tipoUser"];
        if($tipo === "0"){
            $_SESSION['loggin'] = 'USUARIO O CONTRASEÑA SON INCORRECTOS';
            echo '<script>window.location="'.base_url.'"</script>';
        }elseif($tipo === "2" || $tipo === '3'){
            $consul = (Validacion::validarNumero($_POST["consul"]) == '-1') ? false : $_POST["consul"];
            if($consul == false){
                $_SESSION['loggin'] = 'SE HAN INGRESADO DATOS INCORRECTAMENTE VERIFIQUE POR FAVOR';
                echo '<script>window.location="'.base_url.'"</script>';
            }else{
                // buscar el usuario en la tabla consultorio
                $doctor = new Login();
                $doctor->setEmail($user);
                $doctor->setPass($_POST["pass"]);
                $resupuesta = $doctor->getDoctor();
                if($resupuesta){
                    $consulName = new Login();
                    $consulName->setId($consul);
                    $cosnultorio = $consulName->getConsultorio();
                
                    // creamos una session para mostrar titulos y para validaciones
                    $_SESSION['usuario'] = array(
                        'id' => $resupuesta->idUsuario,
                        'consultorio' =>$consul,
                        'nombre'=>$resupuesta->nombreUsuario,
                        'apeliidos'=>$resupuesta->apellidoUsuario,
                        'tipo'=>$resupuesta->tipoUsuario,
                        'status'=>$resupuesta->statusUusario,
                        'datos'=>$cosnultorio
                    );  
                    // redireccionamos
                    echo '<script>window.location="'.base_url.'Consultorio/nuevo"</script>';
                }else{
                    echo 'no encontramos algo';
                }
            }
            
        }
    }

    public function logout(){
        session_destroy();
        echo '<script>window.location="'.base_url.'"</script>';
    }
}