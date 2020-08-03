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
        if($mes === '01'){
            $increment = '0001';
        }else{
            if ($idbd == '1') {
                $increment = '0001';
            }else{
                $increment = substr($idbd,7); 
            }
        }
        //12020070010;

        return $sesionConsultorio.$Ano.$mes.$increment;
    }
}
