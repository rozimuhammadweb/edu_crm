<?php

session_start();
include '../admin/connectDB.php';

if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['userEmail'];
    $number = $_POST['number'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if(!is_valid_username($username)) {
        $_SESSION['error'] = "Invalid username.";
        header('Location: register.php');
        exit();
    }

    if(!is_valid_email($email)) {
        $_SESSION['error'] = "Invalid email.";
        header('Location: register.php');
        exit();
    }

    if(!is_valid_password($password)) {
        $_SESSION['error'] = "Invalid password.";
        header('Location: register.php');
        exit();
    }

    if(!is_valid_number($number)) {
        $_SESSION['error'] = "Invalid number.";
        header('Location: register.php');
        exit();
    }

    if(isset($_SESSION['error'])) {
        echo $_SESSION['error'];
    } else {
        header('Location: login.php');
        exit();
    }

}

function is_valid_username($username) {
    return preg_match('/^[a-zA-Z0-9_]{5,20}$/', $username);
}

function is_valid_email($email) {
    return preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]+$/', $email);
}

function is_valid_password($password) {
    return preg_match('/^^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%^*]).*$/', $password);
}

function is_valid_number($number) {
    return preg_match('/^[0-9]{10}$/', $number);
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registration</p>

                                <form class="mx-1 mx-md-4" method="post">

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="username" name="username" class="form-control" />
                                            <label class="form-label" for="username">Username</label>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="email" id="userEmail" name="userEmail" class="form-control" />
                                            <label class="form-label" for="userEmail" >Email</label>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="number" name="number" class="form-control" />
                                            <label class="form-label" for="number" >Number</label>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" id="password" name="password" class="form-control" />
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                    </div>

                                    <div class="form-check d-flex justify-content-center mb-5">
                                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                                        <label class="form-check-label" for="form2Example3">
                                            I agree all statements in <a href="#">Terms of service</a>
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-between ">
                                        <input type="submit" class="btn btn-primary mr-3" name="register">
                                        <a class="mt-2" href="../login/login.php">Login</a>
                                    </div>
                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">

                                    </div>
                                </form>
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                     class="img-fluid" alt="Sample image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>