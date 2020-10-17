<?php
include('configDatabase2.php');
if(isset($_GET['ID'])){
    $courseID = $_GET['ID'];
    $sql_delete = "DELETE FROM categories WHERE `category_id` = $courseID";        
    $result = mysqli_query($conn ,$sql_delete);
     if(mysqli_affected_rows($conn)>0) {
        header('location:categories.php?result=success');
    } else {
        header('location:categories.php?result=fail');
    }
   }
?>