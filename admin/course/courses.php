<?php
session_start();

if (!isset($_SESSION['sortOrder'])) {
    $_SESSION['sortOrder'] = 'name';
    $_SESSION['sortDirection'] = 'ASC';
}

include_once '../header.php';
include '../connectDB.php';

if (isset($_POST['sort'])) {
    $_SESSION['sortOrder'] = 'price';
    $_SESSION['sortDirection'] = ($_SESSION['sortDirection'] == 'ASC') ? 'DESC' : 'ASC';
} elseif (isset($_POST['sortName'])) {
    $_SESSION['sortOrder'] = 'name';
    $_SESSION['sortDirection'] = ($_SESSION['sortDirection'] == 'ASC') ? 'DESC' : 'ASC';
} elseif (isset($_POST['sortType'])) {
    $_SESSION['sortOrder'] = 'type';
    $_SESSION['sortDirection'] = ($_SESSION['sortDirection'] == 'ASC') ? 'DESC' : 'ASC';
}

$order = $_SESSION['sortOrder'];
$direction = $_SESSION['sortDirection'];
$sql = "SELECT * FROM courses ORDER BY $order $direction";
$stmt = $connect->prepare($sql);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container py-3 d-flex flex-row-reverse">
    <a  class="btn btn-success" href="add_course.php">Add Course</a>
</div>
<form method="post" action="courses.php">
    <table class="container table my-3">
        <thead>
        <tr class="table-info">
            <th scope="col">id</th>
            <th scope="col">Name
                <button type="submit" class="btn" name="sortName">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z"/></svg>
                </button>
            </th>
            <th scope="col">Picture</th>
            <th scope="col">Type
                <button type="submit" class="btn" name="sortType">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z"/></svg>
                </button>
            </th>
            <th scope="col">Description</th>
            <th scope="col">Price
                <button type="submit" class="btn" name="sort">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z"/></svg>
                </button>
            </th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($res as $items) {
            echo "<tr>";
            echo "<td class='text-danger'>" . $items['id'] . "</td>";
            echo "<td class='text-uppercase'>" . $items['name'] . "</td>";
            echo "<td> <img width='100px' height='100px' class='rounded-circle' alt='course_image' src='uploads/". $items['image']."'></td>";
            echo "<td class='text-bold'>" . $items['type'] . "</td>";
            echo "<td>" . $items['description'] . "</td>";
            echo "<td class='fw-bolder text-primary'>" . $items['price'] . "</td>";
            echo "<td class='fw-bolder'>" . "<a class='btn btn-warning ml-5 mr-1' href=\"./update.php?id=" . $items['id'] . "\">Edit</a>" . "<a class='btn btn-danger ml-1' href=\"./delete.php?id=" . $items['id'] . "\">Delete</a>" . "</td>";
            echo "</tr>";
        } ?>
        </tbody>
    </table>
</form>
