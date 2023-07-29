<?php
@include_once '../header.php';
@include '../connectDB.php';
global $connect;

$con = $connect->prepare("SELECT id, first_name, last_name, number, position, hire_date FROM Teachers");
$con->execute();
$res = $con->fetchAll(\PDO::FETCH_ASSOC);

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM Teachers WHERE id = :id"; // Changed 'courses' to 'Teachers'
    $stmt = $connect->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    header("Location: teachers.php"); // redirects back to teachers page
    exit();
}

?>


<div class="container py-3 d-flex flex-row-reverse">
    <a  class="btn btn-success" href="add.php">Add Teacher</a>
</div>
<table class=" container table">
    <thead>
    <tr class="table-info">
        <th scope="col">id</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Phone Number</th>
        <th scope="col">Position</th>
        <th scope="col">Hire Date</th>
        <th scope="col"></th>

    </tr>
    </thead>
    <tbody>
    <?php foreach ($res as $items){
        echo "<tr>";
        echo " <td class='text-danger'>" . $items['id'] . "</td>";
        echo " <td class='text-success'>" . $items['first_name'] . "</td>";
        echo " <td>" . $items['last_name'] . "</td>";
        echo " <td>" . $items['number'] . "</td>";
        echo " <td class='fw-bolder'>" . $items['position'] . "</td>";
        echo " <td class='fw-bolder'>" . $items['hire_date'] . "</td>";
        echo "<td class='fw-bolder'>" . "<a class='btn btn-warning ml-5 mr-1' href=\"./update.php?id=" . $items['id'] . "\">Update</a>" . "<a class='btn btn-danger ml-1' onclick=\"return confirm('Are you sure you want to delete this item?');\" href=\"./teachers.php?id=" . $items['id'] . "\">Delete</a>" . "</td>";
        echo "</tr>";
    }?>
    </tbody>
</table>
