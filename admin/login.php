<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ecommerce System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

    <div class="login">
        <h1 class="text-center">Login</h1>
        <br>
        <br>

        <?php 
        
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        
        ?>

        <form action="" method="POST" class="text-center"> 
        Username: 
        <br>
        <input type="text" name="userName" placeholder="Enter Username" required><br><br>
        Password: 
        <br>
        <input type="password" name="password" placeholder="Enter Password" required><br><br>
        <input type="submit" name="submit" value="Login" class="btn-primary">
        <br>
        <br>
        </form>

    </div>
    
</body>
</html>

<?php 

    if(isset($_POST['submit'])){
        $userName = $_POST['userName'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM admin WHERE userName = '$userName' AND password = '$password'";

        $res = mysqli_query($conn, $sql);

        // if($res == TRUE){
        //     $count = mysqli_num_rows($res);

        //     if($count > 0){
        //         $_SESSION['userName'] = $userName;
        //         header("Location: index.php");
        //     }else{
        //         echo "<script>alert('Invalid Username or Password')</script>";
        //     }
        // }
        $count = mysqli_num_rows($res);
        if($count==1){
        //user AVailable and Login Success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";

        // $_SESSION['userName'] = $userName;

        //REdirect to HOme Page/Dashboard
        header('location:'.SITEURL.'admin/');
        }
        else{
        //User Not Available
        $_SESSION['login'] = "<div class='error text-center'>Invalid Username or Password</div>";
        //REdirect to Login Page
        header('location:'.SITEURL.'admin/login.php');
        }
    }   

?>