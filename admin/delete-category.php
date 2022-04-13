<?php

include('../config/constants.php'); //including constants file

if (isset($_GET['categoryID']) && isset($_GET['categoryImage'])) {

    $categoryID = $_GET['categoryID']; //getting adminID from URL    
    $categoryImage = $_GET['categoryImage']; //getting adminID from URL

    if($categoryImage != ""){
        $path = "../images/category/".$categoryImage; //path to delete image
        $remove = unlink($path); //deleting image

        if($remove == false){
            $_SESSION['upload'] = "<div class='error'>Failed to remove Image File.</div>";
            header('location:' .SITEURL. 'admin/manage-category.php');

            die();
        }
    }

    $sql = "DELETE FROM category WHERE categoryID='$categoryID'"; //SQL query to delete admin

    $res = mysqli_query($conn, $sql); //executing the query

    if ($res == TRUE) {
        // echo "Data Deleted";
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
        header("location:" . SITEURL . 'admin/manage-category.php');
    }
    else {
        $_SESSION['unauthorize'] = "<div class='error'>Failed to Delete Category</div>";
        header("location:" . SITEURL . 'admin/manage-category.php');
    }
}
