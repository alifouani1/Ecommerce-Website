<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Product</h1>
        <br />
        <br />

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="productTitle" class="form-control" placeholder="Title of the product" required>
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea type="text" name="productDesc" cols="30" rows="5" class="form-control" placeholder="Description of the product" required></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" class="form-control">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="productImage">
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

                            if($count > 0){

                                while($row = mysqli_fetch_assoc($res)){

                                    $categoryID = $row['categoryID'];
                                    $categoryTitle = $row['categoryTitle'];

                                    ?>

                                        <option value="<?php echo $categoryID ?>"><?php echo $categoryTitle ?></option>

                                    <?php


                                }

                            }
                            else{
                                    
                                    echo "<option value='0'>No Category</option>";
    
                            }

                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Quantity:</td>
                    <td>
                        <input type="number" name="quantity" class="form-control">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="submit" value="Add Product" class="btn btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php

        if (isset($_POST['submit'])) {
            $productTitle = $_POST['productTitle'];
            $productDesc = $_POST['productDesc'];
            $productImage = $_POST['productImage'];
            $price = $_POST['price'];
            $categoryID = $_POST['categoryID'];
            $quantity = $_POST['quantity'];

            if(isset($_FILES['productImage']['name'])){
                $productImage = $_FILES['productImage']['name'];

                $ext = end(explode('.', $productImage));

                $productImage = "Product_Image_".rand(000, 999).".".$ext;   

                $source_path = $_FILES['productImage']['tmp_name']; 

                $destination_path = "../images/product/".$productImage;

                $upload = move_uploaded_file($source_path, $destination_path);

                if($upload==false){
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                    header("location:" . SITEURL . 'admin/add-product.php'); 
                }
            }
            else{
                $productImage="";
            }

            $sql2 = "INSERT INTO product SET 
            productTitle = '$productTitle', 
            productDesc = '$productDesc', 
            productImage = '$productImage',
            price = '$price', 
            categoryID = $categoryID,
            quantity = '$quantity'"; 

            $res = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

            if ($res == TRUE) {
                $_SESSION['add'] = "<div class='success'>Product added successfully</div>";
                header("location:" . SITEURL . 'admin/manage-product.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to add Product</div>";
                header("location:" . SITEURL . 'admin/manage-product.php');
            }
        }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>