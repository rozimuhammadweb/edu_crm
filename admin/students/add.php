<?php
@include_once '../header.php';
@include '../connectDB.php';
global $connect;

if (isset($_POST['add_student'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $number = $_POST['number'];
    $fathers_number = $_POST['fathers_number'];
    $birth_date = date('Y-m-d', strtotime($_POST['birth_date']));
    $course_id = $_POST['course_id'];

    $sql_insert = "INSERT INTO Students (first_name, last_name, number, fathers_number, date_of_birth, course_id) VALUES (:first_name, :last_name, :number, :fathers_number, :birth_date, :course_id)";
    $state = $connect->prepare($sql_insert);
    $state->bindValue(':first_name', $first_name);
    $state->bindValue(':last_name', $last_name);
    $state->bindValue(':number', $number);
    $state->bindValue(':fathers_number', $fathers_number);
    $state->bindValue(':birth_date', $birth_date);
    $state->bindValue(':course_id', $course_id);
    if($state->execute()){
        header("Location: http://connectdb/admin/students/students.php");
        exit();
    } else{
        echo "Something went wrong!";
    }
}
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <h1 class="mb-3">Add Student</h1>
            <form method="post">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="number" name="number" required>
                    </div>
                    <div class="col-md-6">
                        <label for="fathers_number" class="form-label">Father's Number</label>
                        <input type="text" class="form-control" id="fathers_number" name="fathers_number" required>
                    </div>
                    <div class="col-md-6">
                        <label for="birth_date" class="form-label">Birth Date</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                    </div>
                    <div class="col-md-6">
                        <label for="course_id" class="form-label">Course ID</label>
                        <input type="text" class="form-control" id="course_id" name="course_id" required>
                    </div>
                    <div class="col-12 pt-5">
                        <div class="row">
                            <div class="col-md-6 ">
                                <button type="submit" name="add_student" class="btn btn-success w-50 w-bold" >Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
