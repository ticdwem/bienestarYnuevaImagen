<?php
require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/models/consultorioModels.php";
/* require_once $_SERVER['DOCUMENT_ROOT']."/models/consultorioModels.php"; */
class ConsultorioController {
    public function __construct()
    {
        /* validamos si extiste a sesison */
        if(!isset($_SESSION['usuario'])){Utls::sinSession();}
    }
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
        $nuevo = new Consultorio();
        $listar = $nuevo->getAllStatus(Consultorio,1);
    require_once 'views/consultorio/nuevo.php'; 

    }

    public function control(){
        $medicina = new Consultorio();
        $medicina->setIdConsultorio(Consultorio);
        $resultado = $medicina->getMedicinaModels();
        require_once 'views/consultorio/control.php';
    }

    public function actualizar(){
        $get = $_GET;
        $dato="";
        $numeroSuma = (int)SED::decryption($get['s']);
        $updateCampo = SED::decryption($get['tr']);
        
        if($updateCampo === 'meso'){
            $dato = 'meso_Consultorio';
        }else if($updateCampo === 'con'){
            $dato = 'consentrado_Consultorio';
        }
        
        $updateControl = new Consultorio();
        $updateControl->setIdConsultorio(Consultorio);
        $updateControl->setMesoCons($numeroSuma);
        $update = $updateControl->updaControl($dato);
        if($update){
            echo '<script>window.location="'.base_url.'Consultorio/control"</script>';
        }else{
            echo "nopo";
        }        
    }

    public function corteDiario(){
        $fecha = date("Ymd");
        $consultorio = (isset($_GET["idCorte"])) ? $_GET["idCorte"] : Consultorio ;

        $regisro = new Consultorio();
        $regisro->setIdConsultorio($consultorio);
        $regisro->setFechaConsulta($fecha);
        $historia = $regisro->getRegistroDatos();
            $paciente = (is_object($historia)) ? $historia->totalPaciente : 0 ;
            $efectivo = (is_object($historia)) ? $historia->sumaEfectivo : 0 ;
            $tarjeta = (is_object($historia)) ? $historia->sumaTarjeta : 0 ;
            $meso = (is_object($historia)) ? $historia->meso : 0 ;
            $con = (is_object($historia)) ? $historia->concentrado : 0 ;


        $completo = new Consultorio();
        $completo->setIdConsultorio($consultorio);
        $completo->setFechaConsulta($fecha);
        $datosCompletos = $completo->getDatosConsulta();
        require_once 'views/consultorio/datosXconsultorio.php';
    }

    public function gastos(){
        $fecha = date("Ymd");
        $consultorio = (isset($_GET["idGastos"])) ? $_GET["idGastos"] : Consultorio ;

        $regisro = new Consultorio();
        $regisro->setIdConsultorio($consultorio);
        $regisro->setFechaConsulta($fecha);
        $dineroQueda = $regisro->getMoneyTotal();
            $totalDinero = (is_object($dineroQueda) && !is_null($dineroQueda->suma)) ? $dineroQueda->suma : 0 ;
            $totalGasto = (is_object($dineroQueda) && !is_null($dineroQueda->gastos)) ? $dineroQueda->gastos : 0 ;
            $totalQuedaDinero = (is_object($dineroQueda) && !is_null($dineroQueda->restaGastos)) ? $dineroQueda->restaGastos : 0 ;

        $listaGsto = new Consultorio();
        $listaGsto->setIdConsultorio($consultorio);
        $lista = $listaGsto->getListaPagos();
        require_once 'views/consultorio/gastosCosnutorio.php';
    }

    public function registrarGasto(){
        require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/models/consultaModels.php";
        $hoy = date_create();
        $fecha_Actual = date_format($hoy,"Y-m-d H:i:s");
        
        // $fecha_Entrada = strtotime("25-10-2020 21:00:00");
        // echo '================================================================================<br>';
        // echo date("F j, Y, g:i a");                 // March 10, 2001, 5:16 pm
        // // if($fecha_Actual>$fecha_Entrada){
        // //     echo "<br>la fecha actual es mayor a la entrada";
        // // }else{
        // //     echo "<br>la fecha esntada es igual o nmayor";
        // // }
        Utls::deleteSession('gastoRegistro');
        if(isset($_POST['gasto'])){
            $valGasto = (int)$_POST["gasto"];
            $valQueda = (int)$_POST["queda"];
            $gasto = (Validacion::validarNumero($valGasto)) ? $valGasto : -1 ;
            $queda = (Validacion::validarNumero($valQueda)) ? $valQueda : -1 ;
            $motivo = (Validacion::pregmatchletras($_POST["motivo"])) ? $_POST["motivo"] : -1 ;
            $regGastos = array('Cantidad' => $gasto,'totalQueda' =>$queda,'motivo' => $motivo);

            foreach ($regGastos as $titulo => $valor) {
                if($valor == '-1'){
                    $_SESSION['gastoRegistro'] = array(
                        "error" => "El campo ".$titulo." esta vacio o es incorrecto, Verifica de nuevo",
                        "datos" => array('Cantidad' =>$valGasto,'motivo' =>$_POST["motivo"])
                    );
                break;
                }
            }
            if(isset($_SESSION["gastoRegistro"])){
                echo '<script>window.location="'.base_url.'Consultorio/gastos"</script>';
            }else{
                /* varificamos que el gasto es menos a lo que queda en caja */
                if($valGasto > $valQueda){
                    $_SESSION['gastoRegistro'] = array(
                        "error" => "NO HAY SUFICIENTE DINERO EN LA CAJA PARA PROCESAR ESTE GASTO",
                        "datos" => array('Cantidad' =>$valGasto,'motivo' =>$_POST["motivo"])
                    );
                    echo '<script>window.location="'.base_url.'Consultorio/gastos"</script>';
                }else{
                $gastoInsert = new Consulta();
                $gastoInsert -> setId($_SESSION["usuario"]['id']);
                $gastoInsert -> setConsultorio(Consultorio);
                $gastoInsert -> setValorPago($gasto);
                $gastoInsert -> setMotivo($motivo);
                $gastoInsert -> setFechaConsulta($fecha_Actual);
                $verif = $gastoInsert -> insertGasto();
                if($verif){
                    $_SESSION["success"] = "SE HA REGISTRADO CON EXITO ";
                    echo '<script>window.location="'.base_url.'Consultorio/gastos"</script>';
                }else{
                        $_SESSION['gastoRegistro'] = array(
                            "error" => "HUBO UN ERROR AL INTENTAR REGISTRAR, INTENTE MAS TARDE",
                            "datos" => array('Cantidad' =>$valGasto,'motivo' =>$_POST["motivo"])
                        );
                        echo '<script>window.location="'.base_url.'Consultorio/gastos"</script>';
                }
                }
            }

        }       
    }

}

