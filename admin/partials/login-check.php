<?php 

    if(!isset($_SESSION['user'])){ // if user is not logged in
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login to access Admin Panel.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>