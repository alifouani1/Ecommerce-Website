<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br />
        <br />

        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; //displaying session data
            unset($_SESSION['update']); //removing session data
        }
        ?>

        <?php

        if (isset($_GET['categoryID'])) {
            $categoryID = $_GET['categoryID']; //getting adminID from URL

            $sql2 = "SELECT * FROM category WHERE categoryID='$categoryID'"; //SQL query to select admin

            $res2 = mysqli_query($conn, $sql2); //executing the query

            $count = mysqli_num_rows($res2); //counting the number of rows

            if ($count == 1) {
                $row = mysqli_fetch_assoc($res2); //fetching the data from the database
                $categoryID = $row['categoryID'];
                $currentCategoryImage = $row['categoryImage'];
            } else {
                $_SESSION['no-category-found'] = '<div class="error">No category found!</div>';
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="categoryTitle" class="form-control" placeholder="Title of the category" value="<?php echo $categoryTitle ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php

                        if ($currentCategoryImage != "") {
                        ?>

                            <img src="<?php echo SITEURL . 'images/category/' . $currentCategoryImage; ?>" width="100" height="100">
                        <?php
                        } else {

                            echo "<div class='error'>No image found!</div>";
                        }

                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="currentCategoryImage" value="<?php echo $currentCategoryImage; ?>">
                        <input type="hidden" name="categoryID" value="<?php echo $categoryID; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>



<?php

if (isset($_POST['submit'])) {
    $categoryID = $_POST['categoryID'];
    $categoryTitle = $_POST['categoryTitle'];
    $currentCategoryImage = $_POST['currentCategoryImage'];

    if (isset($_FILES['image']['name'])) {
        $categoryImage = $_FILES['image']['name'];

        if ($categoryImage != "") {

            $ext = end(explode('.', $categoryImage));

            $categoryImage = "Product_Category_" . rand(000, 999) . "." . $ext;

            $source_path = $_FILES['categoryImage']['tmp_name'];

            $destination_path = "../images/category/" . $categoryImage;

            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
                die();
            }

            if ($currentCategoryImage != "") {

                $remove_path = "../images/category/" . $currentCategoryImage;
                $remove = unlink($remove_path);

                if ($remove == false) {
                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                    header('location:' . SITEURL . 'admin/manage-category.php');

                    die();
                }
            }
        } else {
            $categoryImage = $currentCategoryImage;
        }
    } else {
        $categoryImage = $currentCategoryImage;
    }

    $sql2 = "UPDATE category SET 
        categoryTitle = '$categoryTitle', 
        categoryImage = '$categoryImage', 
        WHERE categoryID = '$categoryID'";

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == TRUE) {
        $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
        header("location:" . SITEURL . 'admin/manage-category.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to Update Category</div>";
        header("location:" . SITEURL . 'admin/update-category.php?categoryID=' . $categoryID);
    }
}

?>

<?php include('partials/footer.php'); ?>