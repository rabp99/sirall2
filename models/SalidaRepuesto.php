<!-- File: /models/SalidaRepuesto.php -->

<?php
    require_once '/models/AppModel.php';
    /*
     * Clase Salida de repuestos
     */
    class SalidaRepuesto implements AppModel {
        private $idSalidaRepuesto;
        private $idRepuesto;
        private $cantidad;
        private $fecha;
        private $observacion;
        
        public function __construct($idSalidaRepuesto = 0, $idRepuesto = "", $cantidad = 0, $fecha = "", $observacion = "" ) {
            $this->idSalidaRepuesto = $idSalidaRepuesto;
            $this->idRepuesto = $idRepuesto;
            $this->cantidad = $cantidad;
            $this->fecha = $fecha;
            $this->observacion = $observacion;
        }
        
        // <editor-fold defaultstate="collapsed" desc="Sets y Gets">
 
        public function setIdSalidaRepuesto($idSalidaRepuesto) {
            $this->idSalidaRepuesto = $idSalidaRepuesto;
        }
              
        public function getIdSalidaRepuesto() {
            return $this->idSalidaRepuesto;
        }
        
        public function setIdRepuesto($idRepuesto) {
            $this->idRepuesto = $idRepuesto;
        }
        
        public function getIdRepuesto() {
            return $this->idRepuesto;
        }
        
        public function setCantidad($cantidad) {
            $this->cantidad = $cantidad;
        }
        
        public function getCantidad() {
            return $this->cantidad;
        }
        
        public function setFecha($fecha) {
            $this->fecha = $fecha;
        }
        
        public function getFecha() {
            return $this->fecha;
        }
        
        public function setObservacion($observacion) {
            $this->observacion = $observacion;
        }    
        
        public function getObservacion() {
            return $this->observacion;
        }
                        
        // </editor-fold>
       
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
    }
?>
