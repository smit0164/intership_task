<?php
namespace Core;
use PDO;
class Database{
    public $connection;
    public $statment;
    public function __construct($config){
        $dsn="mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset=utf8mb4";
        $this->connection=new PDO($dsn,"root","root",[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    public function query($query,$param=[]){
       $this->statment=$this->connection->prepare($query);
       $this->statment->execute($param);
       return $this;
    }
    public function find(){
        return $this->statment->fetch();
    }
    public function get(){
        return $this->statment->fetchAll();
    }

}