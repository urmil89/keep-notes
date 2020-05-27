<?php
session_start();
include 'config.php';

if(isset($_GET['did']))
{

    $id = $_GET['did'];
    $query="DELETE FROM `notes` WHERE `notes`.`id` = '$id'";
    $result=mysqli_query($conn,$query);
    if($result)
    {
        header('location:index.php');
        
    }
}
    
?>