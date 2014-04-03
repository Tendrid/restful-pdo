<?php
// abstract class used to define modeles
abstract class base{

    // if requesting all, this defines the limit
    $querylimit = 20;

    // this defines which field to sort by
    $sortby = "id";

    // this defines sort direction
    $sort = "desc";


    function __construct($api){
        $this->api = $api;
    }

    public function lookup($pk){
        $this->{"PRE_".$this->api->verb}();
        # lookup with $api db connection
        # apply values to $this
    }

    public function create(){
        $this->{"PRE_".$this->api->verb}();

        #todo

        $this->save();
    }

    public function save(){
        #todo

        $this->{"POST_".$this->api->verb}();
    }

    public function delete(){
        #todo

        $this->{"POST_".$this->api->verb}();
    }

    /**
     * Override these fucntions to manipulate data pre or post data handler
     * PRE_ methods fire before a database call
     * POST_ methods fire after a database call, but before the data outputs to the browser
    */
    public function PRE_GET(){}
    public function POST_GET(){}

    public function PRE_POST(){}
    public function POST_POST(){}

    public function PRE_PUT(){}
    public function POST_PUT(){}

    public function PRE_DELETE(){}
    public function POST_DELETE(){}
}
?>