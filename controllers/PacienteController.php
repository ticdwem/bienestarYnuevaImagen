<?php
// require_once base_server.'/models/pacienteModels.php';
require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/models/pacienteModels.php";

class PacienteController{
    /*este es una clase de prueba para saber que todo esta bien relacionado */
    public function index(){
    	 $estado = new Usuario();
         $nombreE = $estado->getAll('estados'); 
         
         $idCleinte = new Usuario();
         $datos = $idCleinte->getIdCleinte('idCliente','cliente');
         $id = $datos->fetch_assoc();
       require_once 'views/paciente/registro.php';
       
    }
    
    public function save(){
        $insertDatos = true;
        $medicamento = "";
        if(isset($_POST)){            
            Utls::deleteSession('formulario');
            /* ::::::::::::::::::::::::::::::::::::::::seccion datos Personales::::::::::::::::::::::::::::::::::::::::: */          
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
            $tetefono_emergencia = (Validacion::validarTelefono($_POST["inpuTelEmergencia"]) == '0' ) ? false : $_POST["inpuTelEmergencia"] ;
            $parentesco = (Validacion::pregmatchletras($_POST["inpuParentesco"]) == '0' ) ? false : $_POST["inpuParentesco"] ;
            $nombre_Recomienda = (Validacion::pregmatchletras($_POST["inpuNombreRecomienda"]) == '0' ) ? false : $_POST["inpuNombreRecomienda"] ;
            $motivo = (Validacion::pregmatchletras($_POST["inpuMotivo"]) == '0' ) ? false : $_POST["inpuMotivo"] ;
            $select = (Validacion::validarSelect($_POST["select"]) == '0' ) ? false : $_POST["select"] ;
            
            if($select == 2){$medicamento = 'no';}else{$medicamento = (Validacion::validarSelect($_POST["inputNombreMedicamento"]) == '0' ) ? false : $_POST["inputNombreMedicamento"] ;}
            $datos = array('idPaciente' =>$idPaciente ,'Nombre' =>$Nombre ,'Apellido_Pat' =>$Apellido_Pat ,'Apellido_Mat' =>$Apellido_Mat ,'sexo' =>$sexo ,'fecha' =>$fecha ,
            'edad' =>$edad ,'estatura' =>$estatura ,'ocupacion' =>$ocupacion ,'estado_civil' =>$estado_civil ,'celular' =>$celular ,'correo' =>$correo ,
            'red_social' =>$red_social ,'estado' =>$estado ,'municipio' =>$municipio ,'codigo_postal' =>$codigo_postal ,'colonia' =>$colonia ,'calle' =>$calle ,
            'tetefono_emergencia' =>$tetefono_emergencia ,'parentesco' =>$parentesco ,'nombre_Recomienda' =>$nombre_Recomienda ,'motivo' =>$motivo ,'select' =>$select ,'medicamento' =>$medicamento);
            
            foreach ($datos as $dato => $valor) {
                if($valor == false){
                    $_SESSION['formulario'] = array(
                        "error"=> 'El campo '.$dato." es Incorrecto, Llena los campos faltantes",
                        "datos"=>$datos
                    );
                break;
            }
        }
        
        /* ::::::::::::::::::::::::::::::::::::::::seccion FAMILIARES QUE PADESCAN O HAYAN PADECIDO:::::::::::::::::::::::::::::::::::::::::: */          
        if(!isset($_SESSION['formulario'])){
                $familia = array();
                if(isset($_POST["deabetes"]) && $_POST["deabetes"][0] != '0'){
                    $nombreDeabetes = (Validacion::pregmatchletras($_POST["deabetes"][0]) == '0') ? false : true;
                    $indiqueDeabetes = (Validacion::validarNumero($_POST["deabetes"][1]) == '-1') ? false :  true;
                    $parentescoDeabetes = (Validacion::pregmatchletras($_POST["deabetes"][2]) == '0') ? false : true ;
                    if($nombreDeabetes && $indiqueDeabetes  && $parentescoDeabetes ){
                        array_push($familia,$_POST["deabetes"]);
                    }else{
                        $_SESSION['formulario'] = array(
                            "error"=> 'SECCION FAMILIARES DEABETES ES INCORRECTO  ',
                            "datos"=>$datos
                        );
                        echo '<script>window.location="'.base_url.'"</script>';
                        die();
                    }
                }
                if(isset($_POST["hipertension"]) && $_POST["hipertension"][0] != '0'){
                    $nombreHipertension = (Validacion::pregmatchletras($_POST["hipertension"][0]) == '0') ? false : true ;
                    $indiqueHipertension = (Validacion::validarNumero($_POST["hipertension"][1]) == '-1') ? false : true ;
                    $parentescoHipertension = (Validacion::pregmatchletras($_POST["hipertension"][2]) == '0') ? false : true ;
                
                    if($nombreHipertension && $indiqueHipertension && $parentescoHipertension){
                    array_push($familia,$_POST["hipertension"]);
                    }else{
                        $_SESSION['formulario'] = array(
                            "error"=> 'SECCION FAMILIARES HIPERTENSION ES INCORRECTO  ',
                            "datos"=>$datos
                        );
                        echo '<script>window.location="'.base_url.'"</script>';
                        die();
                    }
                }
                if(isset($_POST["Asma"]) && $_POST["Asma"][0] != '0'){
                    $nombreAsma = (Validacion::pregmatchletras($_POST["Asma"][0]) == '0') ? false : true ;
                    $indiqueAsma = (Validacion::validarNumero($_POST["Asma"][1]) == '-1') ? false : true ;
                    $parentescoAsma = (Validacion::pregmatchletras($_POST["Asma"][2]) == '0') ? false : true ;
                
                    if($nombreAsma && $indiqueAsma && $parentescoAsma){
                    array_push($familia,$_POST["Asma"]);
                    }else{
                        $_SESSION['formulario'] = array(
                            "error"=> 'SECCION FAMILIARES ASMA ES INCORRECTO  ',
                            "datos"=>$datos
                        );
                        echo '<script>window.location="'.base_url.'"</script>';
                        die();
                    }
                }
                if(isset($_POST["cancer"]) && $_POST["cancer"][0] != '0'){
                    $nombreCancer = (Validacion::pregmatchletras($_POST["cancer"][0]) == '0') ? false :true ;
                    $indiqueCancer = (Validacion::validarNumero($_POST["cancer"][1]) == '-1') ? false : true ;
                    $parentescoCancer = (Validacion::pregmatchletras($_POST["cancer"][2]) == '0') ? false :true ;
                    if($nombreCancer && $indiqueCancer && $parentescoCancer ){
                        array_push($familia,$_POST["cancer"]);
                    }else{
                        $_SESSION['formulario'] = array(
                            "error"=> 'SECCION FAMILIARES CANCER ES INCORRECTO  ',
                            "datos"=>$datos
                        );
                        echo '<script>window.location="'.base_url.'"</script>';
                        die();
                    }
                }
                if(isset($_POST["alergias"]) && $_POST["alergias"][0] != '0'){
                    $nombreAlergias = (Validacion::pregmatchletras($_POST["alergias"][0]) == '0') ? false : true ;
                    $indiqueAlergias = (Validacion::validarNumero($_POST["alergias"][1]) == '-1') ? false : true ;
                    $parentescoAlergias = (Validacion::pregmatchletras($_POST["alergias"][2]) == '0') ? false : true ;
                
                    if($nombreAlergias && $indiqueAlergias && $parentescoAlergias){
                    array_push($familia,$_POST["alergias"]);
                    }else{
                        $_SESSION['formulario'] = array(
                            "error"=> 'SECCION FAMILIARES Alergias ES INCORRECTO  ',
                            "datos"=>$datos
                        );
                        echo '<script>window.location="'.base_url.'"</script>';
                        die();
                    }
                }
                if(isset($_POST["otros"]) && !empty($_POST["otros"][0])){
                    $nombreOtros = (Validacion::pregmatchletras($_POST["otros"][0]) == '0') ? false : true ;
                    $indiqueOtros = (Validacion::pregmatchletras($_POST["otros"][1]) == '0') ? false : true ;
                    $parentescOtros = (Validacion::pregmatchletras($_POST["otros"][2]) == '0') ? false : true ;
                    if($nombreOtros  && $indiqueOtros && $parentescOtros ){
                        array_push($familia,$_POST["otros"]);
                    }else{
                        $_SESSION['formulario'] = array(
                            "error"=> 'SECCION FAMILIARES OTROS ES INCORRECTO  ',
                            "datos"=>$datos
                        );
                        echo '<script>window.location="'.base_url.'"</script>';
                        die();
                    }
                    
                }
                if(isset($_POST["ninguno"]) && $_POST["ninguno"][0] != '0'){
                    $nombreNinguno = (Validacion::pregmatchletras($_POST["ninguno"][0]) == '0') ? false : true ;
                    $indiqueNinguno = (Validacion::validarNumero($_POST["ninguno"][1]) == '-1') ? false : true ;
                    $parentescNinguno = (Validacion::validarNumero($_POST["ninguno"][2]) == '-1') ? false : true ;
                    if($nombreNinguno  && $indiqueNinguno && $parentescNinguno ){
                        array_push($familia,$_POST["ninguno"]);
                    }else{
                        $_SESSION['formulario'] = array(
                            "error"=> 'SECCION FAMILIARES NINGUNO ES INCORRECTO  ',
                            "datos"=>$datos
                        );
                        echo '<script>window.location="'.base_url.'"</script>';
                        die();
                    }
                    
                } 
                /* ::::::::::::::::::::::::::::::::::::::::seccion PADECIMEITN0S ACTUALES:::::::::::::::::::::::::::::::::::::::::: */          
                if(!isset($_SESSION['formulario'])){
                    $actuales = array();
                    if(isset($_POST["actualDeabetes"]) && $_POST["actualDeabetes"][0] != '0'){
                        $nombreActualDeabetes = (Validacion::pregmatchletras($_POST["actualDeabetes"][0]) == '0') ? false : true;
                        $indiqueActualDeabetes = (Validacion::validarNumero($_POST["actualDeabetes"][1]) == '-1') ? false :  true;
                        $parentescoActualDeabetes = (Validacion::pregmatchletras($_POST["actualDeabetes"][2]) == '0') ? false : true ;
                        if($nombreActualDeabetes && $indiqueActualDeabetes  && $parentescoActualDeabetes ){
                            array_push($actuales,$_POST["actualDeabetes"]);
                        }else{
                            $_SESSION['formulario'] = array(
                                "error"=> 'SECCION PADECIMIENTOS ACTUALES DEABETES ES INCORRECTO  ',
                                "datos"=>$datos
                            );
                            echo '<script>window.location="'.base_url.'"</script>';
                            die();
                        }
                    }
                    if(isset($_POST["actualHipertension"]) && $_POST["actualHipertension"][0] != '0'){
                        $nombreActualHipertension = (Validacion::pregmatchletras($_POST["actualHipertension"][0]) == '0') ? false : true ;
                        $indiqueActualHipertension = (Validacion::validarNumero($_POST["actualHipertension"][1]) == '-1') ? false : true ;
                        $parentescoActualHipertension = (Validacion::pregmatchletras($_POST["actualHipertension"][2]) == '0') ? false : true ;
                        
                        if($nombreActualHipertension && $indiqueActualHipertension && $parentescoActualHipertension){
                            array_push($actuales,$_POST["actualHipertension"]);
                        }else{
                            $_SESSION['formulario'] = array(
                                "error"=> 'SECCION PADECIMIENTOS ACTUALES HIPERTENSION ES INCORRECTO  ',
                                "datos"=>$datos
                            );
                            echo '<script>window.location="'.base_url.'"</script>';
                            die();
                        }
                    }
                    if(isset($_POST["actualAsma"]) && $_POST["actualAsma"][0] != '0'){
                        $nombreActualAsma = (Validacion::pregmatchletras($_POST["actualAsma"][0]) == '0') ? false :true ;
                        $indiqueActualAsma = (Validacion::validarNumero($_POST["actualAsma"][1]) == '-1') ? false : true ;
                        $parentescoActualAsma = (Validacion::pregmatchletras($_POST["actualAsma"][2]) == '0') ? false :true ;
                        if($nombreActualAsma && $indiqueActualAsma && $parentescoActualAsma ){
                            array_push($actuales,$_POST["actualAsma"]);
                        }else{
                            $_SESSION['formulario'] = array(
                                "error"=> 'SECCION PADECIMIENTOS ACTUALES ASMA ES INCORRECTO  ',
                                "datos"=>$datos
                            );
                            echo '<script>window.location="'.base_url.'"</script>';
                            die();
                        }
                    }
                    
                    if(isset($_POST["actualCancer"]) && $_POST["actualCancer"][0] != '0'){
                        $nombreActualCancer = (Validacion::pregmatchletras($_POST["actualCancer"][0]) == '0') ? false :true ;
                        $indiqueActualCancer = (Validacion::validarNumero($_POST["actualCancer"][1]) == '-1') ? false : true ;
                        $parentescoActualCancer = (Validacion::pregmatchletras($_POST["actualCancer"][2]) == '0') ? false :true ;
                        if($nombreActualCancer && $indiqueActualCancer && $parentescoActualCancer ){
                            array_push($actuales,$_POST["actualCancer"]);
                        }else{
                            $_SESSION['formulario'] = array(
                                "error"=> 'SECCION PADECIMIENTOS ACTUALES CANCER ES INCORRECTO  ',
                                "datos"=>$datos
                            );
                            echo '<script>window.location="'.base_url.'"</script>';
                            die();
                        }
                    }
                    if(isset($_POST["actualAlergias"]) && $_POST["actualAlergias"][0] != '0'){
                        $nombreActualAlergias = (Validacion::pregmatchletras($_POST["actualAlergias"][0]) == '0') ? false :true ;
                        $indiqueActualAlergias = (Validacion::validarNumero($_POST["actualAlergias"][1]) == '-1') ? false : true ;
                        $parentescoActualAlergias = (Validacion::pregmatchletras($_POST["actualAlergias"][2]) == '0') ? false :true ;
                        if($nombreActualAlergias && $indiqueActualAlergias && $parentescoActualAlergias ){
                            array_push($actuales,$_POST["actualAlergias"]);
                        }else{
                            $_SESSION['formulario'] = array(
                                "error"=> 'SECCION PADECIMIENTOS ACTUALES ALERGIAS ES INCORRECTO  ',
                                "datos"=>$datos
                            );
                            echo '<script>window.location="'.base_url.'"</script>';
                            die();
                        }
                    }
                    if(isset($_POST["actualDislipidemias"]) && $_POST["actualDislipidemias"][0] != '0'){
                        $nombreActualDislipidemia = (Validacion::pregmatchletras($_POST["actualDislipidemias"][0]) == '0') ? false :true ;
                        $indiqueActualDislipidemia = (Validacion::validarNumero($_POST["actualDislipidemias"][1]) == '-1') ? false : true ;
                        $parentescoActualDislipidemia = (Validacion::pregmatchletras($_POST["actualDislipidemias"][2]) == '0') ? false :true ;
                        if($nombreActualDislipidemia && $indiqueActualDislipidemia && $parentescoActualDislipidemia ){
                            array_push($actuales,$_POST["actualDislipidemias"]);
                        }else{
                            $_SESSION['formulario'] = array(
                                "error"=> 'SECCION PADECIMIENTOS ACTUALES DISLIPIDEMIAS (TRIGLICEDIDOS Y COLESTEROL) ES INCORRECTO  ',
                                "datos"=>$datos
                            );
                            echo '<script>window.location="'.base_url.'"</script>';
                            die();
                        }
                    }
                    if(isset($_POST["actualHepaticos"]) && $_POST["actualHepaticos"][0] != '0'){
                        $nombreActualHepaticos = (Validacion::pregmatchletras($_POST["actualHepaticos"][0]) == '0') ? false :true ;
                        $indiqueActualHepaticos = (Validacion::validarNumero($_POST["actualHepaticos"][1]) == '-1') ? false : true ;
                        $parentescoActualHepaticos = (Validacion::pregmatchletras($_POST["actualHepaticos"][2]) == '0') ? false :true ;
                        if($nombreActualHepaticos && $indiqueActualHepaticos && $parentescoActualHepaticos ){
                            array_push($actuales,$_POST["actualHepaticos"]);
                        }else{
                            $_SESSION['formulario'] = array(
                                "error"=> 'SECCION PADECIMIENTOS ACTUALES HEPATICOS ES INCORRECTO  ',
                                "datos"=>$datos
                            );
                            echo '<script>window.location="'.base_url.'"</script>';
                            die();
                        }
                    }
                    if(isset($_POST["actualRenales"]) && $_POST["actualRenales"][0] != '0'){
                        $nombreActualRenales = (Validacion::pregmatchletras($_POST["actualRenales"][0]) == '0') ? false :true ;
                        $indiqueActualRenales = (Validacion::validarNumero($_POST["actualRenales"][1]) == '-1') ? false : true ;
                        $parentescoActualRenales = (Validacion::pregmatchletras($_POST["actualRenales"][2]) == '0') ? false :true ;
                        if($nombreActualRenales && $indiqueActualRenales && $parentescoActualRenales ){
                            array_push($actuales,$_POST["actualRenales"]);
                        }else{
                            $_SESSION['formulario'] = array(
                                "error"=> 'SECCION PADECIMIENTOS ACTUALES RENALES ES INCORRECTO  ',
                                "datos"=>$datos
                            );
                            echo '<script>window.location="'.base_url.'"</script>';
                            die();
                        }
                    }
                    if(isset($_POST["actualUrinarios"]) && $_POST["actualUrinarios"][0] != '0'){
                        $nombreActualCancer = (Validacion::pregmatchletras($_POST["actualUrinarios"][0]) == '0') ? false :true ;
                        $indiqueActualCancer = (Validacion::validarNumero($_POST["actualUrinarios"][1]) == '-1') ? false : true ;
                        $parentescoActualCancer = (Validacion::pregmatchletras($_POST["actualUrinarios"][2]) == '0') ? false :true ;
                        if($nombreActualCancer && $indiqueActualCancer && $parentescoActualCancer ){
                            array_push($actuales,$_POST["actualUrinarios"]);
                        }else{
                            $_SESSION['formulario'] = array(
                                "error"=> 'SECCION PADECIMIENTOS ACTUALES URINARIOS ES INCORRECTO  ',
                                "datos"=>$datos
                            );
                            echo '<script>window.location="'.base_url.'"</script>';
                            die();
                        }
                    }
                    if(isset($_POST["actualProstata"]) && $_POST["actualProstata"][0] != '0'){
                        $nombreActualProstata = (Validacion::pregmatchletras($_POST["actualProstata"][0]) == '0') ? false :true ;
                        $indiqueActualProstata = (Validacion::validarNumero($_POST["actualProstata"][1]) == '-1') ? false : true ;
                        $parentescoActualProstata = (Validacion::pregmatchletras($_POST["actualProstata"][2]) == '0') ? false :true ;
                        if($nombreActualProstata && $indiqueActualProstata && $parentescoActualProstata ){
                            array_push($actuales,$_POST["actualProstata"]);
                        }else{
                            $_SESSION['formulario'] = array(
                                "error"=> 'SECCION PADECIMIENTOS ACTUALES PROSTATA ES INCORRECTO  ',
                                "datos"=>$datos
                            );
                            echo '<script>window.location="'.base_url.'"</script>';
                            die();
                        }
                    }
                    if(isset($_POST["actualDisfusion"]) && $_POST["actualDisfusion"][0] != '0'){
                        $nombreActualDisfuncion = (Validacion::pregmatchletras($_POST["actualDisfusion"][0]) == '0') ? false :true ;
                        $indiqueActualDisfuncion = (Validacion::validarNumero($_POST["actualDisfusion"][1]) == '-1') ? false : true ;
                        $parentescoActualDisfuncion = (Validacion::pregmatchletras($_POST["actualDisfusion"][2]) == '0') ? false :true ;
                        if($nombreActualDisfuncion && $indiqueActualDisfuncion && $parentescoActualDisfuncion ){
                            array_push($actuales,$_POST["actualDisfusion"]);
                        }else{
                            $_SESSION['formulario'] = array(
                                "error"=> 'SECCION PADECIMIENTOS ACTUALES DISFUNCION ES INCORRECTO  ',
                                "datos"=>$datos
                            );
                            echo '<script>window.location="'.base_url.'"</script>';
                            die();
                        }
                    }
                    if(isset($_POST["actualHipotiroidismo"]) && $_POST["actualHipotiroidismo"][0] != '0'){
                        $nombreActualHipotiroides = (Validacion::pregmatchletras($_POST["actualHipotiroidismo"][0]) == '0') ? false :true ;
                        $indiqueActualHipotiroides = (Validacion::validarNumero($_POST["actualHipotiroidismo"][1]) == '-1') ? false : true ;
                        $parentescoActualHipotiroides = (Validacion::pregmatchletras($_POST["actualHipotiroidismo"][2]) == '0') ? false :true ;
                        if($nombreActualHipotiroides && $indiqueActualHipotiroides && $parentescoActualHipotiroides ){
                            array_push($actuales,$_POST["actualHipotiroidismo"]);
                        }else{
                            $_SESSION['formulario'] = array(
                                "error"=> 'SECCION PADECIMIENTOS ACTUALES HIPOTIROIDISMO ES INCORRECTO  ',
                                "datos"=>$datos
                            );
                            echo '<script>window.location="'.base_url.'"</script>';
                            die();
                        }
                    }
                    if(isset($_POST["actualHipertiroidismo"]) && $_POST["actualHipertiroidismo"][0] != '0'){
                        $nombreActualHipertiroidismo = (Validacion::pregmatchletras($_POST["actualHipertiroidismo"][0]) == '0') ? false :true ;
                        $indiqueActualHipertiroidismo = (Validacion::validarNumero($_POST["actualHipertiroidismo"][1]) == '-1') ? false : true ;
                        $parentescoActualHipertiroidismo = (Validacion::pregmatchletras($_POST["actualHipertiroidismo"][2]) == '0') ? false :true ;
                        if($nombreActualHipertiroidismo && $indiqueActualHipertiroidismo && $parentescoActualHipertiroidismo ){
                            array_push($actuales,$_POST["actualHipertiroidismo"]);
                        }else{
                            $_SESSION['formulario'] = array(
                                "error"=> 'SECCION PADECIMIENTOS ACTUALES HIPERTIROIDISMO ES INCORRECTO  ',
                                "datos"=>$datos
                            );
                            echo '<script>window.location="'.base_url.'"</script>';
                            die();
                        }
                    }
                    if(isset($_POST["actualSindrome"]) && $_POST["actualSindrome"][0] != '0'){
                        $nombreActualSindrome = (Validacion::pregmatchletras($_POST["actualSindrome"][0]) == '0') ? false :true ;
                        $indiqueActualSindrome = (Validacion::validarNumero($_POST["actualSindrome"][1]) == '-1') ? false : true ;
                        $parentescoActualSindrome = (Validacion::pregmatchletras($_POST["actualSindrome"][2]) == '0') ? false :true ;
                        if($nombreActualSindrome && $indiqueActualSindrome && $parentescoActualSindrome ){
                            array_push($actuales,$_POST["actualSindrome"]);
                        }else{
                            $_SESSION['formulario'] = array(
                                "error"=> 'SECCION PADECIMIENTOS ACTUALES SINDROME DE OVARIO POLIQUISTICO ES INCORRECTO  ',
                                "datos"=>$datos
                            );
                            echo '<script>window.location="'.base_url.'"</script>';
                            die();
                        }
                    }

                    if(isset($_POST["actualOtro"]) && !empty($_POST["actualOtro"][0])){
                        $nombreActualOtros = (Validacion::pregmatchletras($_POST["actualOtro"][0]) == '0') ? false : true ;
                        $indiqueActualOtros = (Validacion::pregmatchletras($_POST["actualOtro"][1]) == '0') ? false : true ;
                        $parentescActualOtros = (Validacion::pregmatchletras($_POST["actualOtro"][2]) == '0') ? false : true ;
                        if($nombreActualOtros  && $indiqueActualOtros && $parentescActualOtros ){
                            array_push($actuales,$_POST["actualOtro"]);
                        }else{
                            $_SESSION['formulario'] = array(
                                "error"=> 'SECCION PADECIMIENTOS ACTUALES OTRO ES INCORRECTO  ',
                                "datos"=>$datos
                            );
                            echo '<script>window.location="'.base_url.'"</script>';
                            die();
                        }
                    }
                    if(isset($_POST["actualNinguno"]) && $_POST["actualNinguno"][0] != '0'){
                        $nombreActualNinguno = (Validacion::pregmatchletras($_POST["actualNinguno"][0]) == '0') ? false : true ;
                        $indiqueActualNinguno = (Validacion::validarNumero($_POST["actualNinguno"][1]) == '-1') ? false : true ;
                        $parentescActualNinguno = (Validacion::validarNumero($_POST["actualNinguno"][2]) == '-1') ? false : true ;
                        
                        if($nombreActualNinguno  && $indiqueActualNinguno && $parentescActualNinguno ){
                            array_push($actuales,$_POST["actualNinguno"]);
                        }else{
                            $_SESSION['formulario'] = array(
                                "error"=> 'SECCION PADECIMIENTOS ACTUALES NINGUNO ES INCORRECTO  ',
                                "datos"=>$datos
                            );
                            echo '<script>window.location="'.base_url.'"</script>';
                            die();
                        }
                    }
                    /* ::::::::::::::::::::::::::::::::::::::::seccion CIRUGIA:::::::::::::::::::::::::::::::::::::::::: */          
                    if(!isset($_SESSION['formulario'])){
                        $cirugiaArray = array();
                        if(isset($_POST["cirugia"]) &&  $_POST["cirugia"] == "1"){
                            if(isset($_POST["operacionUno"]) && !empty($_POST["operacionUno"][0])){
                                $operacionUnoTexto = (Validacion::textoLargo($_POST["operacionUno"][0]) == '900') ? false : true ;
                                $operacionUnoFecha = (Validacion::valFecha($_POST["operacionUno"][1]) == '0') ? false : true ;
                                
                                if($operacionUnoTexto && $operacionUnoFecha){
                                    array_push($cirugiaArray,$_POST["operacionUno"]);
                                }else{
                                    $_SESSION['formulario'] = array(
                                        "error"=> 'SECCION CIRUGIA UNO ES INCORRECTO  ',
                                        "datos"=>$datos
                                    );
                                    echo '<script>window.location="'.base_url.'"</script>';
                                    die();
                                }
                            }
                            
                            if(isset($_POST["operacionDos"]) && !empty($_POST["operacionDos"][0])){
                                $operacionDosTexto = (Validacion::textoLargo($_POST["operacionDos"][0]) == '900') ? false : true ;
                                $operacionDosFecha = (Validacion::valFecha($_POST["operacionDos"][1]) == '0') ? false : true ;
                                
                                if($operacionDosTexto && $operacionDosFecha){
                                    array_push($cirugiaArray,$_POST["operacionDos"]);
                                }else{
                                    $_SESSION['formulario'] = array(
                                        "error"=> 'SECCION CIRUGIA DOS ES INCORRECTO  ',
                                        "datos"=>$datos
                                    );
                                    echo '<script>window.location="'.base_url.'"</script>';
                                    die();
                                }
                            }
                            
                            if(isset($_POST["operacionTres"]) && !empty($_POST["operacionTres"][0])){
                                $operacionTresTexto = (Validacion::pregmatchletras($_POST["operacionTres"][0]) == '0') ? false : true ;
                                $operacionTresFecha = (Validacion::valFecha($_POST["operacionTres"][1]) == '0') ? false : true ;
                                
                                if($operacionTresTexto && $operacionTresFecha){
                                    array_push($cirugiaArray,$_POST["operacionTres"]);
                                }else{
                                    $_SESSION['formulario'] = array(
                                        "error"=> 'SECCION CIRUGIA TRES ES INCORRECTO  ',
                                        "datos"=>$datos
                                    );
                                    echo '<script>window.location="'.base_url.'"</script>';
                                    die();
                                }
                            }
                        }else{
                            array_push($cirugiaArray,array("no","1800-01-01"));
                        }
                        /* ::::::::::::::::::::::::::::::::::::::::seccion MUJUER:::::::::::::::::::::::::::::::::::::::::: */          
                        if(!isset($_SESSION['formulario'])){
                            if($sexo == 'mujer'){
                                $embarazo = (!isset($_POST['embarazos']) || Validacion::validarNumero($_POST['embarazos']) == '-1') ? false : $_POST['embarazos'] ;
                                $termino = (!isset($_POST['namcidosTermino']) || Validacion::validarNumero($_POST['namcidosTermino']) == '-1') ? false : $_POST['namcidosTermino'] ;
                                $pretermino = (!isset($_POST['nacidosPretermino']) || Validacion::validarNumero($_POST['nacidosPretermino']) == '-1') ? false : $_POST['nacidosPretermino'] ;
                                $fechaUltimoEmbarazo = (!isset($_POST['ultimoEmbarazo']) || Validacion::valFecha($_POST["ultimoEmbarazo"]) == '0') ? false : Validacion::valFecha($_POST["ultimoEmbarazo"]) ;
                                $fechaUltimoRegla = (!isset($_POST['regla']) || Validacion::valFecha($_POST["regla"]) == '0') ? false : Validacion::valFecha($_POST["regla"]) ;
                                $anticonceptivo = (!isset($_POST['MedotoAnticonceptivo']) || Validacion::pregmatchletras($_POST['MedotoAnticonceptivo']) == '0') ? false : $_POST['MedotoAnticonceptivo'] ;
                                
                                $mujerDatos = array('embarazo' =>$embarazo ,'termino' =>$termino , 'pretermino' =>$pretermino ,'fechaUltimoEmbarazo' =>$fechaUltimoEmbarazo ,'fechaUltimoRegla' =>$fechaUltimoRegla,'anticonceptivo'=>$anticonceptivo);
                                foreach ($mujerDatos as $mujer => $value) {
                                    // echo "mi titulo es = ".$mujer." y tiene un dato de = ".$value.";<br>";
                                    if($value === false){
                                        $_SESSION['formulario'] = array(
                                            "error"=> 'El campo '.$mujer." es Incorrecto, Llena los campos faltantes",
                                            "datos"=>$datos
                                        );
                                    break;
                                }
                            }
                        }
                        if(!isset($_SESSION['formulario'])){
                            
                            /* ::::::::::::::::::::::::::::::::::::::::seccion MEDICAMENTO ANTERIOR:::::::::::::::::::::::::::::::::::::::::: */          
                                if(isset($_POST["radioTratamiento"]) &&  $_POST["radioTratamiento"] == "1"){
                                    
                                    $medicamentoControl = (Validacion::pregmatchletras($_POST["medicamentoAnterior"]) == '0') ? false : $_POST["medicamentoAnterior"] ;
                                    if($medicamentoControl != false){
                                        $_SESSION['medicamento'] = $medicamentoControl;
                                    }else{
                                        $_SESSION['formulario'] = array(
                                            "error"=> 'SECCION MEDICAMNETOS EN PESO DE CONTROL TRES ES INCORRECTO  ',
                                            "datos"=>$datos
                                        );
                                        echo '<script>window.location="'.base_url.'"</script>';
                                        die();
                                    }
                                }else if(isset($_POST["radioTratamiento"]) &&  $_POST["radioTratamiento"] == "2"){
                                    $_SESSION['medicamento'] = 'SIN MEDICAMENTO';
                                }
                                /* INSERTAMOS A LA BASE DE DATOS DESPUES DE VALIDAR TODOS LOS CAMPOS */
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
                                    $paciente->setInpuTelEmergencia($tetefono_emergencia);
                                    $paciente->setInpuParentesco($parentesco);
                                    $paciente->setInpuNombreRecomienda($nombre_Recomienda);
                                    $paciente->setInpuMotivo($motivo);
                                    $paciente->setInputNombreMedicamento($medicamento);
                                    $insertar = $paciente->insertPaciente();
                                    if($insertar){
                                        echo 'ok datos generales.<br>';
                                        $enfermedad = new Usuario();
                                        $enfermedad->setTabla('enfermedadfamiliar');
                                        $enfermedad->setIdPaciente($_POST["idPaciente"]);
                                        $enfermedad->setSelect($familia);
                                        $insertEnf = $enfermedad->insertEnfermedad();
                                        if($insertEnf){
                                            echo 'ok enfermedades falimilia<br>';
                                            $actual = new Usuario();
                                            $actual->setTabla('antecedentespatologicos');
                                            $actual->setIdPaciente($_POST["idPaciente"]);
                                            $actual->setSelect($actuales);
                                            $insertActual = $actual->insertEnfermedad();
                                            if($insertActual){
                                                echo 'ok antecedentes patologicos<br>';
                                                $cirugia = new Usuario();
                                                $cirugia->setTabla('cirugia');
                                                $cirugia->setIdPaciente($_POST["idPaciente"]);
                                                $cirugia->setCirugia($cirugiaArray);
                                                $insertCirugia = $cirugia->insertCiruguias();
                                                if($insertCirugia){
                                                    echo 'ok cirugias<br>';
                                                    if($sexo == 'mujer'){
                                                    $datosMujer = new Usuario();
                                                    $datosMujer->setIdPaciente($_POST["idPaciente"]);
                                                    $datosMujer->setEmbarazo($embarazo);
                                                    $datosMujer->setTerminoEmbarazo($termino);
                                                    $datosMujer->setAborto($pretermino);
                                                    $datosMujer->setFechaUltmoEmbarazo($fechaUltimoEmbarazo);
                                                    $datosMujer->setPeriodo($fechaUltimoRegla);
                                                    $datosMujer->setAnticonceptivo($anticonceptivo);
                                                    $insertDatos = $datosMujer->insertDatoMujer();  
                                                    }        
                                                    if($sexo == 'mujer'){echo 'ok datos Mujer<br>';}else{ echo 'ok datos sin datos mujer<br>';}                             
                                                    if($insertDatos){  
                                                        $medicamento = new Usuario();
                                                        $medicamento->setIdPaciente($_POST["idPaciente"]);
                                                        $medicamento->setMedicamento($_SESSION['medicamento']);
                                                        $insertMedicamento = $medicamento->insertControl();
                                                        if($insertMedicamento){
                                                            $_SESSION['statusSave'] = "SE HA REGISTRADO EXITOSAMENTE";
                                                            echo '<script>window.location="'.base_url.'Paciente/index"</script>';
                                                        }                                                      
                                                    } else{
                                                        echo 'ERROR DATOS MUJER';
                                                    }                                                
                                                }else{
                                                    echo 'ERROR cirugias<br>';
                                                }
                                            }else{
                                                echo 'ERROR enfermedades falimilia<br>';
                                            }
                                        }else{
                                            echo 'ERROR enfermedades falimilia<br>'; 
                                        }
                                    }else{
                                        echo 'ERROR datos generales.<br>';
                                    }
                                }
                            }else{
                                echo '<script>window.location="'.base_url.'"</script>';
                            }
                        }else{
                            echo '<script>window.location="'.base_url.'"</script>';
                        }
                    }else{
                        echo '<script>window.location="'.base_url.'"</script>';                    
                    }
                }else{
                    echo '<script>window.location="'.base_url.'"</script>';                    
                }
            }else{
                echo '<script>window.location="'.base_url.'"</script>';
            }
            
        }else{
            echo 'no existe';
            die();
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
            $resultado = $mail->getEmailExis($correo);
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