<?php
    require_once '/models/Marca.php';
    require_once '/Libs/BaseDatos.php';
    
    class MarcaDAO {

        public static function getAllMarca() {
            $result = BaseDatos::getDbh()->prepare("SELECT * FROM Marca WHERE estado = 1");
            $result->execute();
            while ($rs = $result->fetch()) {
                $marca = new Marca();
                $marca->setIdMarca($rs['idMarca']);
                $marca->setDescripcion($rs['descripcion']);
                $marca->setIndicacion($rs['indicacion']);
                $marcas[] = $marca; 
            }
            if(isset($marcas))
                return $marcas;
            else
                return false;
        }
        
        public static function crear(Marca $marca) {
            $result = BaseDatos::getDbh()->prepare("INSERT INTO Marca(idMarca, descripcion, indicacion, estado) values(:idMarca, :descripcion, :indicacion, :estado)");
            $result->bindParam(':idMarca', $marca->getIdMarca());
            $result->bindParam(':descripcion', $marca->getDescripcion());
            $result->bindParam(':indicacion', $marca->getIndicacion());
            $result->bindParam(':estado', $marca->getEstado());
            return $result->execute();
        }
        
        public static function editar(Marca $marca) {
            $result = BaseDatos::getDbh()->prepare("UPDATE Marca SET descripcion = :descripcion, indicacion = :indicacion, estado = :estado WHERE idMarca = :idMarca");
            $result->bindParam(':descripcion', $marca->getDescripcion());
            $result->bindParam(':indicacion', $marca->getIndicacion());
            $result->bindParam(':idMarca', $marca->getIdMarca());
            $result->bindParam(':estado', $marca->getEstado());
            return $result->execute();
        }
        
        public static function eliminar(Marca $marca) {
            $result = BaseDatos::getDbh()->prepare("UPDATE Marca SET estado = 2 WHERE idMarca = :idMarca");
            $result->bindParam(':idMarca', $marca->getIdMarca());
            return $result->execute();
        }
        
        public static function getMarcaByIdMarca($idMarca) {
            $result = BaseDatos::getDbh()->prepare("SELECT * FROM Marca where idMarca = :idMarca");
            $result->bindParam(':idMarca', $idMarca);
            $result->execute();
            $rs = $result->fetch();
            $marca = new Marca();
            $marca->setIdMarca($rs['idMarca']);
            $marca->setDescripcion($rs['descripcion']);
            $marca->setIndicacion($rs['indicacion']);
            return $marca;
        }
        
        public static function getNextID() {
            $result = BaseDatos::getDbh()->prepare("call usp_GetNextIdMarca");
            $result->execute();
            $rs = $result->fetch();
            $n = $rs['nextID'] + 1;
            if($n < 10) 
                return 'M000' . $n;
            elseif ($n < 100)
                return 'M00' . $n;
            elseif ($n < 1000)
                return 'M0' . $n;
            else
                return 'M' . $n;
        }
        
        public static function getVwMarca() {
            $result = BaseDatos::getDbh()->prepare("SELECT * FROM vw_Marca");
            $result->execute();
            return $result;
        }      
        
        public static function getVwMarcaLimit($limite) {
            $result = BaseDatos::getDbh()->prepare("SELECT * FROM vw_Marca LIMIT 0, :limite");
            $result->bindValue(':limite', (int) trim($limite), PDO::PARAM_INT);
            $result->execute();
            return $result;
        }
    }
?>
