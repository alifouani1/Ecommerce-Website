<?php

    include('../config/constants.php'); //including constants file

    $adminID = $_GET['adminID']; //getting adminID from URL    

    $sql = "DELETE FROM admin WHERE adminID='$adminID'"; //SQL query to delete admin

    $res = mysqli_query($conn, $sql); //executing the query

    if($res==TRUE){
        // echo "Data Deleted";
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>"; 
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{
        // echo "Data Not Deleted";
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin</div>";
        header("location:".SITEURL.'admin/manage-admin.php');
    }    



?>