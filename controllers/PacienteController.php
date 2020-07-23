<?php

class PacienteController{
    /*este es una clase de prueba para saber que todo esta bien relacionado */
    public function index(){
	require_once 'models/pacienteModels.php';
    	 $estado = new Usuario();
    	 $nombreE = $estado->getAll('estados'); 

       require_once 'views/paciente/registro.php';
        
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

}