<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'learningCenter';

try {
    $connect = new PDO("mysql:host=$host;dbname=$database", $username, $password);
//    echo 'Connected Successfully';
} catch (PDOException $e) {

    echo 'Warning Error, Connection Failed: ' . $e->getCode();
}

