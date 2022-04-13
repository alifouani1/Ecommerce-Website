<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br />
        <br />

        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; //displaying session data
            unset($_SESSION['update']); //removing session data
        }
        ?>

        <?php

        $adminID = $_GET['adminID']; //getting adminID from URL

        $sql = "SELECT * FROM admin WHERE adminID='$adminID'"; //SQL query to select admin

        $res = mysqli_query($conn, $sql); //executing the query

        if ($res == TRUE) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $rows = mysqli_fetch_assoc($res);
                $fullName = $rows['fullName'];
                $userName = $rows['userName'];
            } else {
                header("location:" . SITEURL . 'admin/manage-admin.php');
            }
        }

        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="fullName" placeholder="Enter Your Name" value="<?php echo $fullName; ?>"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="userName" placeholder="Enter Your Username" value="<?php echo $userName; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="adminID" value="<?php echo $adminID; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

if (isset($_POST['submit'])) {
    $adminID = $_POST['adminID'];
    $fullName = $_POST['fullName'];
    $userName = $_POST['userName'];

    $sql = "UPDATE admin SET 
    fullName = '$fullName', 
    userName = '$userName' 
    WHERE adminID = '$adminID'";

    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to Update Admin</div>";
        header("location:" . SITEURL . 'admin/update-admin.php?adminID=' . $adminID);
    }
}

?>

<?php include('partials/footer.php'); ?>