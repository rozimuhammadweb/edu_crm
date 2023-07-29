<?php
@include_once '../header.php';
include '../connectDB.php';
global $connect;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM teachers WHERE id = :id";
    $state = $connect->prepare($sqlSelect);
    $state->bindValue(':id', $id, PDO::PARAM_INT);
    $state->execute();
    $result = $state->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['update_teacher'])) {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $number = $_POST['number'];
    $position = $_POST['position'];
    $hire_date = date('Y-m-d', strtotime($_POST['hire_date']));

    $sql_update = "UPDATE teachers SET first_name = :first_name, last_name = :last_name, number = :number, position = :position, hire_date = :hire_date WHERE id = :id";
    $state = $connect->prepare($sql_update);
    $state->bindValue(':id', $id);
    $state->bindValue(':first_name', $first_name);
    $state->bindValue(':last_name', $last_name);
    $state->bindValue(':number', $number);
    $state->bindValue(':position', $position);
    $state->bindValue(':hire_date', $hire_date);
    if($state->execute()){
        header("Location: http://connectdb/admin/teachers/teachers.php");
        exit();
    } else{
        header("Location: http://connectdb/admin/teachers/update.php?id=".$id);
        exit();
    }
}
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <h1 class="mb-3">Update Teacher</h1>
            <form method="post">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="hidden" name="id" value="<?=$result['id'] ?>">
                        <label for="first_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?=$result['first_name'] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?=$result['last_name'] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="number" class="form-label">Number</label>
                        <input type="text" class="form-control" id="number" name="number" value="<?=$result['number'] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name="position" value="<?=$result['position'] ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="hire_date" class="form-label">Hire Date</label>
                        <input type="date" class="form-control" id="hire_date" name="hire_date" value="<?= date('Y-m-d', strtotime($result['hire_date'])) ?>" required>
                    </div>
                    <div class="col-12 pt-5">
                        <div class="row">
                            <div class="col-md-6 ">
                                <button type="submit" name="update_teacher" class="btn btn-warning w-50 w-bold">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
