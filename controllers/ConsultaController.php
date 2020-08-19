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
        if(isset($_POST['btnRegistro'])){
            Utls::deleteSession('ingreso');
            $idPaciente = (Validacion::validarNumero($_POST["idPaciente"]) == '-1') ? false : $_POST["idPaciente"] ;
            $cobro = (Validacion::validarNumero($_POST["txtCobro"]) == '-1') ? false : $_POST["txtCobro"] ;
            $estatura = (Validacion::validarNumero($_POST["txtEstatura"]) == '-1') ? false : $_POST["txtEstatura"] ;
            $obser = (Validacion::textLong($_POST["txtObs"]) == '-1') ? false : $_POST["txtObs"] ;

            $registro = array('id' => $idPaciente, 'cobro'=> $cobro, 'estatura' => $estatura, 'obs' => $obser);

            foreach ($registro as $dato => $valor) {
                if($valor == false){
                    $_SESSION['ingreso'] = array(
                        "error"=> 'El campo '.$dato." es Incorrecto, Llena los campos faltantes",
                        "datos"=>$registro
                    );
                break;
                }
            }

            if(isset($_SESSION['ingreso'])){                
                echo '<script>window.location="'.base_url.'"</script>';
                die();
            }else{
                $actualizar = new Consulta();
                $actualizar->setId($idPaciente);
                $actualizar->setCobro($cobro);
                $actualizar->setEstatura($estatura);
                $actualizar->setObser($obser);
                $update = $actualizar->updatePaciente();

                if($update){
                    echo '<script>window.location="'.base_url.'Consulta/diario"</script>';
                die(); 
                }else{
                    $error = new ErrorController();
                    $error->update();
                }
            }
        }
    }
}

