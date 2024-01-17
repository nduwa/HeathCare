<?php

class Dbh {
    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbname = "dg_health";
    protected  $conn;

    function __construct(){
        $this->conn = new mysqli($this->host,$this->user,$this->pwd,$this->dbname);
        if($this->conn->connect_error){
            echo 'connection failed';
        }else{
            return $this->conn;
            //echo 'connected';
        }
    }
    
}
