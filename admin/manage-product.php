<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Product</h1>
        <br />

        <a href="<?php echo SITEURL; ?>admin/add-product.php" class="btn-primary">Add Product</a>
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

        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove']; //displaying session data
            unset($_SESSION['failed-remove']); //removing session data
        }

        if (isset($_SESSION['no-product-found'])) {
            echo $_SESSION['no-product-found']; //displaying session data
            unset($_SESSION['no-product-found']); //removing session data
        }
        
         
        ?>

        <table class="tbl-full">
            <tr>
                <th>Product ID</th>
                <th>Product Title</th>
                <th>Category</th>
                <th>Product Description</th>
                <th>Product Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>

            <?php

            $sql = "SELECT * FROM product";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                $id = 1;

                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $productID = $rows['productID'];
                        $productTitle = $rows['productTitle'];
                        $categoryID = $_POST['categoryID'];
                        $productDesc = $rows['productDesc'];
                        $productImage = $rows['productImage'];
                        $price = $rows['price'];
                        $quantity = $rows['quantity'];
            ?>
                        <tr>
                            <td><?php echo $productID; ?></td>
                            <td><?php echo $productTitle; ?></td>
                            <td><?php echo $categoryID; ?></td>
                            <td><?php echo $productDesc; ?></td>

                            <td>

                                <?php

                                if ($productImage != "") {
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/product/<?php echo $productImage; ?>" width="100" height="100">
                                <?php
                                } else {
                                    echo "<div class='error'>Image not Added</div>";
                                }

                                ?>

                            </td>

                            <td><?php echo $price; ?></td>
                            <td><?php echo $quantity; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-product.php?productID=<?php echo $productID; ?>" class="btn-secondary">Update Product</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-product.php?productID=<?php echo $productID; ?>&productImage=<?php echo $productImage; ?>" class="btn-danger">Delete Product</a>
                            </td>
                        </tr>
            <?php
                    }
                }
            }

            ?>
            
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>