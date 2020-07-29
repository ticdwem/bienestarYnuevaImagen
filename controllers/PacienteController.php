<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/cbyni/models/pacienteModels.php';

class PacienteController{
    /*este es una clase de prueba para saber que todo esta bien relacionado */
    public function index(){
    	 $estado = new Usuario();
    	 $nombreE = $estado->getAll('estados'); 

       require_once 'views/paciente/registro.php';
        
    }

    public function save(){
        $medicamento = "";
        if(isset($_POST)){            
		    Utls::deleteSession('formulario');
            $idPaciente = (Validacion::validarNumero($_POST["idPaciente"]) == '-1') ? false : $_POST["idPaciente"] ;
            $Nombre = (Validacion::pregmatchletras($_POST["intputname"]) == '0') ? false : $_POST["intputname"] ;
            $Apellido_Pat = (Validacion::pregmatchletras($_POST["inputAppat"]) == '0') ? false : $_POST["inputAppat"] ;
            $Apellido_Mat = (Validacion::pregmatchletras($_POST["inputApmat"]) == '0') ? false : $_POST["inputApmat"] ;
            $sexo = (!isset($_POST["customRadioSexo"]) || Validacion::pregmatchletras($_POST["inputApmat"]) == '0') ? false : $_POST["customRadioSexo"] ;
            $fecha = (Validacion::valFecha($_POST["dateInicio"]) == '0') ? false : Validacion::valFecha($_POST["dateInicio"]) ;
            $edad = (Validacion::validarNumero($_POST["inpuEdad"]) == '-1') ? false : $_POST["inpuEdad"] ;
            $estatura = (Validacion::validarNumero($_POST["inpuEstatura"]) == '-1') ? false : $_POST["inpuEstatura"] ;
            $ocupacion = (Validacion::pregmatchletras($_POST["inpuOcupacion"]) == '0') ? false : $_POST["inpuOcupacion"] ;
            $estado_civil = (Validacion::pregmatchletras($_POST["inpuEstadoCivil"]) == '0') ? false : $_POST["inpuEstadoCivil"] ;
            $celular = (Validacion::validarTelefono($_POST["inpuCelular"]) == '0') ? false : $_POST["inpuCelular"] ;
            $correo = (Validacion::validarEmail($_POST["inpuCorreo"]) == '0') ? false : $_POST["inpuCorreo"] ;
            $red_social = (Validacion::pregmatchletras($_POST["inpuRedSocial"]) == '0') ? false : $_POST["inpuRedSocial"] ;
            $estado = (Validacion::validarSelect($_POST["inpuEstado"]) == '-1') ? false : $_POST["inpuEstado"] ;
            $municipio = (!isset($_POST["inpuMunicipio"]) || Validacion::validarSelect($_POST["inpuMunicipio"]) == '-1') ? false : $_POST["inpuMunicipio"] ;
            $codigo_postal = (Validacion::validarNumero($_POST["inpuCP"]) == '-1' || Validacion::validarLArgo($_POST["inpuCP"],5) == '-1' ) ? false : $_POST["inpuCP"] ;
            $colonia = (Validacion::pregmatchletras($_POST["inpuColonia"]) == '0' ) ? false : $_POST["inpuColonia"] ;
            $calle = (Validacion::pregmatchletras($_POST["inpuCalle"]) == '0' ) ? false : $_POST["inpuCalle"] ;
            $numero_casa = (Validacion::validarNumero($_POST["inpuNumCasa"]) == '-1' ) ? false : $_POST["inpuNumCasa"] ;
            $tetefono_emergencia = (Validacion::validarTelefono($_POST["inpuTelEmergencia"]) == '0' ) ? false : $_POST["inpuTelEmergencia"] ;
            $parentesco = (Validacion::pregmatchletras($_POST["inpuParentesco"]) == '0' ) ? false : $_POST["inpuParentesco"] ;
            $nombre_Recomienda = (Validacion::pregmatchletras($_POST["inpuNombreRecomienda"]) == '0' ) ? false : $_POST["inpuNombreRecomienda"] ;
            $motivo = (Validacion::pregmatchletras($_POST["inpuMotivo"]) == '0' ) ? false : $_POST["inpuMotivo"] ;
            $select = (Validacion::validarSelect($_POST["select"]) == '0' ) ? false : $_POST["select"] ;
            
            if($select == 2){$medicamento = 'no';}else{$medicamento = (Validacion::validarSelect($_POST["inputNombreMedicamento"]) == '0' ) ? false : $_POST["inputNombreMedicamento"] ;}
            
            $datos = array('idPaciente' =>$idPaciente ,'Nombre' =>$Nombre ,'Apellido_Pat' =>$Apellido_Pat ,'Apellido_Mat' =>$Apellido_Mat ,'sexo' =>$sexo ,'fecha' =>$fecha ,'edad' =>$edad ,'estatura' =>$estatura ,'ocupacion' =>$ocupacion ,'estado_civil' =>$estado_civil ,'celular' =>$celular ,'correo' =>$correo ,'red_social' =>$red_social ,'estado' =>$estado ,'municipio' =>$municipio ,'codigo_postal' =>$codigo_postal ,'colonia' =>$colonia ,'calle' =>$calle ,'numero_casa' =>$numero_casa ,'tetefono_emergencia' =>$tetefono_emergencia ,'parentesco' =>$parentesco ,'nombre_Recomienda' =>$nombre_Recomienda ,'motivo' =>$motivo ,'select' =>$select ,'medicamento' =>$medicamento);
            foreach ($datos as $dato => $valor) {
               if($valor == false){
                $_SESSION['formulario'] = array(
                    "error"=> 'El campo '.$dato." es Incorrecto, Llena los campos faltantes",
                    "datos"=>$datos
                );
            break;
               }
            }
            
            if(!isset($_SESSION['formulario'])){
                $paciente = new Usuario();
                $paciente->setIdPaciente($idPaciente);
                $paciente->setIntputname($Nombre);
                $paciente->setInputAppat($Apellido_Pat);
                $paciente->setInputApmat($Apellido_Mat);
                $paciente->setCustomRadioSexo($sexo);
                $paciente->setDateInicio($fecha);
                $paciente->setInpuEdad($edad);
                $paciente->setInpuEstatura($estatura);
                $paciente->setInpuOcupacion($ocupacion);
                $paciente->setInpuEstadoCivil($estado_civil);
                $paciente->setInpuCelular($celular);
                $paciente->setEmail($correo);
                $paciente->setInpuRedSocial($red_social);
                //$paciente->setIdEstado($estado);
                $paciente->setInpuMunicipio($municipio);
                $paciente->setInpuCP($codigo_postal);
                $paciente->setInpuColonia($colonia);
                $paciente->setInpuCalle($calle);
                $paciente->setInpuNumCasa($numero_casa);
                $paciente->setInpuTelEmergencia($tetefono_emergencia);
                $paciente->setInpuParentesco($parentesco);
                $paciente->setInpuNombreRecomienda($nombre_Recomienda);
                $paciente->setInpuMotivo($motivo);
                $paciente->setInputNombreMedicamento($medicamento);
                $insertar = $paciente->insertPaciente();
                if($insertar){
                    echo 'ok';
                    $datos = array();
                    if(isset($_POST["deabetes"]) && $_POST["deabetes"][0] != '0'){
                        $nombreDeabetes = (Validacion::pregmatchletras($_POST["deabetes"][0]) == '0') ? false : true;
                        $indiqueDeabetes = (Validacion::validarNumero($_POST["deabetes"][1]) == '-1') ? false :  true;
                        $parentescoDeabetes = (Validacion::pregmatchletras($_POST["deabetes"][2]) == '0') ? false : true ;
                        if($nombreDeabetes && $indiqueDeabetes  && $parentescoDeabetes ){
                            array_push($datos,$_POST["deabetes"]);
                        }else{
                            echo "hay un datos erroenao<br>";
                        }
                    }
                    if(isset($_POST["hipertension"]) && $_POST["hipertension"][0] != '0'){
                        $nombreHipertension = (Validacion::pregmatchletras($_POST["hipertension"][0]) == '0') ? false : true ;
                        $indiqueHipertension = (Validacion::validarNumero($_POST["hipertension"][1]) == '-1') ? false : true ;
                        $parentescoHipertension = (Validacion::pregmatchletras($_POST["hipertension"][2]) == '0') ? false : true ;
                        
                        if($nombreHipertension && $indiqueHipertension && $parentescoHipertension){
                            array_push($datos,$_POST["hipertension"]);
                        }else{
                            echo "hay un datos erroenao<br>";
                        }
                    }
                    if(isset($_POST["cancer"]) && $_POST["cancer"][0] != '0'){
                        $nombreCancer = (Validacion::pregmatchletras($_POST["cancer"][0]) == '0') ? false :true ;
                        $indiqueCancer = (Validacion::validarNumero($_POST["cancer"][1]) == '-1') ? false : true ;
                        $parentescoCancer = (Validacion::pregmatchletras($_POST["cancer"][2]) == '0') ? false :true ;
                        if($nombreCancer && $indiqueCancer && $parentescoCancer ){
                            array_push($datos,$_POST["cancer"]);
                        }else{
                            echo "hay un datos erroenao<br>";
                        }
                    }
                    if(isset($_POST["otros"]) && !empty($_POST["otros"][0])){
                        $nombreOtros = (Validacion::pregmatchletras($_POST["otros"][0]) == '0') ? false : true ;
                        $indiqueOtros = (Validacion::pregmatchletras($_POST["otros"][1]) == '0') ? false : true ;
                        $parentescOtros = (Validacion::pregmatchletras($_POST["otros"][2]) == '0') ? false : true ;
                        if($nombreOtros  && $indiqueOtros && $parentescOtros ){
                            array_push($datos,$_POST["otros"]);
                        }else{
                            echo "hay un datos erroenao<br>";
                        }
                    }
                    if(isset($_POST["ninguno"]) && $_POST["ninguno"][0] != '0'){
                        $nombreNinguno = (Validacion::pregmatchletras($_POST["ninguno"][0]) == '0') ? false : true ;
                        $indiqueNinguno = (Validacion::validarNumero($_POST["ninguno"][1]) == '-1') ? false : true ;
                        $parentescNinguno = (Validacion::validarNumero($_POST["ninguno"][2]) == '-1') ? false : true ;
                        if($nombreNinguno  && $indiqueNinguno && $parentescNinguno ){
                            array_push($datos,$_POST["ninguno"]);
                        }else{
                            echo "hay un datos erroenao<br>";
                        }
                    }
                    $enfermedad = new Usuario();
                    $enfermedad->setTabla('enfermedadfamiliar');
                    $enfermedad->setIdPaciente($_POST["idPaciente"]);
                    $enfermedad->setSelect($datos);
                    $insertEnf = $enfermedad->insertEnfermedad();
                    if($insertEnf){
                        echo 'ok';
                        $datos = array();
                        if(isset($_POST["actualDeabetes"]) && $_POST["actualDeabetes"][0] != '0'){
                            $nombreActualDeabetes = (Validacion::pregmatchletras($_POST["actualDeabetes"][0]) == '0') ? false : true;
                            $indiqueActualDeabetes = (Validacion::validarNumero($_POST["actualDeabetes"][1]) == '-1') ? false :  true;
                            $parentescoActualDeabetes = (Validacion::pregmatchletras($_POST["actualDeabetes"][2]) == '0') ? false : true ;
                            if($nombreActualDeabetes && $indiqueActualDeabetes  && $parentescoActualDeabetes ){
                                array_push($datos,$_POST["actualDeabetes"]);
                            }else{
                                echo "hay un datos erroenao<br>";
                            }
                        }
                        if(isset($_POST["actualHipertension"]) && $_POST["actualHipertension"][0] != '0'){
                            $nombreActualHipertension = (Validacion::pregmatchletras($_POST["actualHipertension"][0]) == '0') ? false : true ;
                            $indiqueActualHipertension = (Validacion::validarNumero($_POST["actualHipertension"][1]) == '-1') ? false : true ;
                            $parentescoActualHipertension = (Validacion::pregmatchletras($_POST["actualHipertension"][2]) == '0') ? false : true ;
                            
                            if($nombreActualHipertension && $indiqueActualHipertension && $parentescoActualHipertension){
                                array_push($datos,$_POST["actualHipertension"]);
                            }else{
                                echo "hay un datos erroenao<br>";
                            }
                        }
                        if(isset($_POST["actualCancer"]) && $_POST["actualCancer"][0] != '0'){
                            $nombreActualCancer = (Validacion::pregmatchletras($_POST["actualCancer"][0]) == '0') ? false :true ;
                            $indiqueActualCancer = (Validacion::validarNumero($_POST["actualCancer"][1]) == '-1') ? false : true ;
                            $parentescoActualCancer = (Validacion::pregmatchletras($_POST["actualCancer"][2]) == '0') ? false :true ;
                            if($nombreActualCancer && $indiqueActualCancer && $parentescoActualCancer ){
                                array_push($datos,$_POST["actualCancer"]);
                            }else{
                                echo "hay un datos erroenao<br>";
                            }
                        }
                        if(isset($_POST["actualOtro"]) && !empty($_POST["actualOtro"][0])){
                            $nombreActualOtros = (Validacion::pregmatchletras($_POST["actualOtro"][0]) == '0') ? false : true ;
                            $indiqueActualOtros = (Validacion::pregmatchletras($_POST["actualOtro"][1]) == '0') ? false : true ;
                            $parentescActualOtros = (Validacion::pregmatchletras($_POST["actualOtro"][2]) == '0') ? false : true ;
                            if($nombreActualOtros  && $indiqueActualOtros && $parentescActualOtros ){
                                array_push($datos,$_POST["actualOtro"]);
                            }else{
                                echo "hay un datos erroenao<br>";
                            }
                        }
                        if(isset($_POST["actualNinguno"]) && $_POST["actualNinguno"][0] != '0'){
                            $nombreActualNinguno = (Validacion::pregmatchletras($_POST["actualNinguno"][0]) == '0') ? false : true ;
                            $indiqueActualNinguno = (Validacion::validarNumero($_POST["actualNinguno"][1]) == '-1') ? false : true ;
                            $parentescActualNinguno = (Validacion::validarNumero($_POST["actualNinguno"][2]) == '-1') ? false : true ;
                            if($nombreActualNinguno  && $indiqueActualNinguno && $parentescActualNinguno ){
                                array_push($datos,$_POST["actualNinguno"]);
                            }else{
                                echo "hay un datos erroenao<br>";
                            }
                        }
                        $actual = new Usuario();
                        $actual->setTabla('antecedentespatologicos');
                        $actual->setIdPaciente($_POST["idPaciente"]);
                        $actual->setSelect($datos);
                        $insertActual = $actual->insertEnfermedad();
                        if($insertActual){
                            echo 'ok';
                        }else{
                            echo 'nop';
                        }
                    }else{
                        echo 'nop';
                    }
                }else{
                    $_SESSION['formulario'] = array(
                        "error"=> 'Lo sentimos hubo un error en la insercción, reporta este error',
                        "datos"=>$datos
                    );
                }
            }else{
                echo '<script>window.location="'.base_url.'"</script>';
            }
            die();
        }else{
            echo 'no existe';
            die();
        }
    }

    public function saveArray(){
        $datos = array();
        if(isset($_POST["deabetes"]) && $_POST["deabetes"][0] != '0'){
            $nombreDeabetes = (Validacion::pregmatchletras($_POST["deabetes"][0]) == '0') ? false : true;
            $indiqueDeabetes = (Validacion::validarNumero($_POST["deabetes"][1]) == '-1') ? false :  true;
            $parentescoDeabetes = (Validacion::pregmatchletras($_POST["deabetes"][2]) == '0') ? false : true ;
            if($nombreDeabetes && $indiqueDeabetes  && $parentescoDeabetes ){
                array_push($datos,$_POST["deabetes"]);
            }else{
                echo "hay un datos erroenao<br>";
            }
        }
        if(isset($_POST["hipertension"]) && $_POST["hipertension"][0] != '0'){
            $nombreHipertension = (Validacion::pregmatchletras($_POST["hipertension"][0]) == '0') ? false : true ;
            $indiqueHipertension = (Validacion::validarNumero($_POST["hipertension"][1]) == '-1') ? false : true ;
            $parentescoHipertension = (Validacion::pregmatchletras($_POST["hipertension"][2]) == '0') ? false : true ;
            
            if($nombreHipertension && $indiqueHipertension && $parentescoHipertension){
                array_push($datos,$_POST["hipertension"]);
            }else{
                echo "hay un datos erroenao<br>";
            }
        }
        if(isset($_POST["cancer"]) && $_POST["cancer"][0] != '0'){
            $nombreCancer = (Validacion::pregmatchletras($_POST["cancer"][0]) == '0') ? false :true ;
            $indiqueCancer = (Validacion::validarNumero($_POST["cancer"][1]) == '-1') ? false : true ;
            $parentescoCancer = (Validacion::pregmatchletras($_POST["cancer"][2]) == '0') ? false :true ;
            if($nombreCancer && $indiqueCancer && $parentescoCancer ){
                array_push($datos,$_POST["cancer"]);
            }else{
                echo "hay un datos erroenao<br>";
            }
        }
        if(isset($_POST["otros"]) && !empty($_POST["otros"][0])){
            $nombreOtros = (Validacion::pregmatchletras($_POST["otros"][0]) == '0') ? false : true ;
            $indiqueOtros = (Validacion::pregmatchletras($_POST["otros"][1]) == '0') ? false : true ;
            $parentescOtros = (Validacion::pregmatchletras($_POST["otros"][2]) == '0') ? false : true ;
            if($nombreOtros  && $indiqueOtros && $parentescOtros ){
                array_push($datos,$_POST["otros"]);
            }else{
                echo "hay un datos erroenao<br>";
            }
        }
        if(isset($_POST["ninguno"]) && $_POST["ninguno"][0] != '0'){
            $nombreNinguno = (Validacion::pregmatchletras($_POST["ninguno"][0]) == '0') ? false : true ;
            $indiqueNinguno = (Validacion::validarNumero($_POST["ninguno"][1]) == '-1') ? false : true ;
            $parentescNinguno = (Validacion::validarNumero($_POST["ninguno"][2]) == '-1') ? false : true ;
            if($nombreNinguno  && $indiqueNinguno && $parentescNinguno ){
                array_push($datos,$_POST["ninguno"]);
            }else{
                echo "hay un datos erroenao<br>";
            }
        }
        $enfermedad = new Usuario();
        $enfermedad->setTabla('enfermedadfamiliar');
        $enfermedad->setIdPaciente($_POST["idPaciente"]);
        $enfermedad->setSelect($datos);
        $insertEnf = $enfermedad->insertEnfermedad();
        if($insertEnf){
            echo 'ok';
        }else{
            echo 'nop';
        }
    }

    public function getMunicipio($id){
        $idMun = Validacion::validarNumero($id);

        if($idMun != -1){           
            $estado = new Usuario();
            $estado->setIdEstado($idMun);
            $verMun = $estado->getMunModels();
            if($verMun->num_rows>0){
                $whileJson = array();
                while ($muni = $verMun->fetch_object()){
                    $data = array(
                    'id'=>$muni->id,
                    'name'=>$muni->municipio  
                );
                    array_push($whileJson,$data);                       
                }
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($whileJson, JSON_FORCE_OBJECT);
                exit();

            }

        }
    }

    public function getCorreoExistent($email){
        $correo = Validacion::validarEmail($email);

        if($correo != '0'){
            $mail = new Usuario();
            $mail->setEmail($correo);
            $resultado = $mail->getEmailExis();
            if($resultado->num_rows>0){
                echo 1;
            }else{
                echo 0;
            }

        }else{
            echo 2;
        }
    }

}