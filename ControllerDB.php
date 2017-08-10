<?php
/* 
 * Istvan Lucario
 */
class ControllerDB {
    
    protected $mysqli;
    const LOCALHOST = 'localhost';
    const USER = 'root';
    const PASSWORD = '';
    const DATABASE = 'techocars';
    
    /**
     * Constructor de clase
     */
    public function __construct() {           
        try{
            //conexión a base de datos
            $this->mysqli = new mysqli(self::LOCALHOST, self::USER, self::PASSWORD, self::DATABASE);
// Check connection
if ($this->mysqli->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";
        }catch (mysqli_sql_exception $e){
            //Si no se puede realizar la conexión
            http_response_code(500);
            exit;
        }     
    } 
        /**
     * obtiene un solo registro dado su ID
     * @param int $id identificador unico de registro
     * @return Array array con los registros obtenidos de la base de datos
     */
    public function getCatalogo($id=0){
        $result="";
       if($id==1){
        $result = $this->mysqli->query("SELECT * from fabrica ORDER BY id DESC;");
        }
      else  if($id==2){
        $result = $this->mysqli->query("SELECT * from modelo ORDER BY id DESC;");
        }
       else if($id==3){
        $result = $this->mysqli->query("SELECT * from anio ORDER BY id DESC;");
        }
       else if($id==4){
        $result = $this->mysqli->query("SELECT * from motor ORDER BY id DESC;");
        }
       else if($id==5){
        $result = $this->mysqli->query("SELECT * from color ORDER BY id DESC;");
        }
       else if($id==6){
        $result = $this->mysqli->query("SELECT * from tipo ORDER BY id DESC;");
        }
        else{
            return "[{'error':'catalogo no existente'}]";  
            
        }
        $vehiculos = $result->fetch_all(MYSQLI_ASSOC);          
        $result->close();
        return $vehiculos;  
    }
     /**
     * obtiene un solo registro dado su ID
     * @param int $id identificador unico de registro
     * @return Array array con los registros obtenidos de la base de datos
     */
    public function getConsultaDinamica($fabrica='',$modelo='',$anio='',$color='',$motor='',$tipo='',$kilometraje='',$id='',$condicionFabrica='',$condicionModelo='',$condicionANIO='',$condicionColor='',$condicionMotor='',$condicionTipo='',$condicionKilometraje='',$agrupar='',$ordenar='',$numeroRegistros=''){      
//        $stmt = $this->mysqli->prepare("SELECT "+$fabrica+$modelo+$anio+$color+$motor+$tipo+$kilometraje+"  FROM vehiculo INNER JOIN fabrica on fabrica.id=vehiculo.fabrica INNER JOIN modelo on modelo.id=vehiculo.modelo INNER JOIN anio on anio.id=vehiculo.anio INNER JOIN color on color.id=vehiculo.color INNER JOIN motor on motor.id=vehiculo.motor INNER JOIN tipo on tipo.id=vehiculo.tipo WHERE vehiculo.id=? ; ");
//        $stmt->bind_param('s',$id);
//        $stmt->execute();
//        $result = $stmt->get_result();        
//        $vehiculos = $result->fetch_all(MYSQLI_ASSOC); 
//        $stmt->close();
//        return $vehiculos;  
        $fabricaComa='';
        if(!empty($fabrica)){
            if(!empty($modelo)){
             $fabricaComa=',';
            }
            if(!empty($anio)){
              $fabricaComa=',';
            }
            if(!empty($color)){
               $fabricaComa=',';
            }
            if(!empty($motor)){
               $fabricaComa=',';
            }           
            if(!empty($tipo)){
                $fabricaComa=',';
            }
            if(!empty($kilometraje)){
              $fabricaComa=',';
            }
        }
         $modeloComa='';
        if(!empty($modelo)){
            if(!empty($anio)){
              $modeloComa=',';
            }
            if(!empty($color)){
               $modeloComa=',';
            }
            if(!empty($motor)){
               $modeloComa=',';
            }           
            if(!empty($tipo)){
                $modeloComa=',';
            }
            if(!empty($kilometraje)){
              $modeloComa=',';
            }
                               
        } 
        $anioComa='';
        if(!empty($anio)){
            if(!empty($color)){
                $anioComa=',';
            }
            if(!empty($motor)){
                 $anioComa=',';
            }
            if(!empty($tipo)){
                $anioComa=',';
            }
            if(!empty($kilometraje)){
                $anioComa=',';
            }
                       
        } 
        $colorComa='';
        if(!empty($color)){
            if(!empty($motor)){
              $colorComa=',';
            }
            if(!empty($tipo)){
              $colorComa=',';
            }
            if(!empty($kilometraje)){
               $colorComa=',';
            }
                   
        }
        $motorComa='';
        if(!empty($motor)){
             if(!empty($tipo)){
                $motorComa=',';
             }
             if(!empty($kilometraje)){
                $motorComa=',';
             }
        }
        $tipoComa='';
        if(!empty($tipo)){
            if(!empty($kilometraje)){
            $tipoComa=',';
            }
        }
        $hasid='';
        if(!empty($id)){
         $hasid=" WHERE vehiculo.id=".$id; 
        }
        ///checamos si eiste condiciones anteriorores para iniciar con and o where
        if(!empty($condicionFabrica))
        {
           if(empty($id)){
             $condicionFabrica=" WHERE ".$condicionFabrica; 
         } 
         else{
             $condicionFabrica=" and  ".$condicionFabrica; 
             
         }
            
        }
        //checamos si existen condiciones anteriores para iniciar con and o where
        if(!empty($condicionModelo))
        {
           if(empty($id)){
               if(empty($condicionFabrica)){
                      $condicionModelo="WHERE ".$condicionModelo; 
               }
               else{
             $condicionModelo=" and  ".$condicionModelo; 
             
             }
         } 
         else{
             $condicionModelo=" and  ".$condicionModelo; 
             
         }
            
        }
        //checamos si existen condiciones anteriores para iniciar con and o where
        if(!empty($condicionANIO))
        {
           if(empty($id)){
               if(empty($condicionFabrica))
               {
                       if(empty($condicionModelo)){
                              $condicionANIO="WHERE ".$condicionANIO; 
                       }
                       else{
                              $condicionANIO=" and  ".$condicionANIO; 

                       }
               }
               else{
             $condicionANIO=" and  ".$condicionANIO; 
             
             }
         } 
         else{
             $condicionANIO=" and  ".$condicionANIO; 
             
         }
            
        }
        
         //checamos si existen condiciones anteriores para iniciar con and o where
        if(!empty($condicionColor))
        {
           if(empty($id))
             {
               if(empty($condicionFabrica))
               {
                  if(empty($condicionModelo))
                    {
                       if(empty($condicionANIO)){
                              $condicionColor="WHERE ".$condicionColor; 
                       }
                       else{
                              $condicionColor=" and  ".$condicionColor; 
                       }
                    }
                    else{
                           $condicionColor=" and  ".$condicionColor; 
                    }
               }
               else{
             $condicionColor=" and  ".$condicionColor; 
             
             }
         } 
         else{
             $condicionColor=" and  ".$condicionColor; 
             
         }
            
        }
        
         //checamos si existen condiciones anteriores para iniciar con and o where
        if(!empty($condicionMotor))
        {
           if(empty($id))
             {
               if(empty($condicionFabrica))
               {
                  if(empty($condicionModelo))
                    {
                       if(empty($condicionANIO))
                        {
                           if(empty($condicionColor)){
                              $condicionMotor="WHERE ".$condicionMotor; 
                           }
                           else{
                              $condicionMotor=" and  ".$condicionMotor; 
                         }
                       }
                       else{
                              $condicionMotor=" and  ".$condicionMotor; 
                       }
                    }
                    else{
                           $condicionMotor=" and  ".$condicionMotor; 
                    }
               }
               else{
             $condicionMotor=" and  ".$condicionMotor; 
             
             }
         } 
         else{
             $condicionMotor=" and  ".$condicionMotor; 
             
         }
            
        }
        
         //checamos si existen condiciones anteriores para iniciar con and o where
        if(!empty($condicionTipo))
        {
           if(empty($id))
             {
               if(empty($condicionFabrica))
               {
                  if(empty($condicionModelo))
                    {
                       if(empty($condicionANIO))
                        {
                           if(empty($condicionColor))
                           {
                             if(empty($condicionMotor)){
                              $condicionTipo="WHERE ".$condicionTipo;
                             }
                              else{
                              $condicionTipo=" and  ".$condicionTipo; 
                                  }
                           }
                           else{
                              $condicionTipo=" and  ".$condicionTipo; 
                         }
                       }
                       else{
                              $condicionTipo=" and  ".$condicionTipo; 
                       }
                    }
                    else{
                           $condicionTipo=" and  ".$condicionTipo; 
                    }
               }
               else{
             $condicionTipo=" and  ".$condicionTipo; 
             
             }
         } 
         else{
             $condicionTipo=" and  ".$condicionTipo; 
             
         }
            
        }
        
         //checamos si existen condiciones anteriores para iniciar con and o where
        if(!empty($condicionKilometraje))
        {
           if(empty($id))
             {
               if(empty($condicionFabrica))
               {
                  if(empty($condicionModelo))
                    {
                       if(empty($condicionANIO))
                        {
                           if(empty($condicionColor))
                           {
                             if(empty($condicionMotor))
                              {
                                   if(empty($condicionTipo)){
                                     $condicionKilometraje="WHERE ".$condicionKilometraje;
                                   } else{
                                     $condicionKilometraje=" and  ".$condicionKilometraje; 
                                  }
                             }
                              else{
                              $condicionKilometraje=" and  ".$condicionKilometraje; 
                                  }
                           }
                           else{
                              $condicionKilometraje=" and  ".$condicionKilometraje; 
                         }
                       }
                       else{
                              $condicionKilometraje=" and  ".$condicionKilometraje; 
                       }
                    }
                    else{
                           $condicionKilometraje=" and  ".$condicionKilometraje; 
                    }
               }
               else{
             $condicionKilometraje=" and  ".$condicionKilometraje; 
             
             }
         } 
         else{
             $condicionKilometraje=" and  ".$condicionKilometraje; 
             
         }
            
        }
        
        $query="SELECT vehiculo.id, ".$fabrica.$fabricaComa.$modelo.$modeloComa.$anio.$anioComa.$color.$colorComa.$motor.$motorComa.$tipo.$tipoComa.$kilometraje."  FROM vehiculo INNER JOIN fabrica on fabrica.id=vehiculo.fabrica INNER JOIN modelo on modelo.id=vehiculo.modelo INNER JOIN anio on anio.id=vehiculo.anio INNER JOIN color on color.id=vehiculo.color INNER JOIN motor on motor.id=vehiculo.motor INNER JOIN tipo on tipo.id=vehiculo.tipo ".$hasid.$condicionFabrica.$condicionModelo.$condicionANIO.$condicionColor.$condicionMotor.$condicionTipo.$condicionKilometraje.$ordenar.$agrupar.$numeroRegistros.";";
        //echo $query;
         $result = $this->mysqli->query($query);          
        $vehiculos = $result->fetch_all(MYSQLI_ASSOC);          
        $result->close();
        return $vehiculos; 
    }
    
    /**
     * obtiene un solo registro dado su ID
     * @param int $id identificador unico de registro
     * @return Array array con los registros obtenidos de la base de datos
     */
    public function getVehiculo($id=0){      
        $stmt = $this->mysqli->prepare("SELECT vehiculo.id, fabrica.nombre as fabrica, modelo.nombre as modelo, anio.ANIO, color.color, motor.motor, tipo.tipo, kilometraje FROM vehiculo INNER JOIN fabrica on fabrica.id=vehiculo.fabrica INNER JOIN modelo on modelo.id=vehiculo.modelo INNER JOIN anio on anio.id=vehiculo.anio INNER JOIN color on color.id=vehiculo.color INNER JOIN motor on motor.id=vehiculo.motor INNER JOIN tipo on tipo.id=vehiculo.tipo WHERE vehiculo.id=? ; ");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();        
        $vehiculos = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $vehiculos;              
    }
    
    /**
     * obtiene todos los registros de la tabla "vehiculos"
     * @return Array array con los registros obtenidos de la base de datos
     */
    public function getVehiculos(){        
        $result = $this->mysqli->query('SELECT vehiculo.id, fabrica.nombre as fabrica, modelo.nombre as modelo, anio.ANIO, color.color, motor.motor, tipo.tipo, kilometraje,vehiculo.fabrica as idFabrica,vehiculo.modelo as idModelo,vehiculo.anio as idAnio,vehiculo.color as idColor,vehiculo.motor as idMotor,vehiculo.tipo as idTipo FROM vehiculo INNER JOIN fabrica on fabrica.id=vehiculo.fabrica INNER JOIN modelo on modelo.id=vehiculo.modelo INNER JOIN anio on anio.id=vehiculo.anio INNER JOIN color on color.id=vehiculo.color INNER JOIN motor on motor.id=vehiculo.motor INNER JOIN tipo on tipo.id=vehiculo.tipo ORDER BY vehiculo.id DESC;');          
        $vehiculos = $result->fetch_all(MYSQLI_ASSOC);          
        $result->close();
        return $vehiculos; 
    }
    
    /**
     * añade un nuevo registro en la tabla vehiculo
     * @param String $name nombre completo de vehiculo
     * @return bool TRUE|FALSE 
     */
    public function insert($fabrica=0,$modelo=0,$anio=0,$color=0,$motor=0,$tipo=0,$kilometraje=''){
        $stmt = $this->mysqli->prepare("INSERT INTO vehiculo(fabrica,modelo,anio,color,motor,tipo,kilometraje) VALUES (?,?,?,?,?,?,?); ");
        $stmt->bind_param('iiiiiis', $fabrica,$modelo,$anio,$color,$motor,$tipo,$kilometraje);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;        
    }
    
     /**
     * añade un nuevo registro en la tabla Seleccionada
      * 1 : Fabrica
        2 : Modelo
        3 : Año
        4 : Motor
        5 : Color
        6 : Tipo
     * @param String $name nombre completo de vehiculo
     * @return bool TRUE|FALSE 
     */
    public function insertCatalogo($dato='',$id=0){
        $stmt='';
        if($id==1)
        {
        $stmt = $this->mysqli->prepare("INSERT INTO fabrica(nombre) VALUES (?); ");
        }
        else if($id==2)
        {
        $stmt = $this->mysqli->prepare("INSERT INTO modelo(nombre) VALUES (?); ");
        }
         else if($id==3)
        {
        $stmt = $this->mysqli->prepare("INSERT INTO anio(ANIO) VALUES (?); ");
        }
         else if($id==4)
        {
        $stmt = $this->mysqli->prepare("INSERT INTO motor(motor) VALUES (?); ");
        }
         else if($id==5)
        {
        $stmt = $this->mysqli->prepare("INSERT INTO color(color) VALUES (?); ");
        }
         else if($id==6)
        {
        $stmt = $this->mysqli->prepare("INSERT INTO tipo(tipo) VALUES (?); ");
        }
        else{
            
              return "[{'error':'catalogo no existente'}]";  
        }
        $stmt->bind_param('s', $dato);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;        
    }
    /**
     * elimina un registro dado el ID
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
    public function delete($id=0) {
        $stmt = $this->mysqli->prepare("DELETE FROM vehiculo WHERE id = ? ; ");
        $stmt->bind_param('s', $id);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
    }
    
    /**
     * elimina un registro dado el ID
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
    public function deleteFabrica($id=0) {
        $stmt = $this->mysqli->prepare("DELETE FROM fabrica WHERE id = ? ; ");
        $stmt->bind_param('s', $id);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
    }
    
      /**
     * elimina un registro dado el ID
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
    public function deleteModelo($id=0) {
        $stmt = $this->mysqli->prepare("DELETE FROM modelo WHERE id = ? ; ");
        $stmt->bind_param('s', $id);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
    }
    
        /**
     * elimina un registro dado el ID
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
    public function deleteAnio($id=0) {
        $stmt = $this->mysqli->prepare("DELETE FROM anio WHERE id = ? ; ");
        $stmt->bind_param('s', $id);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
    }
    
        /**
     * elimina un registro dado el ID
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
    public function deleteMotor($id=0) {
        $stmt = $this->mysqli->prepare("DELETE FROM motor WHERE id = ? ; ");
        $stmt->bind_param('s', $id);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
    }
    
        /**
     * elimina un registro dado el ID
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
    public function deleteColor($id=0) {
        $stmt = $this->mysqli->prepare("DELETE FROM color WHERE id = ? ; ");
        $stmt->bind_param('s', $id);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
    }
    
        /**
     * elimina un registro dado el ID
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
    public function deleteTipo($id=0) {
        $stmt = $this->mysqli->prepare("DELETE FROM tipo WHERE id = ? ; ");
        $stmt->bind_param('s', $id);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
    }
    
    /**
     * Actualiza registro dado su ID
     * @param int $id,$fabrica,$modelo,$anio,$color,$motor,$tipo
     * @param string $kilometraje
     */
    public function update($id, $fabrica=0,$modelo=0,$anio=0,$color=0,$motor=0,$tipo=0,$kilometraje='') {
        if($this->checkID($id)){
            $stmt = $this->mysqli->prepare("UPDATE vehiculo SET fabrica=?,modelo=?,anio=?,color=?,motor=?,tipo=?,kilometraje=? WHERE id = ? ; ");
            $stmt->bind_param('iiiiiiss', $fabrica,$modelo,$anio,$color,$motor,$tipo,$kilometraje,$id);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        }
        return false;
    }
    
     /**
     * Actualiza registro de fabrica dado su ID
     * @param int $id Description
     */
    public function updateFabrica($id, $dato='') {
        if($this->checkIDDinamyc($id,'fabrica')){
            $stmt = $this->mysqli->prepare("UPDATE fabrica SET nombre=? WHERE id = ? ; ");
            $stmt->bind_param('ss', $dato,$id);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        }
        return false;
    }
    
    /**
     * Actualiza registro de modelo dado su ID
     * @param int $id Description
     */
    public function updateModelo($id, $dato='') {
        if($this->checkIDDinamyc($id,"modelo")){
            $stmt = $this->mysqli->prepare("UPDATE modelo SET nombre=? WHERE id = ? ; ");
            $stmt->bind_param('ss', $dato,$id);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        }
        return false;
    }
    
    /**
     * Actualiza registro de año dado su ID
     * @param int $id Description
     */
    public function updateAnio($id, $dato='') {
        if($this->checkIDDinamyc($id,'anio')){
            $stmt = $this->mysqli->prepare("UPDATE anio SET anio=? WHERE id = ? ; ");
            $stmt->bind_param('ss', $dato,$id);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        }
        return false;
    }
    
    /**
     * Actualiza registro de motor dado su ID
     * @param int $id Description
     */
    public function updateMotor($id, $dato='') {
        if($this->checkIDDinamyc($id,'motor')){
            $stmt = $this->mysqli->prepare("UPDATE motor SET motor=? WHERE id = ? ; ");
            $stmt->bind_param('ss', $dato,$id);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        }
        return false;
    }
    
    /**
     * Actualiza registro de color dado su ID
     * @param int $id Description
     */
    public function updateColor($id, $dato='') {
        if($this->checkIDDinamyc($id,'color')){
            $stmt = $this->mysqli->prepare("UPDATE color SET color=? WHERE id = ? ; ");
            $stmt->bind_param('ss', $dato,$id);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        }
        return false;
    }
    
    /**
     * Actualiza registro de tipo dado su ID
     * @param int $id Description
     */
    public function updateTipo($id, $dato='') {
        if($this->checkIDDinamyc($id,'tipo')){
            $stmt = $this->mysqli->prepare("UPDATE tipo SET tipo=? WHERE id = ? ; ");
            $stmt->bind_param('ss', $dato,$id);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        }
        return false;
    }
    
    /**
     * verifica si un ID existe
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
    public function checkID($id){
        $stmt = $this->mysqli->prepare("SELECT * FROM vehiculo WHERE id=?");
        $stmt->bind_param("s", $id);
        if($stmt->execute()){
            $stmt->store_result();    
            if ($stmt->num_rows == 1){                
                return true;
            }
        }        
        return false;
    }
    
    /**
     * verifica si un ID existe
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
    public function checkIDDinamyc($id,$catalogo){
        $stmt = $this->mysqli->prepare("SELECT * FROM ".$catalogo." WHERE id=?");
        $stmt->bind_param("s", $id);
        if($stmt->execute()){
            $stmt->store_result();    
            if ($stmt->num_rows == 1){                
                return true;
            }
        }        
        return false;
    }
    
}
