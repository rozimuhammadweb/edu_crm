<?php @include_once '../header.php';
include '../connectDB.php';
global $connect;


if (isset($_POST['add_course'])) {
    $name = $_POST['courseName'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $img = $_FILES['file'];


    $upload_folder = "uploads/";
    if (isset($_FILES['file'])) {

        if (!is_dir($upload_folder))
            mkdir($upload_folder);

        $errors = array();
        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file'][' size'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_type = $_FILES['file']['type'];
        $file_format_arr = explode('.', $_FILES['file']['name']);
        $file_ext = strtolower(end($file_format_arr));

        $extensions = array("jpeg", "jpg", "png", "html");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Fayl formati JPEG yoki PNG, Html bo`lishi kerak.";
        }

        if ($file_size > 5097152) {
            $errors[] = 'File hajmi 5 MB dan katta bo`lmasligi kerak';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, $upload_folder . $file_name);
            echo "Success";
        } else {
            echo "<pre>";
            print_r($errors);
        }
    }


    $sql_insert = "INSERT INTO courses (name, type, description, price, image) VALUES (:name, :type, :description, :price, :img)";
    $state = $connect->prepare($sql_insert);
    $state->bindValue(':name', $name);
    $state->bindValue(':type', $type);
    $state->bindValue(':description', $description);
    $state->bindValue(':price', $price);
    $state->bindValue(':img', $file_name);
    $state->execute();
    header("Location: http://connectdb/admin/course/courses.php");
    exit();

}




?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <h1 class="mb-3">Add Course</h1>
            <form method="post" enctype="multipart/form-data" >
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="courseName" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="courseName" name="courseName" >
                    </div>
                    <div class="col-md-6">
                        <label for="type" class="form-label">Course Type</label>
                        <input type="text" class="form-control" id="type" name="type" >
                    </div>
                    <div class="col-md-6">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    <div class="col-md-6 rounded-circle">
                        <label for="file" class="form-label">File</label>
                        <input type="file" class="form-control border-light " id="file" name="file">
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" ></textarea>
                    </div>
                    <div class="col-12 pt-5">
                        <div class="row">
                            <div class="col-md-6 ">
                                <button type="submit" name="add_course" class="btn btn-success w-50 w-bold" >Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



