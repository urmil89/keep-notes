<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Notes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">My Notes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Keep your notes <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav">

                <?php
                if (isset($_SESSION["user_id"])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Welcome, <?php echo $_SESSION["user_name"]; ?></a>
                    </li>
                    <button class="btn btn-outline-success ml-3 pr-3 pl-3" type="submit" onclick="location.href='index.php?logout'">Logout</button>
                <?php
                }
                ?>
            </ul>
        </div>
    </nav>