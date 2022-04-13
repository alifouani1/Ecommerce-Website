<?php

include('../config/constants.php'); //including constants file

if (isset($_GET['productID']) && isset($_GET['productImage'])) {

    $productID = $_GET['productID']; //getting adminID from URL    
    $productImage = $_GET['productImage']; //getting adminID from URL

    if($productImage != ""){
        $path = "../images/product/".$productImage; //path to delete image
        $remove = unlink($path); //deleting image

        if($remove == false){
            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove Image File.</div>";
            header('location:' .SITEURL. 'admin/manage-product.php');

            die();
        }
    }

    $sql = "DELETE FROM product WHERE productID='$productID'"; //SQL query to delete admin

    $res = mysqli_query($conn, $sql); //executing the query

    if ($res == TRUE) {
        // echo "Data Deleted";
        $_SESSION['delete'] = "<div class='success'>Product Deleted Successfully</div>";
        header("location:" . SITEURL . 'admin/manage-product.php');
    }
    else {
        $_SESSION['unauthorize'] = "<div class='error'>Failed to Delete Product</div>";
        header("location:" . SITEURL . 'admin/manage-product.php');
    }
}
