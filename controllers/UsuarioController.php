<!-- File: /controllers/UsuarioController.php -->
    
<?php
    require_once '/controllers/AppController.php';
    require_once '/DAO/UsuarioDAO.php';
    require_once '/DAO/RedDAO.php';
    require_once '/DAO/DependenciaDAO.php';
    require_once '/DAO/RolDAO.php';
    
    class UsuarioController implements AppController {
        
        public static function UsuarioAction() {
            UsuarioController::ListaAction();
        }
        
        public static function ListaAction() {
            $vwUsuarios = UsuarioDAO::getVwUsuario();
            require_once '/views/Mantenimiento/Usuario/Lista.php';
        }
        
        public static function CrearAction() {
            $nextID = UsuarioDAO::getNextID();
            $redes = RedDAO::getAll();
            $dependencias = DependenciaDAO::getAll();
            require_once '/views/Mantenimiento/Usuario/Crear.php';
        }
        
        public static function CrearPOSTAction() {
            if(isset($_POST)) {
                $usuario = new Usuario();
                $usuario->setIdUsuario($_POST['idUsuario']);
                $usuario->setIdDependencia($_POST['idDependencia']);
                $usuario->setNombres($_POST['nombres']);
                $usuario->setApellidoPaterno($_POST['apellidoPaterno']);
                $usuario->setApellidoMaterno($_POST['apellidoMaterno']);
                $usuario->setCorreo($_POST['correo']);
                $usuario->setRpm($_POST['rpm']);
                $usuario->setAnexo($_POST['anexo']);
                UsuarioDAO::crear($usuario) ?
                    $mensaje = "Usuario guardado correctamente" :
                    $mensaje = "El Usuario no fue guardado correctamente";
                    
            }
            $vwUsuarios = UsuarioDAO::getVwUsuario();
            require_once '/views/Mantenimiento/Usuario/Lista.php';
        }
        
        public static function DetalleAction() {
            if(isset($_GET['idUsuario'])) {
                $usuario = current(UsuarioDAO::getBy("idUsuario", $_GET['idUsuario']));
                $dependencia = current(DependenciaDAO::getBy("idDependencia", $usuario->getIdDependencia()));
                $red = RedDAO::getBy("idRed", $dependencia->getIdRed());
                require_once '/views/Mantenimiento/Usuario/Detalle.php';
            }
        }
        
        public static function EditarAction() {
            if(isset($_GET['idUsuario'])) {
                $usuario = current(UsuarioDAO::getBy("idUsuario", $_GET['idUsuario']));
                $redes = current(RedDAO::getAll());
                $dependencias = DependenciaDAO::getAll();   
                require_once '/views/Mantenimiento/Usuario/Editar.php';
            }
        }
        
        public static function EditarPOSTAction() {
            if(isset($_POST)) {
                $usuario = new Usuario();
                $usuario->setIdUsuario($_POST['idUsuario']);
                $usuario->setIdDependencia($_POST['idDependencia']);
                $usuario->setNombres($_POST['nombres']);
                $usuario->setApellidoPaterno($_POST['apellidoPaterno']);
                $usuario->setApellidoMaterno($_POST['apellidoMaterno']);
                $usuario->setCorreo($_POST['correo']);
                $usuario->setRpm($_POST['rpm']);
                $usuario->setAnexo($_POST['anexo']);
                UsuarioDAO::editar($usuario) ?
                    $mensaje = "Usuario modificado correctamente" :
                    $mensaje = "El Usuario no fue modificado correctamente";
            }
            $vwUsuarios = UsuarioDAO::getVwUsuario();
            require_once '/views/Mantenimiento/Usuario/Lista.php';
        }
        
        public static function EliminarAction() {
            if(isset($_GET['idUsuario'])) {
                $usuario = current(UsuarioDAO::getBy("idUsuario", $_GET['idUsuario']));
                $dependencia = current(DependenciaDAO::getBy("idDependencia", $usuario->getIdDependencia()));
                $red = current(RedDAO::getBy("idRed", $dependencia->getIdRed()));
                require_once '/views/Mantenimiento/Usuario/Eliminar.php';
            }
        }
        
        public static function EliminarPOSTAction() {
            if(isset($_POST)) {
                $usuario = new Usuario();
                $usuario->setIdUsuario($_POST['idUsuario']);
                UsuarioDAO::eliminar($usuario) ?
                    $mensaje = "Usuario eliminado correctamente" :
                    $mensaje = "El Usuario no fue eliminado correctamente";
            }
            $vwUsuarios = UsuarioDAO::getVwUsuario();
            require_once '/views/Mantenimiento/Usuario/Lista.php';
        }
        
        public static function usuarioAJAXAction() {
            if(isset($_GET['idDependencia'])) {
                $usuarios = UsuarioDAO::getBy("idDependencia", $_GET['idDependencia']);
                echo self::usuariosToXML($usuarios);
            }   
        }
        
        private static function usuariosToXML($usuarios) {
            $xml = '<?xml version="1.0" encoding="UTF-8"?>';
            $xml .= "\n<Usuarios>\n";
            if(is_array($usuarios))
                foreach($usuarios as $usuario)
                    $xml .= $usuario->toXML() . "\n";
            $xml .= "</Usuarios>\n";
            return $xml;
        }    
    }
?>
