<!-- File: /controllers/EstablecimientoController.php -->
    
<?php
    require_once './controllers/AppController.php';
    require_once './DAO/EstablecimientoDAO.php';
    
    class EstablecimientoController implements AppController {
        
        public static function EstablecimientoAction() {
            EstablecimientoController::ListaAction();
        }
        
        public static function ListaAction() {
            if(!PermisoDAO::hasPermiso($_SESSION["usuarioActual"], "mst7")) {
                require_once "views/Home/Error_Permisos.php";
                return;
            }
            $establecimientos = EstablecimientoDAO::getAll();
            require_once './views/Mantenimiento/Establecimiento/Lista.php';
        }
        
        public static function CrearAction() {
            if(!PermisoDAO::hasPermiso($_SESSION["usuarioActual"], "mdf7")) {
                require_once "views/Home/Error_Permisos.php";
                return;
            }
            require_once './views/Mantenimiento/Establecimiento/Crear.php';
        }
                
        public static function CrearPOSTAction() {
            if(isset($_POST)) {
                $establecimiento = new Establecimiento();
                $nextID = EstablecimientoDAO::getNextID();
                $establecimiento->setIdEstablecimiento($nextID);
                $establecimiento->setDescripcion($_POST["descripcion"]);
                $establecimiento->setDireccion($_POST["direccion"]);
                $establecimiento->setNivel($_POST["nivel"]);
                $establecimiento->setTipoCAS($_POST["tipoCAS"]);
                $establecimiento->setSituacion($_POST["situacion"]);
                $establecimiento->setProvincia($_POST["provincia"]);
                $establecimiento->setDistrito($_POST["distrito"]);
                $establecimiento->setTelefono($_POST["telefono"]);
                $establecimiento->setRpm($_POST["rpm"]);
                $establecimiento->activar();
                EstablecimientoDAO::crear($establecimiento) ?
                    $mensaje = "Establecimiento guardada correctamente" :
                    $mensaje = "El Establecimiento no fue guardada correctamente";
            }
            $establecimientos = EstablecimientoDAO::getAll();
            $mensaje = "Establecimiento guardada correctamente";
            require_once './views/Mantenimiento/Establecimiento/Lista.php';
        }
        
        public static function DetalleAction() {
            if(!PermisoDAO::hasPermiso($_SESSION["usuarioActual"], "mst7")) {
                require_once "views/Home/Error_Permisos.php";
                return;
            }
            if(isset($_GET['idEstablecimiento'])) {
                $vwEstablecimiento = current(EstablecimientoDAO::getVwBy("idEstablecimiento", $_GET['idEstablecimiento']));
                require_once './views/Mantenimiento/Establecimiento/Detalle.php';
            }
        }
        
        public static function EditarAction() {
            if(!PermisoDAO::hasPermiso($_SESSION["usuarioActual"], "mdf7")) {
                require_once "views/Home/Error_Permisos.php";
                return;
            }
            if(isset($_GET['idEstablecimiento'])) {
                $establecimiento = current(EstablecimientoDAO::getBy("idEstablecimiento", $_GET['idEstablecimiento']));
                require_once './views/Mantenimiento/Establecimiento/Editar.php';
            }
        }
        
        public static function EditarPOSTAction() {
            if(isset($_POST)) {
                $establecimiento = new Establecimiento();
                $establecimiento->setIdEstablecimiento($_POST["idEstablecimiento"]);
                $establecimiento->setDescripcion($_POST["descripcion"]);
                $establecimiento->setDireccion($_POST["direccion"]);
                $establecimiento->setNivel($_POST["nivel"]);
                $establecimiento->setTipoCAS($_POST["tipoCAS"]);
                $establecimiento->setSituacion($_POST["situacion"]);
                $establecimiento->setProvincia($_POST["provincia"]);
                $establecimiento->setDistrito($_POST["distrito"]);
                $establecimiento->setTelefono($_POST["telefono"]);
                $establecimiento->setRpm($_POST["rpm"]);
                $establecimiento->activar();
                EstablecimientoDAO::editar($establecimiento) ?
                    $mensaje = "Establecimiento modificada correctamente" :
                    $mensaje = "El Establecimiento no fue modificada correctamente";
            }
            $establecimientos = EstablecimientoDAO::getAll();
            require_once './views/Mantenimiento/Establecimiento/Lista.php';
        }
        
        public static function EliminarAction() {        
            if(!PermisoDAO::hasPermiso($_SESSION["usuarioActual"], "elm7")) {
                require_once "views/Home/Error_Permisos.php";
                return;
            }
            if(isset($_GET['idEstablecimiento'])) {
                $vwEstablecimiento = current(EstablecimientoDAO::getVwBy("idEstablecimiento", $_GET['idEstablecimiento']));
                require_once './views/Mantenimiento/Establecimiento/Eliminar.php';
            }
        }
        
        public static function EliminarPOSTAction() {
            if(isset($_POST)) {
                $establecimiento = new Establecimiento();
                $establecimiento->setIdEstablecimiento($_POST['idEstablecimiento']);
                EstablecimientoDAO::eliminar($establecimiento) ?
                    $mensaje = "Establecimiento eliminada correctamente" :
                    $mensaje = "El Establecimiento no fue eliminada correctamente";
            }
            $establecimientos = EstablecimientoDAO::getAll();
            require_once './views/Mantenimiento/Establecimiento/Lista.php';
        }
    }
?>
