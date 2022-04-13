<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br />
        <br />

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="categoryTitle" class="form-control" placeholder="Title of the category" required>
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="categoryImage">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="submit" value="Add Category" class="btn btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php

        if (isset($_POST['submit'])) {
            $categoryTitle = $_POST['categoryTitle'];
            $categoryImage = $_POST['categoryImage'];

            if (isset($_FILES['categoryImage']['name'])) {
                $categoryImage = $_FILES['categoryImage']['name'];

                if ($categoryImage != "") {

                    $ext = end(explode('.', $categoryImage));

                    $categoryImage = "Product_Category_" . rand(000, 999) . "." . $ext;

                    $source_path = $_FILES['categoryImage']['tmp_name'];

                    $destination_path = "../images/category/" . $categoryImage;

                    $upload = move_uploaded_file($source_path, $destination_path);

                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                        header("location:" . SITEURL . 'admin/add-category.php');
                        die();
                    }
                }
            } else {
                $categoryImage = "";
            }

            $sql2 = "INSERT INTO category SET 
            categoryTitle = '$categoryTitle', 
            categoryImage = '$categoryImage'";

            $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

            if ($res2 == TRUE) {
                $_SESSION['add'] = "<div class='success'>Category added successfully</div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to add Category</div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
            }
        }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>