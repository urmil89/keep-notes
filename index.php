<?php include 'header.php'; ?>
<?php require 'config.php'; ?>
<?php
$title = '';
$disc = '';
$row = '';
// calling functions
inotes();
idelete();
iupdate();

function inotes()
{
    global $title;
    global $conn;
    global $disc;
    if (isset($_POST['save'])) {
        $title = $_POST['title'];
        $disc = $_POST['description'];
        if (!$title == '' || !$disc == '') {
            $query = "INSERT INTO `notes` (`id`, `title`, `description`, `tstamp`) VALUES (NULL, '$title', '$disc', current_timestamp());";
            $result = mysqli_query($conn, $query);
            if ($result) {
                header('location:index.php');
            }
        }
    }
}


function idelete()
{

    global $conn;
    if (isset($_GET['did'])) {

        $id = $_GET['did'];
        $query = "DELETE FROM `notes` WHERE `notes`.`id` = '$id'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header('location:index.php');
        }
    }
}


function iupdate()
{

    global $id;
    global $title;
    global $conn;
    global $disc;

    if (isset($_POST['update'])) {

        $query = "UPDATE `notes` SET `title`='$title',`description`='$disc',`tstamp`='current_timestamp()' WHERE 1";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header('location:index.php');
        }
    }
}


if (isset($_GET['eid'])) {

    $id = $_GET['eid'];
    $query = "SELECT * FROM `notes` WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $_SESSION['update']=true;
}


?>



<!-- Main logic -->
<div class="container my-4">
    <h2>Add Your Note</h2>
    <form action="index.php" method="post">
        <div class="form-group">
            <label for="title">Note title</label>
            <input type="text" value="<?php echo $row['title'] ?>" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>
        </div>
        <div class="form-group">
            <label for="desc">Note Description</label>
            <textarea class="form-control" name="description" id="desc" rows="3" required><?php echo $row['description']; ?></textarea>
        </div>
        <?php
        if (isset($_SESSION['update'])) {
        ?>
            <button type="submit" name="update" class="btn btn-warning">Update Note</button>
        <?php
        } else {
        ?>
            <button type="submit" name="save" class="btn btn-primary">Add Note</button>
        <?php
        }
        ?>
    </form>
</div>

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
            $query = "SELECT * FROM `notes`";
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

<?php include 'footer.php'; ?>