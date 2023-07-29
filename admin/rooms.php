<?php
@include_once 'header.php';
@include 'connectDB.php';
global $connect;

$con = $connect ->prepare("select id, name, capacity, description, status from rooms");
$con->execute();
$res = $con->fetchAll(\PDO::FETCH_ASSOC);
?>

<div class="container py-3 d-flex flex-row-reverse">
    <a  class="btn btn-success" href="add_course.php">Add Room</a>
</div>
<table class="container table">
    <thead>
    <tr class="table-info">
        <th scope="col">id</th>
        <th scope="col">Name</th>
        <th scope="col">Type</th>
        <th scope="col">Description</th>
        <th scope="col">Sig'imi</th>
        <th scope="col">Status</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($res as $items){
        echo "<tr>";
        echo " <td class='text-danger'>" . $items['id'] . "</td>";
        echo " <td class='text-success'>" . $items['name'] . "</td>";
        echo " <td>" . $items['description'] . "</td>";
        echo " <td>" . $items['capacity'] . "</td>";
        echo " <td class='fw-bolder mr-2'>" . $items['status'] . "</td>";
        echo "<td class='fw-bolder'>" . "<a class='btn btn-warning ml-5 mr-1' href=\"./update.php?id=" . $items['id'] . "\">Edit</a>" . "</td>";
        echo "<td class='fw-bolder'>" . "<a class='btn btn-danger ml-1' href=\"./delete.php?id=" . $items['id'] . "\">Delete</a>" . "</td>";
        echo "</tr>";
    }?>
    </tbody>
</table>
