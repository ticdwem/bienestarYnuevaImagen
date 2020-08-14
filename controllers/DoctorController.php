<?php
require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/models/doctorModels.php";
// require_once $_SERVER['DOCUMENT_ROOT']."/models/consultorioModels.php";
class DoctorController{
    /*este es una clase de prueba para saber que todo esta bien relacionado */
    public function index(){
        require_once 'views/doctor/altaDoctor.php';
    }
    
    /*vista de registro del usuario*/
    public function registro(){
        require_once 'views/usuario/registro.php';
    }
    /*funcion para guardar el usuario*/
    public function save() {
        if(isset($_POST)){            
            Utls::deleteSession('formulario');
            $Nombre = (Validacion::pregmatchletras($_POST["intputname"]) == '0') ? false : $_POST["intputname"] ;
            $Apellido_Pat = (Validacion::pregmatchletras($_POST["inputAppat"]) == '0') ? false : $_POST["inputAppat"] ;
            $Apellido_Mat = (Validacion::pregmatchletras($_POST["inputApmat"]) == '0') ? false : $_POST["inputApmat"] ;
            $sexo = (!isset($_POST["customRadioSexo"]) || Validacion::pregmatchletras($_POST["inputApmat"]) == '0') ? false : $_POST["customRadioSexo"] ;
            $correo = (Validacion::validarEmail($_POST["inpuCorreo"]) == '0') ? false : $_POST["inpuCorreo"] ;
            $select = (Validacion::validarSelect($_POST["tipoUser"]) == '-1') ? false : $_POST["tipoUser"] ;
            $doctores = array('Nombre' => $Nombre ,'Apellido_Pat' => $Apellido_Pat ,'Apellido_Mat' => $Apellido_Mat ,'sexo' => $sexo ,'correo' => $correo,'Tipo Usuario'=>$select);

            foreach($doctores as $datos=>$index){
                if($index == false){
                    $_SESSION['formulario_doctor'] = array(
                        "error"=> 'El campo '.$datos." es Incorrecto, Llena los campos faltantes",
                        "datos"=>$doctores
                    );
                break;
                }
            }

            if(isset($_SESSION["formulario_doctor"])){
                echo '<script>window.location="'.base_url.'Doctor/index"</script>';
            }else{
                $alta =new Doctor();
                $alta->setNombre($Nombre);
                $alta->setApellidoP($Apellido_Pat);
                $alta->setApellidoM($Apellido_Mat);
                $alta->setSexo($sexo);
                $alta->setCorreo($correo);
                $alta->setTipoUser($select);
                $insert = $alta->insertDoctor();

                if($insert){
                    $_SESSION['statusSave'] = "SE HA REGISTRADO EXITOSAMENTE";
                    echo '<script>window.location="'.base_url.'Doctor/index"</script>';
                }else{
                    $_SESSION['formulario_doctor'] = array(
                        "error"=> "NO SE INSERTO CORRECTAMENTE, INTENTE DE NUEVO O LLAME A SU ADMINISTRADOR",
                        "datos"=>$doctores
                    ); 
                }
            }
        } 
    }
}