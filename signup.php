<?php
session_start();
require 'config.php';
include 'header.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username != '' && $password != '') {
        $query = "SELECT * FROM `signup` WHERE username ='$username' && password = '$password'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        if ($row > 0) {
            $msg = "Please try different Username or Password";
            echo $msg;
        } else {

            if ($result) {
                header('location:index.php');
            } else {

                header('location:signup.php');
            }

            $query = "INSERT INTO `signup` (`id`, `username`, `password`) VALUES (NULL, '$username', '$password');";
            $result = mysqli_query($conn, $query);
            if ($result) {
                $_SESSION['user'] = $username;
                header('location:index.php');
            } else {
                header('location:signup.php');
            }
        }
    }
}

?>



<div class="container text-center mt-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Signup Form -->
            <h1>SignUp</h1>
            <form class="needs-validation" novalidate method="post" action="index.php">
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="validationCustomUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                            </div>
                            <input type="text" name="username" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="validationCustomUsername">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputpassword">#</span>
                            </div>
                            <input type="password" name="password" class="form-control" id="validationCustomPassword" aria-describedby="inputpassword" required>
                            <div class="invalid-feedback">
                                Please choose a password.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 mb-3">
                        <div class="form-check custom-control custom-checkbox form-check">
                            <input class="form-check-input custom-control-input" type="checkbox" id="invalidCheck" required>
                            <label class="custom-control-label" for="invalidCheck">
                                Agree to terms and conditions
                            </label>
                        </div>
                        <div class="invalid-feedback">
                            You must agree before submitting.
                        </div>
                    </div>
                    <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                    <div>
                    </div>
            </form>

        </div>
        </div>



        <!-- Login Form -->
            <div class="col-md-6">
                <h1>Login</h1>
                <form class="needs-validation" novalidate method="post" action="index.php">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustomUsername">Username</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                </div>
                                <input type="text" name="username" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Please choose a username.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustomUsername">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputpassword">#</span>
                                </div>
                                <input type="password" name="password" class="form-control" id="validationCustomPassword" aria-describedby="inputpassword" required>
                                <div class="invalid-feedback">
                                    Please choose a password.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 mb-3">
                            <div class="form-check custom-control custom-checkbox form-check">
                                <input class="form-check-input custom-control-input" type="checkbox" id="invalidCheck" required>
                                <label class="custom-control-label" for="invalidCheck">
                                    Agree to terms and conditions
                                </label>
                            </div>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                        </div>
                        <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                        <div>
                        </div>
                </form>
            </div>
    </div>
</div>






        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>


    </div>



    <?php include 'footer.php'; ?>