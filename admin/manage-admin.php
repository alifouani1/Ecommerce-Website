<?php include('partials/menu.php'); ?>

<!-- Menu Section Ends -->
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //displaying session data
            unset($_SESSION['add']); //removing session data
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete']; //displaying session data
            unset($_SESSION['delete']); //removing session data
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; //displaying session data
            unset($_SESSION['update']); //removing session data
        }

        if(isset($_SESSION['user-not-found'])){
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }

        if(isset($_SESSION['pwd-not-match'])){
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }

        if(isset($_SESSION['change-pwd'])){
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }
        ?>

        <br />
        <br />
        <br />

        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br />
        <br />
        <br />
        <table class="tbl-full">
            <tr>
                <th>Admin ID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>

            <?php

            $sql = "SELECT * FROM admin";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                $id = 1;

                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $adminID = $rows['adminID'];
                        $fullName = $rows['fullName'];
                        $userName = $rows['userName'];
            ?>
                        <tr>
                            <td><?php echo $id++; ?></td>
                            <td><?php echo $fullName; ?></td>
                            <td><?php echo $userName; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?adminID=<?php echo $adminID; ?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?adminID=<?php echo $adminID; ?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?adminID=<?php echo $adminID; ?>" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>
            <?php
                    }
                }
            }

            ?>

            <!-- <tr>
                <td>1</td>
                <td>Admin</td>
                <td>admin</td>
                <td>
                <a href="admin/delete-admin.php?adminID=" class="btn-primary">Change Password</a>

                    <a href="admin/update-admin.php" class="btn-secondary">Edit</a>
                    <a href="delete-admin.php" class="btn-danger">Delete</a>
                </td>
            </tr> -->

            <!--<tr>
                <td>2</td>
                <td>Admin</td>
                <td>admin</td>
                <td>
                    <a href="edit-admin.php" class="btn-secondory">Edit</a>
                    <a href="delete-admin.php" class="btn-danger">Delete</a>
                </td>
            </tr>

            <tr>
                <td>3</td>
                <td>Admin</td>
                <td>admin</td>
                <td>
                    <a href="edit-admin.php" class="btn-secondory">Edit</a>
                    <a href="delete-admin.php" class="btn-danger">Delete</a>
                </td>
            </tr> -->
        </table>


        <div class="clearfix">

        </div>
    </div>
</div>
<!-- Main Content Setion Ends -->
<?php include('partials/footer.php'); ?>