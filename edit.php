
<?php require 'config.php'; ?>
<?php

$eid = $_GET['eid'];

if(isset($_GET['eid']))
{

    if (isset($_POST['update'])) {
        $query = "UPDATE notes SET $title='$title',$desc='$desc' WHERE $id='$eid'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header('location:home.php');
        }
    }
    
}
?>

<?php include 'header.php'; ?>

<!-- Edit Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Notes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--  -->
                <form action="edit.php" method="post">
                    <div class="form-group">
                        <label for="title">Note title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="desc">Note Description</label>
                        <textarea class="form-control" name="desc" id="desc" rows="3" required></textarea>
                    </div>
                    <button type="submit" name="save" class="btn btn-primary">Add Note</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>