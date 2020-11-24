<?php
require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/config/modeloBase.php";
// require_once $_SERVER['DOCUMENT_ROOT']."/config/modeloBase.php";

class Doctor extends ModeloBase{
    private $nombre;
    private $apellidoP;
    private $apellidoM;
    private $sexo;
    private $correo;
    private $tipoUser;
    private $statusUser;
    private $passwordUser;
    private $idUsuario;
    private $idsubmenu;
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

    /**
     * Get the value of tipoUser
     */ 
    public function getidUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of tipoUser
     *
     * @return  self
     */ 
    public function setidUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    
    /**
     * Get the value of tipoUser
     */ 
    public function getidsubmenu()
    {
        return $this->idsubmenu;
    }

    /**
     * Set the value of tipoUser
     *
     * @return  self
     */ 
    public function setidsubmenu($idsubmenu)
    {
        $this->idsubmenu = $idsubmenu;

        return $this;
    }

        /**
     * Get the value of statusUser
     */ 
    public function getStatusUser()
    {
        return $this->statusUser;
    }

    /**
     * Set the value of statusUser
     *
     * @return  self
     */ 
    public function setStatusUser($statusUser)
    {
        $this->statusUser = $statusUser;

        return $this;
    }

    /**
     * Get the value of passwordUser
     */ 
    public function getPasswordUser()
    {
        return $this->passwordUser;
    }

    /**
     * Set the value of passwordUser
     *
     * @return  self
     */ 
    public function setPasswordUser($passwordUser)
    {
        $this->passwordUser = $passwordUser;

        return $this;
    }

    public function insertDoctor(){
        $insert = "INSERT INTO usuarioDoctor (nombreUsuarioDoctor, apPUsuarioDoctor, apMUsuarioDoctor, sexoUsuarioDoctor, emailUsuarioDoctor, tipoUsuarioDoctor, statusUsuarioDoctor)
        VALUES ('{$this->getNombre()}', '{$this->getApellidoP()}', '{$this->getApellidoM()}', '{$this->getSexo()}', '{$this->getCorreo()}', '{$this->getTipoUser()}', 1)";
        $saveDoctor = $this->db->query($insert);

        $doctor = false;
        if($saveDoctor){
            $maximo = "SELECT MAX(idUsuario) as iduser FROM usuario";
            $idDoctor = $this->db->query($maximo);
            if($idDoctor){
                $doctor = $idDoctor->fetch_object();;
            }
        }    
        return $doctor;
    }

    public function insertMenu(){
        foreach ($this->getidsubmenu() as $id) {
             $insertPermiso = "INSERT INTO usuarioMenu (idUsuario, idSubmenu) VALUES ('{$this->getidUsuario()}', '$id')";

             $insertmenu = $this->db->query($insertPermiso);
        }
          $menu = false;
          if( $insertmenu){
              $menu = true;
          }
          return $menu;
    }

    public function updateDoctor(){
        $update = "UPDATE usuarioDoctor
        SET nombreUsuarioDoctor = '{$this->getNombre()}',
             apPUsuarioDoctor = '{$this->getApellidoP()}',
             apMUsuarioDoctor = '{$this->getApellidoM()}',
             tipoUsuarioDoctor = '{$this->getTipoUser()}',
             statusUsuarioDoctor= '{$this->getStatusUser()}',
             sexoUsuarioDoctor = '{$this->getSexo()}'
             WHERE emailUsuarioDoctor = '{$this->getCorreo()}'
             ";
        
        $updateDoctor = $this->db->query($update);
        $upConMeso = false;
        if($updateDoctor){
            $upConMeso = true;
        }
        return $upConMeso;
    }




}


