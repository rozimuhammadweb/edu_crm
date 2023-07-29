<?php
require_once '../header.php';
include '../connectDB.php';
global $connect;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM courses WHERE id = :id";
    $state = $connect->prepare($sqlSelect);
    $state->bindValue(':id', $id, PDO::PARAM_INT);
    $state->execute();
    $result = $state->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['update_course'])) {
    $id = $_POST['id'];
    $name = $_POST['courseName'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $upload_dir = 'uploads/';

    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $file_name = $_FILES['file']['name'];
        $file_tmp_name = $_FILES['file']['tmp_name'];
        move_uploaded_file($file_tmp_name, $upload_dir . $file_name);

        $sql_update = "UPDATE courses SET name = :name, type = :type, description = :description, price = :price, image = :image WHERE id = :id";
        $state = $connect->prepare($sql_update);
        $state->bindValue(':id', $id);
        $state->bindValue(':name', $name);
        $state->bindValue(':type', $type);
        $state->bindValue(':description', $description);
        $state->bindValue(':price', $price);
        $state->bindValue(':img', $file_name);
        $state->execute();
    } else {
        $sql_update = "UPDATE courses SET name = :name, type = :type, description = :description, price = :price WHERE id = :id";
        $state = $connect->prepare($sql_update);
        $state->bindValue(':id', $id);
        $state->bindValue(':name', $name);
        $state->bindValue(':type', $type);
        $state->bindValue(':description', $description);
        $state->bindValue(':price', $price);
        $state->execute();
    }

    header("Location: http://connectdb/admin/course/courses.php");
    exit();
}
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <h1 class="mb-3">Edit Course</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="hidden" name="id" value="<?=$result['id'] ?>">
                        <label for="courseName" class="form-label">Edit Course Name</label>
                        <input type="text" class="form-control" id="courseName" name="courseName" value="<?=$result['name'] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="type" class="form-label">Edit Course Type</label>
                        <input type="text" class="form-control" id="type" name="type" required value="<?=$result['type'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="price" class="form-label">Edit Price</label>
                        <input type="text" class="form-control" id="price" name="price" value="<?=$result['price'] ?>">
                    </div>
                    <div class="col-md-6 rounded-circle">
                        <label for="file" class="form-label">File</label>
                        <input type="file" class="form-control border-light " id="file" name="image">
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">Edit Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required><?= $result['description'] ?></textarea>
                    </div>
                    <div class="col-12 pt-5">
                        <div class="row">
                            <div class="col-md-6 ">
                                <button type="submit" name="update_course" class="btn btn-warning w-50 w-bold">Change</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
