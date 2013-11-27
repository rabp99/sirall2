<!-- File: /controllers/ModeloController.php -->

<?php
    require_once '/controllers/AppController.php';
    require_once '/DAO/ModeloDAO.php';
    require_once '/DAO/TipoEquipoDAO.php';
    require_once '/DAO/MarcaDAO.php';
    
    class ModeloController implements AppController {
        
        public static function ModeloAction() {
            ModeloController::ListaAction();
        }
        
        public static function ListaAction() {
            $vwModelos = ModeloDAO::getVwModelo();
            require_once '/views/Mantenimiento/Modelo/Lista.php';
        }

        public static function CrearAction() {
            $nextID = ModeloDAO::getNextID();
            $tipoEquipos = TipoEquipoDAO::getAll();
            $marcas = MarcaDAO::getAll();
            $vwTipoEquipos = TipoEquipoDAO::getVwTipoEquipo();
            $vwMarcas = MarcaDAO::getVwMarca();
            require_once '/views/Mantenimiento/Modelo/Crear.php';
        }
                
        public static function CrearPOSTAction() {
            if(isset($_POST)) {
                $modelo = new Modelo();
                $modelo->setIdModelo($_POST['idModelo']);
                $modelo->setIdTipoEquipo($_POST['idTipoEquipo']);
                $modelo->setIdMarca($_POST['idMarca']);
                $modelo->setDescripcion($_POST['descripcion']);
                $modelo->setIndicacion($_POST['indicacion']);
                ModeloDAO::crear($modelo) ?
                    $mensaje = "Modelo guardado correctamente" :
                    $mensaje = "El Modelo no fue guardado correctamente";
            }
            $vwModelos = ModeloDAO::getVwModelo();
            require_once '/views/Mantenimiento/Modelo/Lista.php';
        }
        
        public static function DetalleAction() {
            if(isset($_GET['idModelo'])) {
                $modelo = current(ModeloDAO::getBy("idModelo", $_GET['idModelo']));
                $tipoEquipo = current(TipoEquipoDAO::getBy("idTipoEquipo", $modelo->getIdTipoEquipo()));
                $marca = current(MarcaDAO::getBy("idMarca", $modelo->getIdMarca()));
                require_once '/views/Mantenimiento/Modelo/Detalle.php';
            }
        }
        
        public static function EditarAction() {
            if(isset($_GET['idModelo'])) {
                $modelo = current(ModeloDAO::getBy("idModelo", $_GET['idModelo']));
                $tipoEquipo = current(TipoEquipoDAO::getBy("idTipoEquipo", $modelo->getIdTipoEquipo()));
                $marca = current(MarcaDAO::getBy("idMarca", $modelo->getIdMarca()));
                $tipoEquipos = TipoEquipoDAO::getAll();
                $marcas = MarcaDAO::getAll();
                $vwTipoEquipos = TipoEquipoDAO::getVwTipoEquipo();
                $vwMarcas = MarcaDAO::getVwMarca();
                require_once '/views/Mantenimiento/Modelo/Editar.php';
            }
        }
        
        public static function EditarPOSTAction() {
            if(isset($_POST)) {
                $modelo = new Modelo();
                $modelo->setIdModelo($_POST['idModelo']);
                $modelo->setIdTipoEquipo($_POST['idTipoEquipo']);
                $modelo->setIdMarca($_POST['idMarca']);
                $modelo->setDescripcion($_POST['descripcion']);
                $modelo->setIndicacion($_POST['indicacion']);
                $modelo->setEstado(1);
                ModeloDAO::editar($modelo) ?
                    $mensaje = "Modelo modificado correctamente" :
                    $mensaje = "El Modelo no fue modificado correctamente";
                        
            }
            $vwModelos = ModeloDAO::getVwModelo();
            require_once '/views/Mantenimiento/Modelo/Lista.php';
        }
        
        public static function EliminarAction() {
            if(isset($_GET['idModelo'])) {
                $modelo = current(ModeloDAO::getBy("idModelo", $_GET['idModelo']));
                $tipoEquipo = current(TipoEquipoDAO::getBy("idTipoEquipo", $modelo->getIdTipoEquipo()));
                $marca = current(MarcaDAO::getBy("idMarca", $modelo->getIdMarca()));
                require_once '/views/Mantenimiento/Modelo/Eliminar.php';
            }
        }
        
        public static function EliminarPOSTAction() {
            if(isset($_POST)) {
                $modelo = new Modelo();
                $modelo->setIdModelo($_POST['idModelo']);
                ModeloDAO::eliminar($modelo) ?
                    $mensaje = "Modelo eliminado correctamente" :
                    $mensaje = "El Modelo no fue eliminado correctamente";
            }
            $vwModelos = ModeloDAO::getVwModelo();
            require_once '/views/Mantenimiento/Modelo/Lista.php';
        }
                
        public static function modeloAJAXAction() {
            if(isset($_GET['idMarca']) && isset($_GET['idTipoEquipo'])) {
                $modelos = ModeloDAO::getModeloByIdMarca_IdTipoEquipo($_GET['idMarca'], $_GET['idTipoEquipo']);
                echo self::modelosToXML($modelos);
            }
        }
        
        private static function modelosToXML($modelos) {
            $xml = '<?xml version="1.0" encoding="UTF-8"?>';
            $xml .= "\n<Modelos>\n";
            if(is_array($modelos))
                foreach($modelos as $modelo)
                    $xml .= $modelo->toXML() . "\n";
            $xml .= "</Modelos>\n";
            return $xml;
        }
    }
?>
