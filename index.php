<?php include 'header.php'; ?>
<?php require 'config.php'; ?>

<!-- Main logic -->
<div class="container my-4">
    <h2>Add Your Note</h2>
    <form action="notes.php" method="post">
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
                   <td><a href="edit.php?eid="<?php echo $sno;?>"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Edit</button></a> <a href="delete.php?did="<?php echo $sno;?>"><button type="button" class="btn btn-danger">Delete</button></a></td>
                <?php
            }
            ?>
        </tbody>
    </table>



</div>
<hr>

<?php include 'footer.php'; ?>