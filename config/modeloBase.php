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
}