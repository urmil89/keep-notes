<?php
include 'header.php';

// db connection 
$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DATABASE = 'keep';
$conn = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);
if (!$conn) {
    echo mysqli_error($conn) or die("connection failed.");
}


if (!isset($_SESSION['user_id'])) {

    // when user not set
    if (isset($_POST['isignup'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($username != '' && $password != '') {
            $query = "SELECT * FROM `signup` WHERE username ='$username' && password = '$password'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_num_rows($result);
            if ($row > 0) {
                $_SESSION['msg'] = " try different Username or Password";
?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Please</strong><?php echo $_SESSION['msg']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
    <?php
            } else {
                $query = "INSERT INTO `signup` (`id`, `username`, `password`) VALUES (NULL, '$username', '$password');";
                $result = mysqli_query($conn, $query);
                $id = mysqli_insert_id($conn);
                if ($result) {
                    $_SESSION['user_id'] = $id; 
                    $_SESSION["user_name"] = $username;
                    $_SESSION["msg"] = "Signup Successfully";
                    header('location:index.php');
                } else {
                    header('location:index.php');
                }
            }
        }
    }
    if (isset($_POST['ilogin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($username != '' && $password != '') {
            $query = "SELECT * FROM `signup` WHERE username ='$username' && password = '$password'";
            $result = mysqli_query($conn, $query);
            if ($row = mysqli_fetch_assoc($result)) {
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["user_name"] = $row["username"];
                $_SESSION["msg"] = "Login Successfully";
                header("location:index.php");
            } else {
                $_SESSION["msg"] = "Invalid Username or Password";
                header("location:index.php");
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
                        <button class="btn btn-primary" name="isignup" type="submit">Submit</button>
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
                <button class="btn btn-primary" name="ilogin" type="submit">Submit</button>
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


<?php


} else {

    // Main else part strat

    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM `notes` WHERE user_id=$user_id";
    $result = mysqli_query($conn, $query);



    if (isset($_GET["logout"])) {
        session_unset();
        session_destroy();
        header("location:index.php");
    }


    //add note php
    if (isset($_POST['save'])) {
        $user_id = $_SESSION["user_id"];
        $title = $_POST['title'];
        $disc = $_POST['description'];
        if (!$title == '' || !$disc == '') {
            $query = "INSERT INTO `notes` (`id`, `title`, `description`, `tstamp`,`user_id`) VALUES (NULL, '$title', '$disc', current_timestamp(),$user_id);";
            $result = mysqli_query($conn, $query);
            if ($result) {
                header('location:index.php');
            }
        }
    }

    // delete note php
    if (isset($_GET['did'])) {

        $user_id = $_SESSION["user_id"];
        $id = $_GET['did'];
        $query = "DELETE FROM `notes` WHERE `id` = '$id' AND `user_id` = $user_id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header('location:index.php');
        }
    }

    //update note php
    if (isset($_POST['update'])) {

        $user_id = $_SESSION["user_id"];
        $id = $_POST['id'];
        $title = $_POST['title'];
        $disc = $_POST['description'];
        $query = "UPDATE `notes` SET `title`='$title',`description`='$disc',`tstamp`=current_timestamp() WHERE id = '$id' AND `user_id` = $user_id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header('location:index.php');
        }
    }

?>

    <?php

    if (isset($_GET['eid'])) {

        $id = $_GET['eid'];
        $query = "SELECT * FROM `notes` WHERE id = $id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        $_SESSION['update'] = true;
    ?>

        <div class="container my-4">
            <h2>Add Your Note</h2>
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="title">Note title</label>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="text" value="<?php echo $row['title'] ?>" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                    <label for="desc">Note Description</label>
                    <textarea class="form-control" name="description" id="desc" rows="3" required><?php echo $row['description']; ?></textarea>
                </div>
                <button type="submit" name="update" class="btn btn-warning">Update Note</button>
            </form>
        </div>
    <?php
    }else{
       ?>
    <div class="container my-4">
        <h2>Add Your Note</h2>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="title">Note title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>
            </div>
            <div class="form-group">
                <label for="desc">Note Description</label>
                <textarea class="form-control" name="description" id="desc" rows="3" required></textarea>
            </div>
            <button type="submit" name="save" class="btn btn-primary">Add Note</button>
        </form>
    </div>
    <?php
    }
    ?>

    <div class="container my-4">
        
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Sr.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date & Time</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $user_id = $_SESSION["user_id"];
                $query = "SELECT * FROM `notes` WHERE `user_id` = '$user_id'";
                $result = mysqli_query($conn, $query);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno = $sno + 1;
                    ?>
                    <tr>
                        <th scope='row'><?php echo $sno; ?></th>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo $row['description'] ?></td>
                        <td><?php echo $row['tstamp'] ?></td>
                        <td><a href="index.php?eid=<?php echo $row['id']; ?>"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Edit</button></a> <a href="index.php?did=<?php echo $row['id']; ?>"><button type="button" class="btn btn-danger">Delete</button></a></td>
                        <?php
                }
                    ?>
            </tbody>
        </table>

    </div>
    <hr>
<?php

}

?>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!-- Bootstrap js /close -->


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>


<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

</body>

</html>


<!-- Footer here -->