<?php
    require_once "ControllerDB.php";    
/* 
 * Istvan Lucario
 */
    
class vehiculosAPI{  
public function API(){
        header('Content-Type: application/JSON');                
        $method = filter_input(INPUT_SERVER, "REQUEST_METHOD"); //$_SERVER['REQUEST_METHOD'];
        switch ($method) {
        case 'GET'://consulta
            $this->getVehiculos();
            break;     
        case 'POST'://inserta
            $this->saveVehiculo();
            break;                
        case 'PUT'://actualiza
            $this->updateVehiculos();
            break;      
        case 'DELETE'://elimina
            $this->deleteVehiculos();
            break;
        default://metodo NO soportado
            $this->response(405);
            break;
        }
    } 
    
    /**
 * Respuesta al cliente
 * @param int $code Codigo de respuesta HTTP
 * @param String $status indica el estado de la respuesta puede ser "success" o "error"
 * @param String $message Descripcion de lo ocurrido
 */
 function response($code=200, $status="", $message="") {
    http_response_code($code);
    if( !empty($status) && !empty($message) ){
        $response = array("status" => $status ,"message"=>$message);  
        echo json_encode($response,JSON_PRETTY_PRINT);    
    }            
 }  
  /**
  * función que segun el valor de "action" e "id":
  *  - mostrara una array con todos los registros de Vehiculos
  *  - mostrara un solo registro 
  *  - mostrara un array vacio
  */
 function getVehiculos(){
        /* @var $_GET type  filter_input(INPUT_GET, "vehiculos") */
        if($_GET['action'] == 'vehiculos'){ 
          $db = new ControllerDB();
         if(isset($_GET['id'])){//muestra 1 solo registro si es que existiera ID   
             $response = $db->getVehiculo($_GET['id']);                
             echo json_encode($response,JSON_PRETTY_PRINT);
         }else{ //muestra todos los registros                   
             $response = $db->getVehiculos();              
             echo json_encode($response,JSON_PRETTY_PRINT);
         }
        }else if($_GET['action'] == 'catalogo'){
           $db = new ControllerDB();
            if(isset($_GET['id'])){//muestra 1 solo registro si es que existiera ID   
             $response = $db->getCatalogo($_GET['id']);                
             echo json_encode($response,JSON_PRETTY_PRINT);
         }
        }else if($_GET['action'] == 'consultaDinamica'){
           $db = new ControllerDB();
            $obj = json_decode( file_get_contents('php://input') );   
            $objArr = (array)$obj;
             if(isset($obj)){
                 $id='';
                 if(isset($_GET['id'])){//muestra 1 solo registro si es que existiera ID
                     {
                         $id=$_GET['id'];
                     }
                 }
                $response = $db->getConsultaDinamica($obj->fabrica,$obj->modelo,$obj->ANIO,$obj->color,$obj->motor,$obj->tipo,$obj->kilometraje, $id,$obj->condicionFabrica,$obj->condicionModelo,$obj->condicionANIO,$obj->condicionColor,$obj->condicionMotor,$obj->condicionTipo,$obj->condicionKilometraje,$obj->agrupar,$obj->ordenar,$obj->numeroRegistros);                
                echo json_encode($response,JSON_PRETTY_PRINT);
             }
        }
//     }else{
//            $this->response(400);
//     }       
 }    
   /**
   * metodo para guardar un nuevo registro de Vheiculo en la base de datos
   */
  function saveVehiculo(){
      if($_GET['action']=='vehiculos'){   
          //Decodifica un string de JSON
          $obj = json_decode( file_get_contents('php://input') );   
          $objArr = (array)$obj;
          if (empty($objArr)){
             $this->response(422,"error","Nothing to add. Check json");                           
         }else if(isset($obj)){
             $vehiculo = new ControllerDB();     
             $vehiculo->insert( $obj->fabrica,$obj->modelo,$obj->ANIO,$obj->color,$obj->motor,$obj->tipo,$obj->kilometraje);
             $this->response(200,"success","new record added");                             
         }else{
             $this->response(422,"error","The property is not defined");
         }
     }else if($_GET['action']=='catalogos'){   
          //Decodifica un string de JSON
         if(isset($_GET['id']))
         {
          $obj = json_decode( file_get_contents('php://input') );   
          $objArr = (array)$obj;
          if (empty($objArr)){
             $this->response(422,"error","Nothing to add. Check json");                           
         }else if(isset($obj)){
             $vehiculo = new ControllerDB();     
             $vehiculo->insertCatalogo( $obj->dato,$_GET['id']);
             $this->response(200,"success","new record added");                             
         }else{
             $this->response(422,"error","The property is not defined");
         }
        }
        else{
            
            $this->response(400);
        }
        
     }
     
     else{               
         $this->response(400);
     }  
 }
 
 /**
 * Actualiza un recurso
 */
function updateVehiculos() {
    if( isset($_GET['action']) && isset($_GET['id']) ){
        if($_GET['action']=='vehiculos'){
            $obj = json_decode( file_get_contents('php://input') );   
            $objArr = (array)$obj;
            if (empty($objArr)){                        
                $this->response(422,"error","Nothing to add. Check json");                        
            }else if(isset($obj)){
                $db = new ControllerDB();
                $db->update($_GET['id'],  $obj->fabrica,$obj->modelo,$obj->ANIO,$obj->color,$obj->motor,$obj->tipo,$obj->kilometraje);
              
                if($db!=false){
                    $this->response(200,"success","Record updated");                             
                }else{
                  $this->response(200,"Error","Registro no Existe");                             

                }
            }else{
                $this->response(422,"error","The property is not defined");                        
            }     
            exit;
       }
       else if($_GET['action']=='fabrica'){
            $obj = json_decode( file_get_contents('php://input') );   
            $objArr = (array)$obj;
            if (empty($objArr)){                        
                $this->response(422,"error","Nothing to add. Check json");                        
            }else if(isset($obj)){
                $db = new ControllerDB();
                $db->updateFabrica($_GET['id'],  $obj->dato);
                $this->response(200,"success","Record updated");                             
            }else{
                $this->response(422,"error","The property is not defined");                        
            }     
            exit;
       }
       else if($_GET['action']=='modelo'){
            $obj = json_decode( file_get_contents('php://input') );   
            $objArr = (array)$obj;
            if (empty($objArr)){                        
                $this->response(422,"error","Nothing to add. Check json");                        
            }else if(isset($obj)){
                $db = new ControllerDB();
                $db->updateModelo($_GET['id'],  $obj->dato);
                $this->response(200,"success","Record updated");                             
            }else{
                $this->response(422,"error","The property is not defined");                        
            }     
            exit;
       }
       else if($_GET['action']=='anio'){
            $obj = json_decode( file_get_contents('php://input') );   
            $objArr = (array)$obj;
            if (empty($objArr)){                        
                $this->response(422,"error","Nothing to add. Check json");                        
            }else if(isset($obj)){
                $db = new ControllerDB();
                $db->updateAnio($_GET['id'],  $obj->dato);
                $this->response(200,"success","Record updated");                             
            }else{
                $this->response(422,"error","The property is not defined");                        
            }     
            exit;
       }
       else if($_GET['action']=='motor'){
            $obj = json_decode( file_get_contents('php://input') );   
            $objArr = (array)$obj;
            if (empty($objArr)){                        
                $this->response(422,"error","Nothing to add. Check json");                        
            }else if(isset($obj)){
                $db = new ControllerDB();
                $db->updateMotor($_GET['id'],  $obj->dato);
                $this->response(200,"success","Record updated");                             
            }else{
                $this->response(422,"error","The property is not defined");                        
            }     
            exit;
       }
       else if($_GET['action']=='color'){
            $obj = json_decode( file_get_contents('php://input') );   
            $objArr = (array)$obj;
            if (empty($objArr)){                        
                $this->response(422,"error","Nothing to add. Check json");                        
            }else if(isset($obj)){
                $db = new ControllerDB();
                $db->updateColor($_GET['id'],  $obj->dato);
                $this->response(200,"success","Record updated");                             
            }else{
                $this->response(422,"error","The property is not defined");                        
            }     
            exit;
       }
       else if($_GET['action']=='tipo'){
            $obj = json_decode( file_get_contents('php://input') );   
            $objArr = (array)$obj;
            if (empty($objArr)){                        
                $this->response(422,"error","Nothing to add. Check json");                        
            }else if(isset($obj)){
                $db = new ControllerDB();
                $db->updateTipo($_GET['id'],  $obj->dato);
                $this->response(200,"success","Record updated");                             
            }else{
                $this->response(422,"error","The property is not defined");                        
            }     
            exit;
       }
    }
    $this->response(400);
}
 /**
     * elimina Vehiculos
     */
    function deleteVehiculos(){
        if( isset($_GET['action']) && isset($_GET['id']) ){
            if($_GET['action']=='vehiculos'){                   
                $db = new ControllerDB();
                $db->delete($_GET['id']);
                $this->response(202,"success","Record deleted");                   
                exit;
            }
            else if($_GET['action']=='fabrica'){                   
                $db = new ControllerDB();
                $db->deleteFabrica($_GET['id']);
                $this->response(202,"success","Record deleted");                   
                exit;
            }
            else if($_GET['action']=='modelo'){                   
                $db = new ControllerDB();
                $db->deleteModelo($_GET['id']);
                $this->response(202,"success","Record deleted");                   
                exit;
            }
            else if($_GET['action']=='anio'){                   
                $db = new ControllerDB();
                $db->deleteAnio($_GET['id']);
                $this->response(202,"success","Record deleted");                   
                exit;
            }
            else if($_GET['action']=='motor'){                   
                $db = new ControllerDB();
                $db->deleteMotor($_GET['id']);
                $this->response(202,"success","Record deleted");                   
                exit;
            }
            else if($_GET['action']=='color'){                   
                $db = new ControllerDB();
                $db->deleteColor($_GET['id']);
                $this->response(202,"success","Record deleted");                   
                exit;
            }
            else if($_GET['action']=='tipo'){                   
                $db = new ControllerDB();
                $db->deleteTipo($_GET['id']);
                $this->response(202,"success","Record deleted");                   
                exit;
            }
        }
        $this->response(400);
    }
    
}//end class
    

