<?php
require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/config/modeloBase.php";
// require_once $_SERVER['DOCUMENT_ROOT']."/config/modeloBase.php";

class Consulta extends ModeloBase{
    private $id;
    private $cobro;
    private $estatura;
    private $obser;
    private $consultorio;
    private $doctor;
    private $tituloPeso;
    private $fechaConsulta;
    private $pesoActual;
    private $medida1;
    private $medida2;
    private $medida3;
    private $medida4;
    private $aparato;
    private $pesoPerdido;
    private $medicina;
    private $mesoterapia;
    private $concentrado;
    private $promocion;
    private $efectivo;
    private $tarjeta;
    private $valorPago;
    private $motivo;

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Get the value of estatura
     */ 
    public function getEstatura()
    {
        return $this->estatura;
    }

    /**
     * Set the value of estatura
     *
     * @return  self
     */ 
    public function setEstatura($estatura)
    {
        $this->estatura = $estatura;

        return $this;
    }

    /**
     * Get the value of cobro
     */ 
    public function getCobro()
    {
        return $this->cobro;
    }

    /**
     * Set the value of cobro
     *
     * @return  self
     */ 
    public function setCobro($cobro)
    {
        $this->cobro = $cobro;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    /**
     * Get the value of obser
     */ 
    public function getObser()
    {
        return $this->obser;
    }

    /**
     * Set the value of obser
     *
     * @return  self
     */ 
    public function setObser($obser)
    {
        $this->obser = $obser;

        return $this;
    }
        /**
     * Get the value of consultorio
     */ 
    public function getConsultorio()
    {
        return $this->consultorio;
    }

    /**
     * Set the value of consultorio
     *
     * @return  self
     */ 
    public function setConsultorio($consultorio)
    {
        $this->consultorio = $consultorio;

        return $this;
    }

       /**
     * Get the value of doctor
     */ 
    public function getDoctor()
    {
        return $this->doctor;
    }

    /**
     * Set the value of doctor
     *
     * @return  self
     */ 
    public function setDoctor($doctor)
    {
        $this->doctor = $doctor;

        return $this;
    }

    /**
     * Get the value of tituloPeso
     */ 
    public function getTituloPeso()
    {
        return $this->tituloPeso;
    }

    /**
     * Set the value of tituloPeso
     *
     * @return  self
     */ 
    public function setTituloPeso($tituloPeso)
    {
        $this->tituloPeso = $tituloPeso;

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
    /**
     * Get the value of pesoActual
     */ 
    public function getPesoActual()
    {
        return $this->pesoActual;
    }

    /**
     * Set the value of pesoActual
     *
     * @return  self
     */ 
    public function setPesoActual($pesoActual)
    {
        $this->pesoActual = $pesoActual;

        return $this;
    }

    /**
     * Get the value of medida1
     */ 
    public function getMedida1()
    {
        return $this->medida1;
    }

    /**
     * Set the value of medida1
     *
     * @return  self
     */ 
    public function setMedida1($medida1)
    {
        $this->medida1 = $medida1;

        return $this;
    }

    /**
     * Get the value of medida2
     */ 
    public function getMedida2()
    {
        return $this->medida2;
    }

    /**
     * Set the value of medida2
     *
     * @return  self
     */ 
    public function setMedida2($medida2)
    {
        $this->medida2 = $medida2;

        return $this;
    }

    /**
     * Get the value of medida3
     */ 
    public function getMedida3()
    {
        return $this->medida3;
    }

    /**
     * Set the value of medida3
     *
     * @return  self
     */ 
    public function setMedida3($medida3)
    {
        $this->medida3 = $medida3;

        return $this;
    }

    /**
     * Get the value of medida4
     */ 
    public function getMedida4()
    {
        return $this->medida4;
    }

    /**
     * Set the value of medida4
     *
     * @return  self
     */ 
    public function setMedida4($medida4)
    {
        $this->medida4 = $medida4;

        return $this;
    }

    /**
     * Get the value of aparato
     */ 
    public function getAparato()
    {
        return $this->aparato;
    }

    /**
     * Set the value of aparato
     *
     * @return  self
     */ 
    public function setAparato($aparato)
    {
        $this->aparato = $aparato;

        return $this;
    }

    /**
     * Get the value of pesoPerdido
     */ 
    public function getPesoPerdido()
    {
        return $this->pesoPerdido;
    }

    /**
     * Set the value of pesoPerdido
     *
     * @return  self
     */ 
    public function setPesoPerdido($pesoPerdido)
    {
        $this->pesoPerdido = $pesoPerdido;

        return $this;
    }

    /**
     * Get the value of medicina
     */ 
    public function getMedicina()
    {
        return $this->medicina;
    }

    /**
     * Set the value of medicina
     *
     * @return  self
     */ 
    public function setMedicina($medicina)
    {
        $this->medicina = $medicina;

        return $this;
    }

    /**
     * Get the value of mesoterapia
     */ 
    public function getMesoterapia()
    {
        return $this->mesoterapia;
    }

    /**
     * Set the value of mesoterapia
     *
     * @return  self
     */ 
    public function setMesoterapia($mesoterapia)
    {
        $this->mesoterapia = $mesoterapia;

        return $this;
    }

    /**
     * Get the value of concentrado
     */ 
    public function getConcentrado()
    {
        return $this->concentrado;
    }

    /**
     * Set the value of concentrado
     *
     * @return  self
     */ 
    public function setConcentrado($concentrado)
    {
        $this->concentrado = $concentrado;

        return $this;
    }

    /**
     * Get the value of promocion
     */ 
    public function getPromocion()
    {
        return $this->promocion;
    }

    /**
     * Set the value of promocion
     *
     * @return  self
     */ 
    public function setPromocion($promocion)
    {
        $this->promocion = $promocion;

        return $this;
    }

    /**
     * Get the value of efectivo
     */ 
    public function getEfectivo()
    {
        return $this->efectivo;
    }

    /**
     * Set the value of efectivo
     *
     * @return  self
     */ 
    public function setEfectivo($efectivo)
    {
        $this->efectivo = $efectivo;

        return $this;
    }

    /**
     * Get the value of tarjeta
     */ 
    public function getTarjeta()
    {
        return $this->tarjeta;
    }

    /**
     * Set the value of tarjeta
     *
     * @return  self
     */ 
    public function setTarjeta($tarjeta)
    {
        $this->tarjeta = $tarjeta;

        return $this;
    }

    /**
     * Get the value of motivo
     */ 
    public function getMotivo()
    {
        return $this->motivo;
    }

    /**
     * Set the value of motivo
     *
     * @return  self
     */ 
    public function setMotivo($motivo)
    {
        $this->motivo = $motivo;

        return $this;
    }

    /**
     * Get the value of valorPago
     */ 
    public function getValorPago()
    {
        return $this->valorPago;
    }

    /**
     * Set the value of valorPago
     *
     * @return  self
     */ 
    public function setValorPago($valorPago)
    {
        $this->valorPago = $valorPago;

        return $this;
    }




    public function getHistorialPaciente(){
        $query = "SELECT * FROM historialPacientes WHERE idClienteConsulta = '{$this->getId()}' ORDER BY fechaConsulta desc";
        $historia = $this->db->query($query);
        
        if($historia && $historia->num_rows >= 1){
            return($historia);
        }else{
            return "sin Datos";
        }
    }

    public function getPaciente(){
        $consulta = "SELECT c.idCliente,c.nombreCliente,c.apPatCliente,c.apMatCliente,c.nombreRecomiendaCliente,c.estaturaCliente
                     FROM cliente c WHERE c.idCliente = '{$this->getId()}'";
        $query = $this->db->query($consulta);

        if($query && $query->num_rows == 1){
            $paciente = $query->fetch_object();
            return $paciente;
        }
    }

    public function updatePaciente(){
        $update = "UPDATE cliente 
        SET estaturaCliente = '{$this->getEstatura()}',
             cobroCliente = '{$this->getCobro()}',
             observacionCleinte = '{$this->getObser()}',
             statusCliente = 2
        WHERE idCliente = '{$this->getId()}'";
        $query = $this->db->query($update);
         $upPac = false;
         if($query){
             $upPac = true;
         }
         return $upPac;
         
    }

    public function insertConsulta(){
       $query = "INSERT INTO consulta
	(idClienteConsulta, idUsuarioConsulta, idConsultorio, fechaConsulta, pesoClienteConsulta, medida1Consulta, medida2Consulta, medida3Consulta, 
    medida4Consulta, aparotoConsulta, pesoPerConsulta, titlepesoConsulta, medicamentoConsulta, mesopiaConsulta, conConsulta, promConsulta, obseConsulta, 
    montoEfectivoConsulta, tarjetaConsutla, statusConsuta)
	VALUES ('{$this->getId()}', '{$this->getDoctor()}', '{$this->getConsultorio()}', '{$this->getFechaConsulta()}', '{$this->getPesoActual()}', 
        '{$this->getMedida1()}', '{$this->getMedida2()}', '{$this->getMedida3()}', '{$this->getMedida4()}', '{$this->getAparato()}', '{$this->getPesoPerdido()}', 
        '{$this->getTituloPeso()}', '{$this->getMedicina()}', '{$this->getMesoterapia()}', '{$this->getConcentrado()}', '{$this->getPromocion()}', '{$this->getObser()}', 
        '{$this->getEfectivo()}', '{$this->getTarjeta()}', 1)";
    $insert= $this->db->query($query);

    $Consluta = false;
        if($insert){
            $Consluta = true;
        }    
        return $Consluta;
    }

    public function insertGasto(){
        $gasto = "INSERT INTO gastos
        (idUsuarioGastos, idConsultorioGastos, cantidadGastos, descripcionGastos, fechaGasto)
        VALUES ('{$this->getId()}', '{$this->getConsultorio()}', '{$this->getValorPago()}', '{$this->getMotivo()}', '{$this->getFechaConsulta()}')";
        $insert = $this->db->query($gasto);
        $gastoBool = false;
        if($insert){
            $gastoBool = true;
        }

        return $gastoBool;
    }
}