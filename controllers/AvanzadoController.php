<?php

    require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/models/avanzadoModels.php";
    class AvanzadoController{
        public function __construct()
        {
            /* validamos si extiste a sesison */
            if(!isset($_SESSION['usuario'])){Utls::sinSession();}
        }
        public function index(){
            require_once 'views/avanzado/viewgeneral.php';
        }

        public function pacientes(){
            /* lista completa de los pacientes  */
            $custom = new ModeloBase();
            $datos = $custom->getAll("allCustomers");
            require_once 'views/avanzado/pacientes/listaPacientes.php';
        }

        public function historial(){
            /* traigo el historial de paciente especificado */
            require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/models/consultaModels.php";
            $paciente = new Consulta();
            $data = $paciente->getAllWhere('cliente','WHERE idCliente = '.$_GET['id']);
            $datos = $data->fetch_object();

            $consultas = new Consulta();
            $consultas->setId($_GET['id']);
            $historia = $consultas->getHistorialPaciente();
            require_once 'views/avanzado/pacientes/pacienteConsultas.php';
        }

        public function Consultorios(){
            /* lista de todos los consultorios */
            $consul = new AvanzadoModels();
            $listar = $consul->listaCon();
            require_once 'views/avanzado/consultorio/listaConsultorios.php';
        }

        public function movimientos(){
            /* traigo todos los ingresos y egresos de un consultorio especifico */
            require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/models/consultorioModels.php";
            $fecha = date("Ymd");
            $get = Validacion::validarNumero($_GET["idCtr"]);
            $regisro = new Consultorio();
            $regisro->setIdConsultorio($get);
            $regisro->setFechaConsulta($fecha);
            $historia = $regisro->getRegistroDatos();
                $paciente = (is_object($historia)) ? $historia->totalPaciente : 0 ;
                $efectivo = (is_object($historia)) ? $historia->sumaEfectivo : 0 ;
                $tarjeta = (is_object($historia)) ? $historia->sumaTarjeta : 0 ;
                $meso = (is_object($historia)) ? $historia->meso : 0 ;
                $con = (is_object($historia)) ? $historia->concentrado : 0 ;
            
            $regisro = new Consultorio();
            $regisro->setIdConsultorio($get);
            $regisro->setFechaConsulta($fecha);
            $dineroQueda = $regisro->getMoneyTotal();
                $totalDinero = (is_object($dineroQueda) && !is_null($dineroQueda->suma)) ? $dineroQueda->suma : 0 ;
                $totalGasto = (is_object($dineroQueda) && !is_null($dineroQueda->gastos)) ? $dineroQueda->gastos : 0 ;
                $totalQuedaDinero = (is_object($dineroQueda) && !is_null($dineroQueda->restaGastos)) ? $dineroQueda->restaGastos : 0 ;
        
            $name = new ModeloBase();
            $nameConsultorio = $name->getAllWhere('consultorio','WHERE consultorio.id_consultorio ='.$get);
            $nombre = $nameConsultorio->fetch_object();

            // if($historia>'0'){
                require_once 'views/avanzado/consultorio/movimientosXconsultorio.php';
            // }else{
                // require_once 'views/error/error404.php';
            // }
        }

        public function reporte(){
            $totalPacientes=0; $totalEfectivo=0;$totaltarjeta=0;$totalGasto=0;$total = 0;$totalQueda=0;$d1=0;$d2=0;$tittle="";
            if(isset($_GET["dOne"])){
                $one = (Validacion::valFecha($_GET["dOne"]) == -1) ? false : Validacion::valFecha(Utls::createDAte($_GET["dOne"]));
                $Two = (Validacion::valFecha($_GET["Dtwo"]) == -1) ? false : Validacion::valFecha( Utls::createDAte($_GET["Dtwo"]));


                $fechas = array('fecha1' => $one,'fecha2'=> $Two);
                foreach ($fechas as $datos => $valores) {
                    if($valores == false || $valores == '-300'|| $valores == '-200'|| $valores == '-100'){
                        $one="falso"; 
                    break;
                    }
                }
                if($one == "falso"){
                    echo '<script> 
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "FATAL!!! NO ENCINTRAMOS COINCIDENCIAS",
                            showConfirmButton: false,
                            timer: 2500
                        }).then((result) => {
                            window.location="'.base_url.'Avanzado/reporte"
                        })
                    </script>';
                }else{
                    $tittle = "<small>".Utls::nameMonth(date('n',strtotime($_GET["dOne"])))." ".date('Y',strtotime($_GET["dOne"]))."</small> Al Mes De <small>".Utls::nameMonth(date('n',strtotime($_GET["Dtwo"])))." ".date('Y',strtotime($_GET["Dtwo"]));
                    $d1 = $one;
                    $d2 = $Two;
                }
                
            }else{
                $hoy = date('d-m-Y');
                $fecha = Validacion::valFecha($hoy);
                $fechaFormat = new DateTime($fecha);
                $fechaHoy =  $fechaFormat->format('Ymd');
                $d1 = $fechaHoy;
                $d2 = $fechaHoy;
                $tittle = "<small>".Utls::nameMonth(date('n',strtotime($fechaHoy)))."</small> del Año <small>".date('Y',strtotime($fechaHoy));
                    
            }

            $consut = new AvanzadoModels();
            $consut->setDate1($d1);
            $consut->setDate2($d2);
            $tabla = $consut->reportGl();
            require_once 'views/avanzado/consultorio/registroXConsultorio.php';
        } 
    }
