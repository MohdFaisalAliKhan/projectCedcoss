<?php
include('configDatabase2.php');
if(isset($_GET['ID'])){
    $courseID = $_GET['ID'];
    header('location:categories.php');
}
//     $sql_delete = "DELETE FROM products WHERE `product_id` = $courseID";        
//     $result = mysqli_query($conn ,$sql_delete);
//      if(mysqli_affected_rows($conn)>0) {
//         header('location:products.php?result=success');
//     } else {
//         header('location:products.php?result=fail');
//     }
//    }
?>