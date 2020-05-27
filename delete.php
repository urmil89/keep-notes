<?php

if(isset($_POST['delete']))
{
    $query="DELETE $title='$title',$desc='$desc' WHERE $id='$id'";
    $result=mysqli_query($conn,$query);
    if($result)
    {
        header('location:home.php');
    }
}

?>