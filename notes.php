<?php
require 'config.php';

$title=$_POST['title'];
$desc=$_POST['desc'];
if(isset($_POST['save']))
{
    if(!$title=='' || !$desc=='')
    {
        $query="INSERT INTO `notes` (`id`, `title`, `description`, `tstamp`) VALUES (NULL, '$title', '$desc', current_timestamp());";
        $result=mysqli_query($conn,$query);
        if($result)
        {

            header('location:index.php');
        }
    }
}
