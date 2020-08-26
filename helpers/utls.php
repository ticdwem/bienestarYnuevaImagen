<?php

class Utls{
    // public static function verifSession($session){
    //     if(empty($session)){
    //         session_destroy();
    //         echo '<script>window.location="'.base_url.'"</script>';
    //     }

    // }

    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
                $_SESSION[$name] = null;
                unset($_SESSION[$name]);
        }
        return $name;
    }
    public static function getApellido($apellido){
        $dato = explode(' ',$apellido);
        $primer = $dato[0];
        $second = $dato[1];

        return ucwords(SED::decryption($primer).' '.SED::decryption($second));
    }

    public static function createId($sesionConsultorio,$idbd){
        $increment=0;
        $Ano = date('Y');
        $mes = date('m'); 
        $consultorio = ($sesionConsultorio >= 10) ? $sesionConsultorio : '0'.$sesionConsultorio ;
        if($mes === '01'){
            $increment = '0001';
        }else{
            if ($idbd == '1') {
                $increment = '0001';
            }else{
                $increment = substr($idbd,7); 
            }
        }

        return $consultorio.$Ano.$mes.$increment;
    }

    public static function getSeccion($seccion){
        $nameSEccion = '';
        if($seccion == ''){
            $nameSEccion = 'clienteMunicipio';
        }elseif($seccion == 'heredofamiliar'){
            $nameSEccion = 'enfermedadfamiliar';
        }elseif($seccion == 'patologico'){
            $nameSEccion = 'antecedentespatologicos';
        }elseif($seccion == 'cirugia'){
            $nameSEccion = 'cirugia';
        }

        return $nameSEccion;
    }

    public static function titleCabecera($titleGet){
        $controlador = $titleGet['controller'];
        
        switch ($controlador) {
            case 'Consultorio':
                if($_GET['action'] == "nuevo"){
                    $getTirulo = "Nuevo Ingreso";
                }else if('control'){
                    $getTirulo = "Control";
                }
                break;
            case 'Paciente':
                if($_GET['action'] == 'index'){
                    $getTirulo = "Hoja Clinica";
                }elseif($_GET['action'] == 'editar'){
                    $getTirulo = "Editar Hoja Clinica";
                }elseif($_GET['action']== 'editarAntecedente'){
                    $getTirulo = "Editar Antecedentes";
                }elseif($_GET['action']== 'editarPatologico'){
                    $getTirulo = "Editar Patologicos";
                }elseif($_GET['action']== 'editarCirugia'){
                    $getTirulo = "Editar Cirugias";
                }
                break;
            case 'Doctor':
                if($_GET['action'] == 'index'){
                    $getTirulo = "Alta Doctor";
                }
                break;
            default:
            case 'Consulta':
                if($_GET['action'] == "ingreso"){
                    $getTirulo = "Pagos Y Consultas";
                }else if($_GET['action'] == "index"){
                    $getTirulo = "Datos" ;
                }else if($_GET['action'] == "lista"){
                    $getTirulo = "Pacientes";
                }
                break;
            $getTirulo = "Bienestar Nueva Imagen";
                break;
        }
        return $getTirulo;
    }
}
