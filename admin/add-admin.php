<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br />
        <br />
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="fullName" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="userName" placeholder="Enter Your Username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter Your Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php'); ?>

<?php

if (isset($_POST['submit'])) {
    //echo "Button Clicked";
    //1. Get the Data from form
    $fullName = $_POST['fullName'];
    $userName = $_POST['userName'];
    $password = md5($_POST['password']); //Password Encryption with MDS

    $sql = "INSERT INTO admin SET
    fullName='$fullName',
    userName='$userName',
    password='$password'
    ";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($res == TRUE) {
        // echo "Data Inserted";
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        // echo "Data Not Inserted";
        $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
        header("location:" . SITEURL . 'admin/add-admin.php');
    }
}

?>