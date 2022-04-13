<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br />

        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br />
        <br />
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

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload']; //displaying session data
            unset($_SESSION['upload']); //removing session data
        }

        if (isset($_SESSION['unauthorize'])) {
            echo $_SESSION['unauthorize']; //displaying session data
            unset($_SESSION['unauthorize']); //removing session data
        }

        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found']; //displaying session data
            unset($_SESSION['no-category-found']); //removing session data
        }

        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove']; //displaying session data
            unset($_SESSION['failed-remove']); //removing session data
        }        

        ?>

        <table class="tbl-full">
            <tr>
                <th>Category ID</th>
                <th>Category Title</th>
                <th>Category Image</th>
                <th>Action</th>
            </tr>

            <?php

            $sql = "SELECT * FROM category";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                $id = 1;

                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $categoryID = $rows['categoryID'];
                        $categoryTitle = $rows['categoryTitle'];
                        $categoryImage = $rows['categoryImage'];
            ?>
                        <tr>
                            <td><?php echo $categoryID; ?></td>
                            <td><?php echo $categoryTitle; ?></td>
                            <td>

                                <?php
                                
                                    if($categoryImage!=""){
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $categoryImage; ?>" width="100" height="100">
                                        <?php
                                    }
                                    else{
                                        echo "<div class='error'>Image not Added</div>";
                                    }
                                
                                ?>

                            </td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?categoryID=<?php echo $categoryID; ?>&categoryImage=<?php echo $categoryImage; ?>" class="btn-secondary">Update Category</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?categoryID=<?php echo $categoryID; ?>&categoryImage=<?php echo $categoryImage; ?>" class="btn-danger">Delete Category</a>
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
                    <a href="edit-admin.php" class="btn-secondary">Edit</a>
                    <a href="delete-admin.php" class="btn-danger">Delete</a>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>Admin</td>
                <td>admin</td>
                <td>
                    <a href="edit-admin.php" class="btn-secondary">Edit</a>
                    <a href="delete-admin.php" class="btn-danger">Delete</a>
                </td>
            </tr>

            <tr>
                <td>3</td>
                <td>Admin</td>
                <td>admin</td>
                <td>
                    <a href="edit-admin.php" class="btn-secondary">Edit</a>
                    <a href="delete-admin.php" class="btn-danger">Delete</a>
                </td>
            </tr> -->
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>