<?php
@include_once '../header.php';
@include '../connectDB.php';
global $connect;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM Students WHERE id = :id";
    $state = $connect->prepare($sqlSelect);
    $state->bindValue(':id', $id, PDO::PARAM_INT);
    $state->execute();
    $result = $state->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['update_student'])) {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $number = $_POST['number'];
    $fathers_number = $_POST['fathers_number'];
    $birth_date = date('Y-m-d', strtotime($_POST['birth_date']));
    $course_id = $_POST['course_id'];

    $sql_update = "UPDATE Students SET first_name = :first_name, last_name = :last_name, number = :number, fathers_number = :fathers_number, date_of_birth = :birth_date, course_id = :course_id WHERE id = :id";
    $state = $connect->prepare($sql_update);
    $state->bindValue(':id', $id);
    $state->bindValue(':first_name', $first_name);
    $state->bindValue(':last_name', $last_name);
    $state->bindValue(':number', $number);
    $state->bindValue(':fathers_number', $fathers_number);
    $state->bindValue(':birth_date', $birth_date);
    $state->bindValue(':course_id', $course_id);
    $state->execute();
    header("Location: http://connectdb/admin/students/students.php");
    exit();
}
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <h1 class="mb-3">Edit Student</h1>
            <form method="post">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="hidden" name="id" value="<?=$result['id'] ?>">
                        <label for="first_name" class="form-label">Edit First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?=$result['first_name'] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Edit Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?=$result['last_name'] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="number" class="form-label">Edit Phone Number</label>
                        <input type="text" class="form-control" id="number" name="number" value="<?=$result['number'] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="fathers_number" class="form-label">Edit Father's Number</label>
                        <input type="text" class="form-control" id="fathers_number" name="fathers_number" value="<?=$result['fathers_number'] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="birth_date" class="form-label">Edit Birth Date</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?= date('Y-m-d', strtotime($result['date_of_birth'])) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="course_id" class="form-label">Edit Course ID</label>
                        <input type="text" class="form-control" id="course_id" name="course_id" value="<?=$result['course_id'] ?>" required>
                    </div>
                    <div class="col-12 pt-5">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" name="update_student" class="btn btn-warning w-50 w-bold">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
