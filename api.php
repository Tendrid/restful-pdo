<?php namespace restpdo;
// restful interface.
use \PDO;

// TODO: REMOVE ONCE DONE DEBUG BUILDS
error_reporting(E_ALL);
ini_set('display_errors',16384);

class API{

    protected $settings = Array();
    var $models = Array();

    function __construct(){
        $this->loadSettings();
        $this->_connect();
        $this->loadModels();
    }

    function loadSettings($path="./settings.ini"){
        $required = Array('dsn','user','password','modelpath');
        $this->settings = parse_ini_file($path);

        foreach($required as $key){
            if(!isset($this->settings[$key])){
                throw new \Exception("required settings value [$key] missing");
            }
        }

    }

    function _connect(){
        try {
            $dbh = new PDO($this->settings['dsn'], $this->settings['user'], $this->settings['password']);
        } catch (PDOException $e) {
            $this->error($e);
        }        
    }

    function loadModels(){
        foreach($this->settings['models'] as $modelname){
            require_once($this->settings['modelpath']."/".$modelname.".php");
            if( class_exists($modelname) ){
                $this->models[$modelname] = True;
            }
        }
    }

    function processRequest(){
        $verb = $_SERVER['REQUEST_METHOD'];
        $this->verb = $verb;
        if( in_array($verb, $this->settings['verbs']) ){
            $this->$verb();
        }else{
            trigger_error("request method [$verb] not supported", E_USER_NOTICE);
        }
    }

    function _scrubParams($query){

    }

    // get an object by its primary key
    function GET(){
        if(!isset($_GET["__model"])){
            throw new \Exception("missing model name");
        }
        $pk = $_GET['params'];
        // pop of the trailing slash if we have one
        if (substr($pk, -1) == "/" ){
            $pk = substr_replace($pk, "", -1);
        }
        if(isset($this->models[$_GET["__model"]])){
            if($pk){
                $obj = new $_GET["__model"]($this);
                $obj->lookup($pk);
                echo "lookup";
            }else{
                echo "show all";
            }

        }
    }

    function POST(){
        
    }
    function PUT(){
        
    }
    function DELETE(){
        
    }

    function error($e){
        // TODO: flesh this out to include xml, json, and csv
        if($this->settings['reporterrors']){
            print json_encode(Array("error"=>$e->getMessage()));
        }else{
            print json_encode(Array());
        }
    }

}



// if we're calling the file directly, handle the restful request
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    try{
        $API = new API();
        $API->processRequest();
    }catch (\Exception $e) {
        $API->error($e);
    }
}


?>