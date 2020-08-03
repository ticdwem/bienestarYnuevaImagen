<?php
require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/config/modeloBase.php";


class Consultorio extends ModeloBase{

    private $nombre;
    private $municipio;
    private $cp;
    private $colonia;
    private $calle;
    private $numero;
    
    public function __construct() {
        parent::__construct();
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of municipio
     */ 
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * Set the value of municipio
     *
     * @return  self
     */ 
    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * Get the value of cp
     */ 
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set the value of cp
     *
     * @return  self
     */ 
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get the value of colonia
     */ 
    public function getColonia()
    {
        return $this->colonia;
    }

    /**
     * Set the value of colonia
     *
     * @return  self
     */ 
    public function setColonia($colonia)
    {
        $this->colonia = $colonia;

        return $this;
    }

    /**
     * Get the value of calle
     */ 
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set the value of calle
     *
     * @return  self
     */ 
    public function setCalle($calle)
    {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    public function insertConsultorio(){
        $insert = "INSERT INTO consultorio
        (id_consultorio, nombreConsultorio, municipioConsultorio, cpConsultorio, calleConsultorio, numeroConsultorio, statusConsultorio)
        VALUES (NULL, '{$this->getNombre()}','{$this->getMunicipio()}', '{$this->getCp()}', '{$this->getCalle()}', '{$this->getNumero()}', '1')";

        $query=$this->db->query($insert);
        $result = false;
        if($query){
            $result = true;
        }
        return $result;
    }
}