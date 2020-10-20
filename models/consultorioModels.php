<?php
require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/config/modeloBase.php";
// require_once $_SERVER['DOCUMENT_ROOT']."/config/modeloBase.php";


class Consultorio extends ModeloBase{

    private $idConsultorio;
    private $nombre;
    private $municipio;
    private $cp;
    private $colonia;
    private $calle;
    private $numero;
    private $mesoCons;
    private $datos;
    private $fechaConsulta;
    
    public function __construct() {
        parent::__construct();
    }

    /**
     * Get the value of idConsultorio
     */ 
    public function getIdConsultorio()
    {
        return $this->idConsultorio;
    }

    /**
     * Set the value of idConsultorio
     *
     * @return  self
     */ 
    public function setIdConsultorio($idConsultorio)
    {
        $this->idConsultorio = $idConsultorio;

        return $this;
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
    /**
     * Get the value of mesoCons
     */ 
    public function getMesoCons()
    {
        return $this->mesoCons;
    }

    /**
     * Set the value of mesoCons
     *
     * @return  self
     */ 
    public function setMesoCons($mesoCons)
    {
        $this->mesoCons = $mesoCons;

        return $this;
    }
        /**
     * Get the value of datos
     */ 
    public function getDatos()
    {
        return $this->datos;
    }

    /**
     * Set the value of datos
     *
     * @return  self
     */ 
    public function setDatos($datos)
    {
        $this->datos = $datos;

        return $this;
    }

        /**
     * Get the value of fechaConsulta
     */ 
    public function getFechaConsulta()
    {
        return $this->fechaConsulta;
    }

    /**
     * Set the value of fechaConsulta
     *
     * @return  self
     */ 
    public function setFechaConsulta($fechaConsulta)
    {
        $this->fechaConsulta = $fechaConsulta;

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

    public function updaControl($campo){
    $update = "UPDATE consultorio SET $campo = '{$this->getMesoCons()}' WHERE id_consultorio = '{$this->getIdConsultorio()}'";
    $query = $this->db->query($update);
    $upConMeso = false;
    if($query){
        $upConMeso = true;
    }
    return $upConMeso;
    }

    public function getMedicinaModels(){
        $medicina = "SELECT cn.id_consultorio,cn.nombreConsultorio,cn.meso_Consultorio,cn.consentrado_Consultorio,cn.statusConsultorio 
                     FROM consultorio cn
                     WHERE cn.id_consultorio = '{$this->getIdConsultorio()}' AND cn.statusConsultorio = 1";
        $qiery = $this->db->query($medicina);
        if($qiery && $qiery->num_rows == 1){
            $consultorio = $qiery->fetch_object();
            return $consultorio;
        }
    }

    public function getDatosConsultorio(){
        $consultorio = "SELECT id_consultorio,meso_Consultorio,consentrado_Consultorio FROM consultorio WHERE id_consultorio = '{$this->getIdConsultorio()}'";
        $conMeso = $this->db->query($consultorio);
        if($conMeso && $conMeso->num_rows == 1){
            $mesoCon = $conMeso->fetch_object();
            return $mesoCon;
        }

    }

    public function getRegistroDatos(){
        $datos = "CALL datosConsultorio('{$this->getIdConsultorio()}','{$this->getFechaConsulta()}')";
        $query = $this->db->query($datos);
        if($query && $query->num_rows==1){
            $dtos = $query->fetch_object();
            return $dtos;
        }else{
            return 0;
        }
    }

    public function getDatosConsulta(){
        $consulta = "SELECT * FROM consultaPaciente WHERE  idConsultorio = '{$this->getIdConsultorio()}' AND  fechaConsulta = '{$this->getFechaConsulta()}'";
        $quertyConsulta = $this->db->query($consulta);

        if($quertyConsulta && $quertyConsulta->num_rows >= 1){
            return $quertyConsulta;
        }else{
            return 0;
        }
    }

    public function getMoneyTotal(){
        $consulta = "
        CALL cajaIO('{$this->getIdConsultorio()}','{$this->getFechaConsulta()}')";
        $quertyConsulta = $this->db->query($consulta);
        $dtos = $quertyConsulta->fetch_object();

        if($quertyConsulta && $quertyConsulta->num_rows >= 1){
            return $dtos;
        }else{
            return 0;
        }
    }



}