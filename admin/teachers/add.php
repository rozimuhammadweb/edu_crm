<?php @include_once '../header.php';
include '../connectDB.php';
global $connect;


if (isset($_POST['add_teacher'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $number = $_POST['number'];
    $position = $_POST['position'];
    $hire_date = date('Y-m-d', strtotime($_POST['hire_date']));


    $sql_insert = "INSERT INTO teachers (first_name, last_name, number, position, hire_date) VALUES (:first_name, :last_name, :number, :position, :hire_date)";
    $state = $connect->prepare($sql_insert);
    $state->bindValue(':first_name', $first_name);
    $state->bindValue(':last_name', $last_name);
    $state->bindValue(':number', $number);
    $state->bindValue(':position', $position);
    $state->bindValue(':hire_date', $hire_date);
    if($state->execute()){
        header("Location: http://connectdb/admin/teachers/teachers.php");
        exit();
    } else{
        header("Location: http://connectdb/admin/teachers/add.php");
        exit();
    }


}




?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <h1 class="mb-3">Add Teacher</h1>
            <form method="post" enctype="multipart/form-data" >
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" >
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" >
                    </div>
                    <div class="col-md-6">
                        <label for="number" class="form-label">Number</label>
                        <input type="text" class="form-control" id="number" name="number">
                    </div>
                    <div class="col-md-6">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name="position">
                    </div>
                    <div class="col-12">
                        <label for="hire_date" class="form-label">Hire Date</label>
                        <input type="date" class="form-control" id="hire_date" name="hire_date">
                    </div>
                    <div class="col-12 pt-5">
                        <div class="row">
                            <div class="col-md-6 ">
                                <button type="submit" name="add_teacher" class="btn btn-success w-50 w-bold" >Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



