<?php

require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/models/consultaModels.php";
/* require_once $_SERVER['DOCUMENT_ROOT']."/models/consultorioModels.php"; */
class ConsultaController {
    public function __construct()
    {
        /* validamos si extiste a sesison */
        if(!isset($_SESSION['usuario'])){Utls::sinSession();}
    }
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
                    echo '<script>window.location="'.base_url.'Consulta/consultaDiaria&id='.$idPaciente.'"</script>';
                die(); 
                }else{
                    $error = new ErrorController();
                    $error->update();
                }
            }
        }
    }

    public function lista(){
        $pacientes = new Consulta();
        $listar = $pacientes->getAllStatus(Consultorio,2);
        require_once 'views/consultorio/listaPacientes.php';
    }

    public function consultaDiaria(){
        require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/models/consultorioModels.php";
        $concentrado = new Consultorio();
        $concentrado->setIdConsultorio($_SESSION["usuario"]['datos']->id_consultorio);
        $con = $concentrado->getDatosConsultorio();

        $paciente = new Consulta();
        $data = $paciente->getAllWhere('cliente','WHERE idCliente = '.$_GET['id']);
        $datos = $data->fetch_object();

        $consultas = new Consulta();
        $consultas->setId($_GET['id']);
        $historia = $consultas->getHistorialPaciente();
    require 'views/consultorio/consulta.php';
    }

    public function saveConsulta(){
        if(isset($_POST["btnRegistro"])){
            Utls::deleteSession('frmConsulta');
            $consultorio =(Validacion::validarNumero($_POST["Con"]) == '-1') ? false : $_POST["Con"] ;
            $doctor =(Validacion::validarNumero($_POST["Doc"]) == '-1') ? false : $_POST["Doc"] ;
            $fechaConsulta =(Validacion::valFecha($_POST["fechaConsulta"]) == '0') ? false : Validacion::valFecha($_POST["fechaConsulta"]);
            $tituloPeso =(Validacion::validarNumero($_POST["title"]) == '-1') ? false : $_POST["title"] ;
            $idPaciente = (Validacion::validarNumero($_POST["Pac"]) == '-1') ? false : $_POST["Pac"] ;
            $pesoActual = (Validacion::validarNumero($_POST["txtPeso"]) == '-1') ? false : $_POST["txtPeso"] ;
            $medida1 = (Validacion::validarNumero($_POST["medida1"]) == '-1') ? false : $_POST["medida1"] ;
            $medida2 = (Validacion::validarNumero($_POST["medida2"]) == '-1') ? false : $_POST["medida2"] ;
            $medida3 = (Validacion::validarNumero($_POST["medida3"]) == '-1') ? false : $_POST["medida3"] ;
            $medida4 = (Validacion::validarNumero($_POST["medida4"]) == '-1') ? false : $_POST["medida4"] ;
            $Aparatologia = (Validacion::textoPeque($_POST["aparato"]) == '1') ? false : $_POST["aparato"] ;
            $pesoPerGan = (Validacion::validarNumero($_POST["lostWeight"]) == '-1') ? false : $_POST["lostWeight"] ;
            $Medicina = (Validacion::textoPeque($_POST["medicina"]) == '1') ? false : $_POST["medicina"] ;
            $mesoterapia = (Validacion::validarNumero($_POST["mesoterapia"]) == '-1') ? false : $_POST["mesoterapia"] ;
            $concentrado = (Validacion::validarNumero($_POST["concentrado"]) == '-1') ? false : $_POST["concentrado"] ;
            $promocion = (Validacion::validarNumero($_POST["promocion"]) == '-1') ? false : $_POST["promocion"] ;
            $observaciones = (Validacion::textLong($_POST["observaciones"]) == '1') ? false : $_POST["observaciones"] ;
            $efectivo = (Validacion::validarNumero($_POST["efectivo"]) == '-1') ? false : $_POST["efectivo"] ;
            $tarjeta = (Validacion::validarNumero($_POST["tarjeta"]) == '-1') ? false : $_POST["tarjeta"] ;

            $consulta = array('consultorio' =>$consultorio ,'doctor' =>$doctor ,'fechaConsulta' =>$fechaConsulta ,'tituloPeso' =>$tituloPeso ,'idPaciente' =>$idPaciente ,'pesoActual' =>$pesoActual ,
                                'medida1' =>$medida1 ,'medida2' =>$medida2 ,'medida3' =>$medida3 ,'medida4' =>$medida4 ,'Aparatologia' =>$Aparatologia ,
                                'pesoPerGan' =>$pesoPerGan ,'Medicina' =>$Medicina ,'mesoterapia' =>$mesoterapia ,'concentrado' =>$concentrado ,'promocion' =>$promocion ,
                                'observaciones' =>$observaciones ,'efectivo' =>$efectivo ,'tarjeta' =>$tarjeta );
            foreach ($consulta as $dato => $valor) {
                if($valor === false){
                    $_SESSION['frmConsulta'] = array(
                        "error"=> 'El campo '.$dato." es Incorrecto, Llena los campos faltantes",
                        "datos"=>$consulta
                    );
                    echo '<script>window.location="'.base_url.'Consulta/consultaDiaria&id='.$idPaciente.'"</script>';
                break;
                }
            }
            if(!isset($_SESSION['frmConsulta'])){
                $sesionConsulta = new Consulta();
                $sesionConsulta->setId($idPaciente);
                $sesionConsulta->setDoctor($doctor);
                $sesionConsulta->setConsultorio($consultorio);
                $sesionConsulta->setFechaConsulta($fechaConsulta);
                $sesionConsulta->setPesoActual($pesoActual);
                $sesionConsulta->setMedida1($medida1);
                $sesionConsulta->setMedida2($medida2);
                $sesionConsulta->setMedida3($medida3);
                $sesionConsulta->setMedida4($medida4);
                $sesionConsulta->setAparato($Aparatologia);
                $sesionConsulta->setPesoPerdido($pesoPerGan);
                $sesionConsulta->setTituloPeso($tituloPeso);
                $sesionConsulta->setMedicina($Medicina);
                $sesionConsulta->setMesoterapia($mesoterapia);
                $sesionConsulta->setConcentrado($concentrado);
                $sesionConsulta->setPromocion($promocion);
                $sesionConsulta->setObser($observaciones);
                $sesionConsulta->setEfectivo($efectivo);
                $sesionConsulta->setTarjeta($tarjeta);
            $registro =  $sesionConsulta->insertConsulta();
                if($registro){
                    echo '<script> 
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "SE INSERTO EXITOSAMENTE",
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        window.location="'.base_url.'Consulta/lista"
                    })
                    </script>';
                    
                }else{
                    echo '<script> 
                    Swal.fire({
                        title: "ERROR",
                        text: "HUBO UN ERROR AL INSERTAR, INTENTE DE NUEVO O LLAME A SU ADMINISTRADOR",
                        icon: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "REGRESAR"
                    }).then((result) => {
                        if (result.isConfirmed) {                            
                            window.location="'.base_url.'Consulta/lista"
                        }
                    })
                    </script>';
                }
            }
        }
    }
}

