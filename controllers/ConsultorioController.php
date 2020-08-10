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
                $guardar->setNombre($nombre);
                $guardar->setMunicipio($municipio);
                $guardar->setCp($cp);
                $guardar->setColonia($colonia);
                $guardar->setCalle($calle);
                $guardar->setNumero($numero);
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

    public function nuevo(){
        $sesionConsultorio = 1;
        $nuevo = new Consultorio();
        $listar = $nuevo->getAllStatus($sesionConsultorio,1);
       require_once 'views/consultorio/nuevo.php'; 

    }

    public function control(){
        $sesionConsultorio = 1;
        $medicina = new Consultorio();
        $medicina->setIdConsultorio($sesionConsultorio);
        $resultado = $medicina->getMedicinaModels();
        require_once 'views/consultorio/control.php';
    }

    public function actualizar(){
        $get = $_GET;
        $dato="";
        $sesionConsultorio = 1;
        $numeroSuma = (int)SED::decryption($get['s']);
        $updateCampo = SED::decryption($get['tr']);
        
        if($updateCampo === 'meso'){
            $dato = 'meso_Consultorio';
        }else if($updateCampo === 'con'){
            $dato = 'consentrado_Consultorio';
        }
        
        $updateControl = new Consultorio();
        $updateControl->setIdConsultorio($sesionConsultorio);
        $updateControl->setMesoCons($numeroSuma);
        $update = $updateControl->updaControl($dato);
         if($update){
             echo '<script>window.location="'.base_url.'Consultorio/control"</script>';
         }else{
             echo "nopo";
         }



        
    }
}

