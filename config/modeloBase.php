<?php
require_once 'db.php';
class ModeloBase{
    public $db;
    
    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAll($tabla){
    	$consulta = "SELECT * FROM $tabla";
        $query = $this->db->query($consulta);
        return $query;
    }
    public function getIdCleinte($id,$tabla){
         $getId = "SELECT IFNULL(MAX($id),0)+1 as id FROM $tabla";
         $id = $this->db->query($getId);
         return $id;
    }

    public function getAllStatus($consultorio,$status){
        $getAll=('CALL Proc_getNewCliente('.$status.','.$consultorio.')');
        $nuevo = $this->db->query($getAll);

        return $nuevo;
    }

    public function getEmailExis($email){
        $validar = "SELECT us.correoUsuario, us.tipoUsuario FROM usuario us WHERE us.correoUsuario = '$email'";
        $query = $this->db->query($validar);

        return $query;
    }

}