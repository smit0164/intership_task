<?php
class Database{
    public $connection;
    public function __construct($config){
      
        $dsn ='mysql:'. http_build_query($config,'',';');
        //$dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset=utf8mb4"; 
        $this->connection = new PDO($dsn, "root","root",[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    public function query($query,$param=[]){
         $statement=$this->connection->prepare($query);
         $statement->execute($param);
         return $statement;
    }
}