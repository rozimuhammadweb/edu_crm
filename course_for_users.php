<?php
@include_once 'header.php';
@include './admin/connectDB.php';
global $connect;

$con = $connect->prepare("SELECT id, name, type, description, price FROM courses");
$con->execute();
$res = $con->fetchAll(\PDO::FETCH_ASSOC);
?>


<div class="container pt-5">
    <div class="row">
        <?php
        foreach ($res as $items) {
            echo "<div class='col-4 pt-3'>";
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title text-primary'>" . $items['name'] . "</h5>";
            echo "<h6 class='card-subtitle mb-2 text-danger'>" . $items['type'] . "</h6>";
            echo "<p class='card-text'>" . $items['description'] . "</p>";
            echo "<button  class='btn btn-success'>" . "Narxi: " . $items['price'] . "</button>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</div>


