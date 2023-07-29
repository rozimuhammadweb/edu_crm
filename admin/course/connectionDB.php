<?php
namespace db;
use PDO;

class connectDB
{
 public  $con;

private  $host = 'localhost';
private $username = 'root';
private $password = '';
 private $database = 'learningCenter';

 public function __construct()
 {
  $this->con = $this->host;
  $this->database;
  $this->password;
  $this->username;
 }

}


