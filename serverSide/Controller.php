<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");
error_reporting(0);
    class Controller{
        private $handler;
        private $params;
        private $key;
        function __construct(){
            $dataStr = $_SERVER['PATH_INFO']; //$dataStr =>'/uWe/201234/atwd1'
            $this->params = explode('/',$dataStr); //this->params{'','uWe','201234','atwd1'}
            array_shift($this->params);//this->params{'uWe','201234','atwd1'}

            $resource = array_shift($this->params);//this->params{'201234','atwd1'}//$resource = 'uWe'
            $resource = strtolower($resource);//$resource 'uwe'
            $resource = ucfirst($resource);//$resource 'Uwe'
            $handlerName = $resource.'Handler';// UweHandler
            $handleFile = $handlerName.'.php';// UweHandler.php
            if($_SERVER['REQUEST_METHOD']=="PUT"||$_SERVER['REQUEST_METHOD']=="POST"){
                $this->params = json_decode(file_get_contents("php://input"));
                header("Access-Control-Allow-Methods: POST");
                $dataStr = $_SERVER['PATH_INFO']; //$dataStr =>'/uWe/201234/atwd1'
                $this->key = explode('/',$dataStr); //this->params{'','uWe','201234','atwd1'}
                array_shift($this->key);//this->params{'uWe','201234','atwd1'}
                array_shift($this->key);//this->params{'201234','atwd1'}
            }
            
            if(file_exists($handleFile)){
                require_once $handleFile;
                $this->handler = new $handlerName;//dynamic binding
                $mothod = $_SERVER['REQUEST_METHOD'];//GET
                $mothod = 'rest'.ucfirst(strtolower($mothod));//restGet
                $this->handler->$mothod($this->params,$this->key);
            }else{
                $dbdata['code']=404;
                $dbdata['message']="your input can not found result, please try another Input";
                echo json_encode($dbdata);
            }
        }
    }
$controller = new Controller();
?>