<?php
    require_once '/DAO/RolDAO.php';
    require_once '/DAO/PermisoDAO.php';
    
    class RolController {
        public static function RolAction() {
            $roles = RolDAO::getAllRol();
            require_once '/views/Mantenimiento/Rol/Lista.php';
        }
        
        public static function CrearAction() {
            $nextID = RolDAO::getNextID();
            require_once '/views/Mantenimiento/Rol/Crear.php';
        }
        
        public static function CrearPOSTAction() {
            if(isset($_POST)) {
                $rol = new Rol();
                $rol->setIdRol($_POST['idRol']);
                $rol->setDescripcion($_POST['descripcion']);
                RolDAO::crear($rol);
                foreach($_POST as $key => $value) {
                    if($value == 'on' && substr($key, 0, 2) != 'ct') {
                        $permiso = new Permiso();
                        $permiso->setIdRol($rol->getIdRol());
                        $permiso->setDescripcion($key);
                        PermisoDAO::crear($permiso);
                    }
                }
            }
            $roles = RolDAO::getAllRol();
            $mensaje = "Rol guardado correctamente";
            require_once '/views/Mantenimiento/Rol/Lista.php';
        }
        
        public static function DetalleAction() {
            if(isset($_GET['idRol'])) {
                $rol = RolDAO::getRolByIdRol($_GET['idRol']);
                $permisos = PermisoDAO::getUspPermisos($_GET['idRol']);
                require_once '/views/Mantenimiento/Rol/Detalle.php';
            }
        }
        
        public static function EditarAction() {
            $rol = RolDAO::getRolByIdRol($_GET['idRol']);
            $permisos = PermisoDAO::getPermisobyIdRol($_GET['idRol']);
            $permisos = self::permisosToXML($permisos);
            $a = 'aaa';
            require_once '/views/Mantenimiento/Rol/Editar.php';
        }            
        
        private static function permisosToXML($permisos) {
            $xml = '<?xml version="1.0" encoding="UTF-8"?>';
            $xml .= "\n<Permisos>\n";
            if(is_array($permisos))
                foreach($permisos as $permiso)
                    $xml .= $permiso->toXML() . "\n";
            $xml .= "</Permisos>\n";
            return $xml;
        }    
    }
?>
