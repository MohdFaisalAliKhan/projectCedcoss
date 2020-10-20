<?php
include('configDatabase2.php');
if(isset($_GET['ID'])) {
    $ID = $_GET['ID'];
    $sql_delete = "DELETE FROM `colors` WHERE `color_id` = $ID";        
    $result = mysqli_query($conn ,$sql_delete);
     if(mysqli_affected_rows($conn)>0) {
        header('location:colors.php?result=success');
    } else {
        header('location:colors.php?result=fail');
    }
   }
?>