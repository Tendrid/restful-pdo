<?php namespace restpdo;
// restful interface.
use \PDO;

error_reporting(E_ALL);
ini_set('display_errors',16384);

class API{

    protected $config; 

    function __construct(){
        $this->loadSettings();
        $this->_connect();

    }

    function loadSettings($path="./settings.php"){
        $required = Array('dsn','user','password');
        $optional = Array();
        require($path);

        foreach($required as $key){
            if(!isset($$key)){
                throw("required config value [$key] missing");
            }else{
                $this->config[$key] = $$key;
            }
        }
        foreach($optional as $key){
            if(!isset($$key)){
                $this->config[$key] = NULL;
            }else{
                $this->config[$key] = $$key;
            }
        }

    }

    function _connect(){
        try {
            $dbh = new PDO($this->config['dsn'], $this->config['user'], $this->config['password']);
        } catch (PDOException $e) {
            $this->error($e);
        }        
    }


    function error($e){

    }
}



// if we're calling the file directly, handle the restful request
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    $API = new API();
}


?>