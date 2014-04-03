<?php
// abstract class used to define modeles
abstract class base{
    function __construct($api){
        $this->api = $api;
    }

    public function lookup($pk){
        //lookup with $api db connection
    }
}
?>