<?php
require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/config/modeloBase.php";
// require_once $_SERVER['DOCUMENT_ROOT']."/config/modeloBase.php";


class AvanzadoModels extends ModeloBase{
    private $id;
    private $email;
    private $pass;
    private $date1;
    private $date2;

    
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
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 

         /**
     * Get the value of pass
     */ 
    public function getPass()
    {
        //return $this->pass;
        return password_hash($this->db->real_escape_string($this->pass), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    /**
     * Set the value of pass
     *
     * @return  self
     */ 
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
    public function __construct() {
        parent::__construct();
    }
    /**
     * Get the value of date1
     */ 
    public function getDate1()
    {
        return $this->date1;
    }

    /**
     * Set the value of date1
     *
     * @return  self
     */ 
    public function setDate1($date1)
    {
        $this->date1 = $date1;

        return $this;
    }

    /**
     * Get the value of date2
     */ 
    public function getDate2()
    {
        return $this->date2;
    }

    /**
     * Set the value of date2
     *
     * @return  self
     */ 
    public function setDate2($date2)
    {
        $this->date2 = $date2;

        return $this;
    }

    public function getDoctor(){
        $result = false;
        $password = $this->pass;
        $get = "SELECT * FROM usuario ud WHERE ud.correoUsuario = '{$this->getEmail()}'";
        $qiery = $this->db->query($get);
        if($qiery && $qiery->num_rows == 1){
            $Usurario = $qiery->fetch_object();

            // verifica contraseña
            $verify = password_verify($password, $Usurario->passwordUsuario);

            if($verify){
                $result = $Usurario;
            }
        }
        return $result;
    }

    public function getConsultorio(){
        $con = "SELECT c.id_consultorio,c.nombreConsultorio FROM consultorio c WHERE c.id_consultorio = '{$this->getId()}'";
        $query = $this->db->query($con);
    
        if($query && $query->num_rows == 1){
            $consultorio = $query->fetch_object();
            return $consultorio;
        }
    }

    public function listaCon(){
        $query = "SELECT * FROM  listaConsultorio";
        $lista = $this->db->query($query);

        if($lista && $lista->num_rows>=1){
            return $lista;
        }else{
            return "vacio";
        }
    }

    public function reportGl(){
        $query = "SELECT 
                        consulta.idConsultorio, 
                        consultorio.nombreConsultorio, 
                        COUNT(consulta.idConsulta) AS totalPaciente, 
                        SUM(consulta.montoEfectivoConsulta)AS efectivo, 
                        SUM(consulta.tarjetaConsutla) AS tarjeta,
                        (SUM(consulta.montoEfectivoConsulta)+SUM(consulta.tarjetaConsutla)) AS total,
                        ifnull(gt.suma,0) AS gastoTotal,
                        ((SUM(consulta.montoEfectivoConsulta)+SUM(consulta.tarjetaConsutla))-ifnull(gt.suma,0)) AS queda
                FROM consulta 
                INNER JOIN consultorio 
                ON consultorio.id_consultorio = consulta.idConsultorio
                LEFT JOIN 
                        (SELECT gastos.idConsultorioGastos,SUM(gastos.cantidadGastos) AS suma
                        FROM gastos
                        GROUP BY gastos.idConsultorioGastos ) gt
                ON consultorio.id_consultorio = gt.idConsultorioGastos
                where 
                cast(consulta.fechaConsulta AS date)  BETWEEN '{$this->getDate1()}' AND '{$this->getDate2()}'
                GROUP BY consulta.idConsultorio";
       $registro = $this->db->query($query);
       if($registro && $registro->num_rows>=1){
           return $registro;
       }else{
           return 0;
       }
    }

    
    public function gastos(){
        $gasto = "SELECT 
        gastos.idConsultorioGastos,
        SUM(gastos.cantidadGastos) 
        FROM gastos 
        WHERE 
         cast(gastos.fechaGasto AS DATE) BETWEEN '{$this->getDate1()}' AND '{$this->getDate2()}'
        GROUP BY gastos.idConsultorioGastos";

        $gastos = $this->db->query($gasto);
        if($gastos){
            return $gastos;
        }else{
            return 0; 
        }
    }





 
}
