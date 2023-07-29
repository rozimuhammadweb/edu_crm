<?php
@include_once '../header.php';
include '../connectDB.php';
global $connect;

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM courses WHERE id = :id";
    $state = $connect->prepare($sqlSelect);
    $state->bindValue(':id', $id, PDO::PARAM_INT);
    $state->execute();
    $result = $state->fetch(PDO::FETCH_ASSOC);
}

$sql_delete = "DELETE FROM courses WHERE id = :id";
$state = $connect->prepare($sql_delete);
$state->bindValue(':id', $id, PDO::PARAM_INT);
$state->execute();
header("Location: http://connectdb/admin/course/courses.php");
exit();
?>
