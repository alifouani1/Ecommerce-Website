<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Product</h1>
        <br />
        <br />

        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; //displaying session data
            unset($_SESSION['update']); //removing session data
        }
        ?>

        <?php

        if (isset($_GET['productID'])) {
            $productID = $_GET['productID']; //getting adminID from URL

            $sql2 = "SELECT * FROM product WHERE productID='$productID'"; //SQL query to select admin

            $res2 = mysqli_query($conn, $sql2); //executing the query

            $count = mysqli_num_rows($res2); //counting the number of rows

            if ($count == 1) {
                $row = mysqli_fetch_assoc($res2); //fetching the data from the database
                $productID = $row['productID'];
                $currentProductImage = $row['productImage'];
            } else {
                $_SESSION['no-product-found'] = '<div class="error">No product found!</div>';
                header('location:' . SITEURL . 'admin/manage-product.php');
            }
        }
        ?>



        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="productTitle" class="form-control" placeholder="Title of the product" value="<?php echo $productTitle ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea type="text" name="productDesc" cols="30" rows="5" class="form-control" placeholder="Description of the product"><?php echo $productDesc ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" class="form-control" value="<?php echo $price ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php

                        if ($currentProductImage != "") {
                        ?>

                            <img src="<?php echo SITEURL . 'images/product/' . $currentProductImage; ?>" width="100" height="100">
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
                    <td>Category: </td>
                    <td>
                        <select name="categoryID">

                            <?php

                            $sql = "SELECT * FROM category";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            if ($count > 0) {

                                while ($row = mysqli_fetch_assoc($res)) {

                                    $categoryID = $row['categoryID'];
                                    $categoryTitle = $row['categoryTitle'];

                            ?>

                                    <option value="<?php echo $categoryID ?>"><?php echo $categoryTitle ?></option>

                            <?php


                                }
                            } else {

                                echo "<option value='0'>No Category</option>";
                            }

                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Quantity:</td>
                    <td>
                        <input type="number" name="quantity" class="form-control" value="<?php echo $quantity ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="productID" value="<?php echo $productID; ?>">
                        <input type="submit" name="submit" value="Update Product" class="btn btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>



<?php

if (isset($_POST['submit'])) {
    $productID = $_POST['productID'];
    $productTitle = $_POST['productTitle'];
    $productDesc = $_POST['productDesc'];
    $currentProductImage = '$currentProductImage';
    $price = $_POST['price'];
    $categoryID = $_POST['categoryID'];
    $quantity = $_POST['quantity'];


    if (isset($_FILES['image']['name'])) {
        $productImage = $_FILES['image']['name'];

        if ($productImage != "") {

            $ext = end(explode('.', $productImage));

            $productImage = "Product_Image_" . rand(000, 999) . "." . $ext;

            $source_path = $_FILES['productImage']['tmp_name'];

            $destination_path = "../images/product/" . $productImage;

            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                header("location:" . SITEURL . 'admin/manage-product.php');
                die();
            }

            if ($currentProductImage != "") {

                $remove_path = "../images/product/" . $currentProductImage;
                $remove = unlink($remove_path);

                if ($remove == false) {
                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                    header('location:' . SITEURL . 'admin/manage-product.php');

                    die();
                }
            }
        } else {
            $productImage = $currentProductImage;
        }
    } else {
        $productImage = $currentProductImage;
    }



    $sql = "UPDATE product SET 
        productTitle = '$productTitle', 
        productDesc = '$productDesc',
        productImage = '$productImage', 
        price = '$price', 
        categoryID = $categoryID,
        quantity = '$quantity' 
        WHERE productID = '$productID'";

    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $_SESSION['update'] = "<div class='success'>Product Updated Successfully</div>";
        header("location:" . SITEURL . 'admin/manage-product.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to Update Product</div>";
        header("location:" . SITEURL . 'admin/update-product.php?productID=' . $productID);
    }
}

?>

<?php include('partials/footer.php'); ?>