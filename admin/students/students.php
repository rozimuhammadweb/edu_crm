<?php

@include_once '../header.php';
@include '../connectDB.php';
global $connect;

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM Students WHERE id = :id"; // Changed 'courses' to 'Teachers'
    $stmt = $connect->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    header("Location: students.php"); // redirects back to teachers page
    exit();
}


$con = $connect->prepare("SELECT  id, first_name, last_name, date_of_birth, number, course_id FROM Students");
$con->execute();
$res = $con->fetchAll(\PDO::FETCH_ASSOC);
?>

<div class="container py-3 d-flex flex-row-reverse">
    <a  class="btn btn-success" href="add.php">Add Student</a>
</div>
<table class=" container table">
    <thead>
    <tr class="table-info">
        <th scope="col">id</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Phone Number</th>
        <th scope="col">Birth Date</th>
        <th scope="col">Course ID</th>
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
        echo " <td class='fw-bolder'>" . $items['date_of_birth'] . "</td>";
        echo " <td class='fw-bolder'>" . $items['course_id'] . "</td>";
        echo "<td class='fw-bolder'>" . "<a class='btn btn-warning ml-5 mr-1' href=\"./update.php?id=" . $items['id'] . "\">Update</a>" . "<a class='btn btn-danger ml-1' onclick=\"return confirm('Are you sure you want to delete this item?');\" href=\"./students.php?delete=" . $items['id'] . "\">Delete</a>"
            . "</td>";

        echo "</tr>";
    }?>
    </tbody>
</table>
