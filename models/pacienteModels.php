<?php
// require_once 'config/modeloBase.php';
require_once $_SERVER['DOCUMENT_ROOT']."\config\modeloBase.php";

class Usuario extends ModeloBase{

	private $idEstado;
    
    public function __construct() {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    /**
     * @param mixed $idEstado
     *
     * @return self
     */
    public function setIdEstado($idEstado)
    {
        $this->idEstado = $idEstado;

        return $this;
    }

    public function getMunModels(){
    	$consulta = "SELECT mp.id,mp.municipio,es.estado FROM estados_municipios esmp
									INNER JOIN municipios mp
									ON esmp.municipios_id = mp.id
									INNER JOIN estados es
									ON esmp.estados_id = es.id
									WHERE es.id = {$this->getIdEstado()}";
    	$query = $this->db->query($consulta);

        return $query;
    }

    
}