<?php

class Utls{
    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
                $_SESSION[$name] = null;
                unset($_SESSION[$name]);
        }
        return $name;
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

    public static function titleCabecera($titleGet){
        $controlador = $titleGet['controller'];
        
        switch ($controlador) {
            case 'Consultorio':
                if($_GET['action'] == "nuevo"){
                    $getTirulo = "Paciente Nuevo";
                }else if('control'){
                    $getTirulo = "Control ";
                }
                break;
            case 'Paciente':
                if($_GET['action'] == 'index'){
                    $getTirulo = "Hoja Clinica";
                }
                break;
            case 'Doctor':
                if($_GET['action'] == 'index'){
                    $getTirulo = "Alta Doctor";
                }
                break;
            default:
            $getTirulo = "Bienestar Nueva Imagen";
                break;
        }
        return $getTirulo;
    }
}
