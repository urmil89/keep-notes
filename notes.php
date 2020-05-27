<?php
require 'config.php';

$title=$_POST['title'];
$disc=$_POST['desc'];
if(isset($_POST['save']))
{
    if(!$title=='' || !$disc=='')
    {
        $query="INSERT INTO `notes` (`id`, `title`, `description`, `tstamp`) VALUES (NULL, '$title', '$disc', current_timestamp());";
        $result=mysqli_query($conn,$query);
        if($result)
        {
            header('location:index.php');
        }
    }
}
