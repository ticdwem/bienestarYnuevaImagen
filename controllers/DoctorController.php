<?php
require_once $_SERVER['DOCUMENT_ROOT']."/bienestarYnuevaImagen/models/doctorModels.php";
// require_once $_SERVER['DOCUMENT_ROOT']."/models/consultorioModels.php";
class DoctorController{
    public function __construct()
    {
        /* validamos si extiste a sesison */
        if(!isset($_SESSION['usuario'])){Utls::sinSession();}
    }
    /*este es una clase de prueba para saber que todo esta bien relacionado */
    public function index(){
        require_once 'views/doctor/altaDoctor.php';
    }
    
    /*vista de registro del usuario*/
    public function listar(){
        $lista = new ModeloBase();
        $doctores = $lista->getAllWhere("usuario","WHERE tipoUsuario <> 1");
        require_once 'views/doctor/listarDoctor.php';
    }
    /*funcion para guardar el usuario*/
    public function save() {
        if(isset($_POST)){           
            Utls::deleteSession('formulario');
            $Nombre = (Validacion::pregmatchletras($_POST["intputname"]) == '0') ? false : $_POST["intputname"] ;
            $Apellido_Pat = (Validacion::pregmatchletras($_POST["inputAppat"]) == '0') ? false : $_POST["inputAppat"] ;
            $Apellido_Mat = (Validacion::pregmatchletras($_POST["inputApmat"]) == '0') ? false : $_POST["inputApmat"] ;
            $sexo = (!isset($_POST["customRadioSexo"]) || Validacion::pregmatchletras($_POST["inputApmat"]) == '0') ? false : $_POST["customRadioSexo"] ;
            $correo = (Validacion::validarEmail($_POST["inpuCorreo"]) == '0') ? false : $_POST["inpuCorreo"] ;
            $select = (Validacion::validarSelect($_POST["tipoUser"]) == '-1') ? false : $_POST["tipoUser"] ;
            $doctores = array('Nombre' => $Nombre ,'Apellido_Pat' => $Apellido_Pat ,'Apellido_Mat' => $Apellido_Mat ,'sexo' => $sexo ,'correo' => $correo,'Tipo Usuario'=>$select);

            foreach($doctores as $datos=>$index){
                if($index == false){
                    $_SESSION['formulario_doctor'] = array(
                        "error"=> 'El campo '.$datos." es Incorrecto, Llena los campos faltantes",
                        "datos"=>$doctores
                    );
                break;
                }
            }

            if(isset($_SESSION["formulario_doctor"])){
                echo '<script>window.location="'.base_url.'Doctor/index"</script>';
            }else{
                foreach($_POST['check'] as $menu){
                    $idMenu = (Validacion::validarNumero($menu) == -1) ? false : $menu ;
                     if($idMenu == false){
                         $_SESSION['formulario_doctor'] = array(
                             "error"=> 'HAY UN ELEMENTO QUE NO CORRESPONDE VERIFICA POR FAVOR',
                             "datos"=>$doctores
                         );
                     break;
                     }
                }
                if(isset($_SESSION["formulario_doctor"])){
                    echo '<script>window.location="'.base_url.'Doctor/index"</script>';
                }else{
                     $alta =new Doctor();
                     $alta->setNombre($Nombre);
                     $alta->setApellidoP($Apellido_Pat);
                     $alta->setApellidoM($Apellido_Mat);
                     $alta->setSexo($sexo);
                     $alta->setCorreo($correo);
                     $alta->setTipoUser($select);
                     $insert = $alta->insertDoctor();    
                      if($insert){
                          //var_dump($insert->iduser);
                         $sm = new Doctor();
                         $sm->setidUsuario($insert->iduser);
                         $sm->setidsubmenu($_POST['check']);
                         $insertMenu = $sm->insertMenu();
                        if($insertMenu){
                           $_SESSION['statusSave'] = "SE HA REGISTRADO EXITOSAMENTE";
                           echo '<script>window.location="'.base_url.'Doctor/index"</script>';
                        }else{
                            $_SESSION['formulario_doctor'] = array(
                                "error"=> "NO SE ASIGNARON CORRECTAMENTE EL MENU LLAMA A TU ADMINSTRADOR PARA REASIGNARLOS",
                                "datos"=>$doctores
                            ); 
                        }
                        
                      }else{
                          $_SESSION['formulario_doctor'] = array(
                              "error"=> "NO SE INSERTO CORRECTAMENTE, INTENTE DE NUEVO O LLAME A SU ADMINISTRADOR",
                              "datos"=>$doctores
                          ); 
                      }
                }
            }
        } 
    }

    public function editar(){
        $id = "";$idDoctor = "";$tipoUser = "";$menuPersonal = array();$status="";
        if(isset($_GET['id'])){
            $id = SED::decryption($_GET["id"]);
            $idDoctor = (Validacion::validarNumero($id) == -1) ? false : $id ;
            if($idDoctor){
                $especifico = new ModeloBase();
                $doctor = $especifico->getAllWhere("usuarioCompleto","WHERE idUsuario =". $idDoctor);
                $datos = $doctor->fetch_object();
                switch ($datos->tipoUsuario) {
                    case '2':
                        $tipoUser = "Doctor";
                        break;
                    case '3':
                        $tipoUser = "Administrador";
                        break;
                    
                    default:
                        $tipoUser = "Tipo Usuriario";
                        break;
                }
                switch($datos->statusUusario){
                    case '1':
                        $status="Activo";
                    break;
                    case '2':
                        $status="Vacaciones";
                    break;
                    case '3':
                        $status ="Baja";
                    break;
                    default:
                        $status="Status";
                break;
                }

                $menu = new ModeloBase();
                $getMenu = $menu->getAllWhere("usuarioMenu","WHERE usuarioMenu.idUsuario =".$idDoctor);
                while ($check = $getMenu->fetch_object()) {
                    $menuPersonal[]= $check->idSubmenu;
                }
                require_once 'views/doctor/editarDoctor.php';
            }else{
                require_once 'views/error/error404.php';
            }
            
        }else{
            require_once 'views/error/error404.php';

        }
    }

    public function updateDatos() {
        if(isset($_POST)){           
            Utls::deleteSession('formulario');
            $id = SED::decryption($_POST["idDoc"]);
            $idDoctor = (Validacion::validarNumero($id) == -1) ? false : $id ;
            $Nombre = (Validacion::pregmatchletras($_POST["intputname"]) == '0') ? false : $_POST["intputname"] ;
            $Apellido_Pat = (Validacion::pregmatchletras($_POST["inputAppat"]) == '0') ? false : $_POST["inputAppat"] ;
            $Apellido_Mat = (Validacion::pregmatchletras($_POST["inputApmat"]) == '0') ? false : $_POST["inputApmat"] ;
            $sexo = (!isset($_POST["customRadioSexo"]) || Validacion::pregmatchletras($_POST["inputApmat"]) == '0') ? false : $_POST["customRadioSexo"] ;
            $correo = (Validacion::validarEmail($_POST["inpuCorreo"]) == '0') ? false : $_POST["inpuCorreo"] ;
            $select = (Validacion::validarSelect($_POST["tipoUser"]) == '-1') ? false : $_POST["tipoUser"] ;
            $status = (Validacion::validarNumero($_POST["statusUSer"]) == '-1') ? false : $_POST["statusUSer"] ;
            $doctores = array('id'=>$idDoctor,'Nombre' => $Nombre ,'Apellido_Pat' => $Apellido_Pat ,'Apellido_Mat' => $Apellido_Mat ,'sexo' => $sexo ,'correo' => $correo,'Tipo Usuario'=>$select,'status'=>$status);

            foreach($doctores as $datos=>$index){
                if($index == false){
                    $_SESSION['formulario_doctor'] = array(
                        "error"=> 'El campo '.$datos." es Incorrecto, Llena los campos faltantes",
                        "datos"=>$doctores
                    );
                break;
                }
            }

            if(isset($_SESSION["formulario_doctor"])){
                echo '<script>window.location="'.base_url.'Doctor/index"</script>';
            }else{
                foreach($_POST['check'] as $menUpdate){

                    $idMenUpdate = (Validacion::validarNumero($menUpdate) == -1) ? false : $menUpdate ;
                     if($idMenUpdate == false){
                         $_SESSION['formulario_doctor'] = array(
                             "error"=> 'HAY UN ELEMENTO QUE NO CORRESPONDE VERIFICA POR FAVOR',
                             "datos"=>$doctores
                         );
                     break;
                     }
                }
                if(isset($_SESSION["formulario_doctor"])){
                    echo '<script>window.location="'.base_url.'Doctor/index"</script>';
                }else{
                     $actualizar =new Doctor();
                     $actualizar->setNombre($Nombre);
                     $actualizar->setApellidoP($Apellido_Pat);
                     $actualizar->setApellidoM($Apellido_Mat);
                     $actualizar->setSexo($sexo);
                     $actualizar->setCorreo($correo);
                     $actualizar->setTipoUser($select);
                     $actualizar->setStatusUser($status);
                     $Update = $actualizar->updateDoctor();    
                      if($Update){
                        $delete = new ModeloBase();
                        $borrar= $delete->deleteTable('usuarioMenu','usuarioMenu.idUsuario',$id);
                        if($borrar){
                            $sm = new Doctor();
                            $sm->setidUsuario($id);
                            $sm->setidsubmenu($_POST['check']);
                            $insertMenu = $sm->insertMenu();
                            if($insertMenu){
                            $_SESSION['statusSave'] = "SE HA REGISTRADO EXITOSAMENTE";
                            echo '<script>window.location="'.base_url.'Doctor/index"</script>';
                            }else{
                                $_SESSION['formulario_doctor'] = array(
                                    "error"=> "NO SE ASIGNARON CORRECTAMENTE EL MENU LLAMA A TU ADMINSTRADOR PARA REASIGNARLOS",
                                    "datos"=>$doctores
                                ); 
                            }
                        }
                        
                      }else{
                          $_SESSION['formulario_doctor'] = array(
                              "error"=> "NO SE INSERTO CORRECTAMENTE, INTENTE DE NUEVO O LLAME A SU ADMINISTRADOR",
                              "datos"=>$doctores
                          ); 
                      }
                }
            }
        } 
    }
}
