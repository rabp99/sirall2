<!-- File: /controllers/MarcaController.php -->

<?php
    require_once './controllers/AppController.php';
    require_once './DAO/MarcaDAO.php';
    
    class MarcaController implements AppController {
        
        public static function MarcaAction() {
            MarcaController::ListaAction();
        }
        
        public static function ListaAction() {
            if(!PermisoDAO::hasPermiso($_SESSION["usuarioActual"], "mst3")) {
                require_once "views/Home/Error_Permisos.php";
                return;
            }
            $vwMarcas = MarcaDAO::getVwMarca();
            require_once './views/Mantenimiento/Marca/Lista.php';
        }
        
        public static function CrearAction() {
            if(!PermisoDAO::hasPermiso($_SESSION["usuarioActual"], "mdf3")) {
                require_once "views/Home/Error_Permisos.php";
                return;
            }
            $nextID = MarcaDAO::getNextID();
            require_once './views/Mantenimiento/Marca/Crear.php';
        }
                
        public static function CrearPOSTAction() {
            if(isset($_POST)) {
                $marca = new Marca();
                $marca->setIdMarca($_POST['idMarca']);
                $marca->setDescripcion($_POST['descripcion']);
                $marca->setIndicacion($_POST['indicacion']);
                $marca->setEstado(1);
                MarcaDAO::crear($marca) ? 
                    $mensaje = "Marca guardada correctamente" : 
                    $mensaje = "La Marca no fue guardada correctamente";
            }
            $vwMarcas = MarcaDAO::getVwMarca();
            require_once './views/Mantenimiento/Marca/Lista.php';
        }
        
        public static function DetalleAction() {
            if(!PermisoDAO::hasPermiso($_SESSION["usuarioActual"], "mst3")) {
                require_once "views/Home/Error_Permisos.php";
                return;
            }
            if(isset($_GET['idMarca'])) {
                $marca = current(MarcaDAO::getBy("idMarca", $_GET['idMarca']));
                require_once './views/Mantenimiento/Marca/Detalle.php';
            }
        }
        
        public static function EditarAction() {
            if(!PermisoDAO::hasPermiso($_SESSION["usuarioActual"], "mdf3")) {
                require_once "views/Home/Error_Permisos.php";
                return;
            }
            if(isset($_GET['idMarca'])) {
                $marca = current(MarcaDAO::getBy("idMarca", $_GET['idMarca']));
                require_once './views/Mantenimiento/Marca/Editar.php';
            }
        }
        
        public static function EditarPOSTAction() {
            if(isset($_POST)) {
                $marca = new Marca();
                $marca->setIdMarca($_POST['idMarca']);
                $marca->setDescripcion($_POST['descripcion']);
                $marca->setIndicacion($_POST['indicacion']);
                $marca->setEstado(1);
                MarcaDAO::editar($marca) ?
                    $mensaje = "Marca modificada correctamente" :
                    $mensaje = "La Marca no fue modificada correctamente";
            }
            $vwMarcas = MarcaDAO::getVwMarca();
            require_once './views/Mantenimiento/Marca/Lista.php';
        }
        
        public static function EliminarAction() {
            if(!PermisoDAO::hasPermiso($_SESSION["usuarioActual"], "elm3")) {
                require_once "views/Home/Error_Permisos.php";
                return;
            }
            if(isset($_GET['idMarca'])) {
                $marca = current(MarcaDAO::getBy("idMarca", $_GET['idMarca']));
                require_once './views/Mantenimiento/Marca/Eliminar.php';
            }
        }
        
        public static function EliminarPOSTAction() {
            if(isset($_POST)) {
                $marca = new Marca();
                $marca->setIdMarca($_POST['idMarca']);
                MarcaDAO::eliminar($marca) ?
                    $mensaje = "Marca eliminada correctamente" :
                    $mensaje = "La Marca no fue eliminada correctamente";
            }
            $vwMarcas = MarcaDAO::getVwMarca();
            require_once './views/Mantenimiento/Marca/Lista.php';
        }
    }
?>
