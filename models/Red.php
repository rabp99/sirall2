<?php
    require_once '/models/AppModel.php';
    /*
     * Clase Red
     */
    class Red implements AppModel {
        private $idRed;
        private $descripcion;
        private $direccion;
        private $telefono;
        private $estado;
        
        public function __construct($idRed = "", $descripcion = "", $direccion = "", $telefono = "", $estado = 1) {
            $this->idRed = $idRed;
            $this->descripcion = $descripcion;
            $this->direccion = $direccion;
            $this->telefono = $telefono;
            $this->estado = $estado;
        }
        
        public function setIdRed($idRed) {
            $this->idRed = $idRed;
        }
                
        public function getIdRed() {
            return $this->idRed;
        }
        
        public function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }
               
        public function getDescripcion() {
            return $this->descripcion;
        }
        
        public function setDireccion($direccion) {
            $this->direccion = $direccion;
        }
        
        public function getDireccion() {
            return $this->direccion;
        }
        
        public function setTelefono($telefono) {
            $this->telefono = $telefono;
        }
        
        public function getTelefono() {
            return $this->telefono;
        }
        
        public function setEstado($estado) {
            $this->estado = $estado;
        }
                       
        public function getEstado() {
            return $this->estado;
        }
        
        public function toArray() {
            return get_object_vars($this);
        }       
        
        public function toXML() {
            $clase = get_class($this);
            $atributos = $this->toArray();
            $xml = "<$clase>\n";
            foreach ($atributos as $nombre => $valor) {
                $xml .= "\t<$nombre>" . $valor . "</$nombre>\n";
            }
            $xml = $xml . "</$clase>";
            return $xml;
        }
        
        public function toJSON() {
            return json_encode($this->toArray(), JSON_HEX_TAG );
        }
        
        public function toString() {
            $clase = get_class($this);
            $atributos = $this->toArray();
            $string = "$clase {";
            foreach ($atributos as $nombre => $valor) {
                $string .= "($nombre => $valor) " ;
            }
            $string .= "}";
            return $string;
        }
        
        /*
         * Activa a un Técnico
         */
        public function activar() {
            if($this->get('Estado') == 1)
                return false;
            else {
                $this->set('Estado', 1);
                return true;
            }
        }
        
        /*
         * Desactiva a un técnico
         */
        public function desactivar() {
            if($this->get('Estado') == 2)
                return false;
            else {
                $this->set('Estado', 2);
                return true;
            }
        }
        
    }
?>
