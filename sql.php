<?php

class Sql extends PDO {
    
    private $conn;
    
    public function __construct(){
        
        $this->conn = new PDO("mysql:dbname=devjr;host=localhost", "root", "123456");
        
    }
    
    private function setParams($statement, $parameters = array()){
         
        foreach($parameters as $indice => $valor){            
            $this->setParam($statement, $indice, $valor);                        
        }    
    }
        
    private function setParam($statement, $indice, $valor){
            
        $statement->bindParam($indice, $valor);
        
    }
    
    public function query($rowQuery, $params = array()){
        $stmt = $this->conn->prepare($rowQuery);
        
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
        
    }
    
    public function select($rowQuery, $params= array()):array{
        
        $stmt = $this->query($rowQuery, $params);        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);        
    }
    
    
    public function desliga(){
        $this->conn = null;
        unset($this->conn);
        // echo "desligado";
    }
}


?>