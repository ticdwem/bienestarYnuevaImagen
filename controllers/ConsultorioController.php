<?php
require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/models/consultorioModels.php";
class ConsultorioController {
    /*este es una clase de prueba para saber que todo esta bien relacionado */
    public function index(){
        $estado = new Consultorio();
        $nombreE = $estado->getAll('estados'); 

        require_once 'views/consultorio/registro.php';
    }

    public function save(){
        if(isset($_POST['saveConsultorio'])){
            $estado = (Validacion::validarSelect($_POST["inpuEstadoConsultorio"]) == '-1') ? false : $_POST["inpuEstadoConsultorio"] ;
            $municipio = (Validacion::validarSelect($_POST["inpuMunicipioConsultorio"]) == '-1') ? false : $_POST["inpuMunicipioConsultorio"] ;
            $cp = (Validacion::validarNumero($_POST["inpuCPConsultorio"]) == '-1') ? false : $_POST["inpuCPConsultorio"] ;
            $colonia = (Validacion::validarSelect($_POST["inpuColoniaConsultorio"]) == '-1') ? false : $_POST["inpuColoniaConsultorio"] ;
            $calle = (Validacion::validarSelect($_POST["inpuCalleConsultorio"]) == '-1') ? false : $_POST["inpuCalleConsultorio"] ;
            $numero = (Validacion::validarSelect($_POST["inpuNumCasaConsultorio"]) == '-1') ? false : $_POST["inpuNumCasaConsultorio"] ;
            $nombre = (Validacion::validarSelect($_POST["intputnameConsultorio"]) == '-1') ? false : $_POST["intputnameConsultorio"] ;

            $datos = array('estado' =>$estado ,'municipio' =>$municipio , 'cp' =>$cp , 'colonia' =>$colonia , 'calle' =>$calle , 'numero' =>$numero , 'nombre' =>$nombre ,  );
            foreach($datos as $consultorio => $valor){
                if($valor == false){
                    $_SESSION["errorConsultorio"] = array(
                                                    'error' =>'El campo '.$consultorio.'Es incorrecto',
                                                    $datos);
                    break;
                }

            }

            if(!isset($_SESSION["errorConsultorio"])){
                $guardar = new Consultorio();
                $guardar->setNombre($municipio);
                $guardar->setMunicipio($cp);
                $guardar->setCp($colonia);
                $guardar->setColonia($calle);
                $guardar->setCalle($numero);
                $guardar->setNumero($nombre);
                $registro = $guardar->insertConsultorio();

                if($registro){
                    $_SESSION['statusSave'] = "SE HA REGISTRADO EXITOSAMENTE";
                    echo '<script>window.location="'.base_url.'Consultorio/index"</script>';
                }else{
                    $_SESSION["errorConsultorio"] = array(
                        'error' =>'hay datos erroneos',
                        $datos);
                }
            }
        }
    }
}

