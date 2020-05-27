<?php require 'config.php'; ?>
<?php

$id = $_GET['eid'];

if (isset($_GET['eid'])) {
    $id = $_GET['eid'];

    $query = "SELECT * FROM `notes` WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $query = "UPDATE `notes` SET `title`='$title',`description`='$disc',`tstamp`='current_timestamp()' WHERE 1";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header('location:index.php');
    }
}

?>

<?php include 'header.php'; ?>

<!-- Edit Notes -->

<?php include 'footer.php'; ?>