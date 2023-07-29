<?php

function getCourses($page){
    include '../connectDB.php';
    global $connect;

    $limit = 5;
    $offset = ($page -  1 ) * $limit;
    $con = $connect->prepare("SELECT id, name, type, description, price FROM courses limit :offset, :limit");
    $con->bindValue(":limit", $limit, PDO::PARAM_INT);
    $con->bindValue(':offset', $offset, PDO::PARAM_INT);
    $con->execute();
    $res = $con->fetchAll(\PDO::FETCH_ASSOC);
    return $res;
}

function Pagination(){
    $limit = 5;
    include '../connectDB.php';
    global $connect;

    $con = $connect->prepare("SELECT id, name, type, description, price FROM courses");
    var_dump($con);
    exit();
    $con->execute();
    $totalRows = $con->rowCount();
    return ceil($totalRows / $limit);
}