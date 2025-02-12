<?php
class Database{
    public $connection;
    public function __construct($config){
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
     
        $this->connection=new PDO($dsn,"root","root",[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

    }
   public function query($value){
        $statment=$this->connection->prepare($value);
        $statment->execute();
        return $statment;
   }
}