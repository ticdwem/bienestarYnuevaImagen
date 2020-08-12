<?php
require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/config/modeloBase.php";

class Doctor extends ModeloBase{
    private $nombre;
    private $apellidoP;
    private $apellidoM;
    private $sexo;
    private $correo;
    private $tipoUser;
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return SED::encryption($this->nombre);
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
     * Get the value of apellidoP
     */ 
    public function getApellidoP()
    {
        return SED::encryption($this->apellidoP);
    }

    /**
     * Set the value of apellidoP
     *
     * @return  self
     */ 
    public function setApellidoP($apellidoP)
    {
        $this->apellidoP = $apellidoP;

        return $this;
    }

    /**
     * Get the value of apellidoM
     */ 
    public function getApellidoM()
    {
        return SED::encryption($this->apellidoM);
    }

    /**
     * Set the value of apellidoM
     *
     * @return  self
     */ 
    public function setApellidoM($apellidoM)
    {
        $this->apellidoM = $apellidoM;

        return $this;
    }

    /**
     * Get the value of sexo
     */ 
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set the value of sexo
     *
     * @return  self
     */ 
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get the value of correo
     */ 
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @return  self
     */ 
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

        /**
     * Get the value of tipoUser
     */ 
    public function getTipoUser()
    {
        return $this->tipoUser;
    }

    /**
     * Set the value of tipoUser
     *
     * @return  self
     */ 
    public function setTipoUser($tipoUser)
    {
        $this->tipoUser = $tipoUser;

        return $this;
    }

    public function insertDoctor(){
        $insert = "INSERT INTO usuarioDoctor (nombreUsuarioDoctor, apPUsuarioDoctor, apMUsuarioDoctor, sexoUsuarioDoctor, emailUsuarioDoctor, tipoUsuarioDoctor, statusUsuarioDoctor)
        VALUES ('{$this->getNombre()}', '{$this->getApellidoP()}', '{$this->getApellidoM()}', '{$this->getSexo()}', '{$this->getCorreo()}', '{$this->getTipoUser()}', 1)";
        $saveDoctor = $this->db->query($insert);

        $doctor = false;
        if($saveDoctor){
            $doctor = true;
        }    
        return $doctor;
    }


}


