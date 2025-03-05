<?php
    if(isset($_POST['product_id'])){
        include "../config/connectDB.php";
        $product_id = $_POST['product_id'];
        $sql = "SELECT * FROM tblphone";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            echo "product ID: " . $row['id_phone'] . "</br>";
            if($product_id == $row['id_phone']){
                die("product id duplicated!");
            }
        }

        $product_name = $_POST['product_name'];
        $product_specs = $_POST['product_specs'];
        $product_description = $_POST['product_description'];
        $product_brand = $_POST['product_brand'];
        $product_mark = $_POST['product_mark'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];
        $product_status = $_POST['product_status'];
        $product_order = $_POST['product_order'];
        $product_file_name = $_FILES['product_image']['name'];
        echo "test" . $product_id . "</br>";
        echo "test" . $product_name . "</br>";
        echo "test" . $product_specs . "</br>";
        echo "test" . $product_description . "</br>";
        echo "test" . $product_mark . "</br>";
        echo "test" . $product_brand . "</br>";
        echo "test" . $product_price . "</br>";
        echo "test" . $product_status . "</br>";
        echo "test" . $product_quantity . "</br>";
        echo "test" . $product_order . "</br>";
        echo "test" . $product_file_name . "</br>";
    }
?>


<!--Add product form-->
<div class="form-container-add-product">
    <h1 class="">ADD PRODUCT FORM</h1>
    <div class="form-body-add-product">
        <form method="POST" action="index.php?p=products" enctype="multipart/form-data">
            <div class="product-php-container">
                <div class="product-general-information-container">
                    <h4>General Information</h4>
                    <div class="product-name-container">
                        <label for="">ID</label> </br>
                        <input type="text" placeholder="Product ID" name="product_id" required> </br>
                        <label for="">Name</label> </br>
                        <input type="text" placeholder="Product name" name="product_name" required> </br>
                    </div>

                    <div class="product-specs-container">
                        <div class="product-specs">
                            <label for="">Specs</label> </br>
                            <input type="text" name="product_specs" placeholder="Product specs" required>
                        </div>

                        <div class="product-description">
                            <label for="">Short description</label> </br>
                            <textarea name="product_description" cols="50" rows="10" placeholder="Product description" required></textarea>
                        </div>
                    </div>

                    <div class="product-brand-container">
                        <div class="product-brand">
                            <label for="">Product brand</label> </br>
                            <input type="text" name="product_brand" placeholder="Example: Apple..." required>
                        </div>
                        <div class="product-mark">
                            <label for="">Product Mark</label> </br>
                            <select name="product_mark" id="" required >
                                <!-- <option value=""></option> -->
                                <option value="New release">New Releasing</option>
                                <option value="New">New</option>
                                <option value="Second hand">Second Hand</option>
                            </select>
                        </div>

                        <div class="product-price">
                            <label for="">Price</label> </br>
                            <input type="text" name="product_price" placeholder="Product price" required>
                        </div>
                        <div class="product-quantity">
                            <label for="">Quantity</label></br>
                            <input type="text" name="product_quantity" placeholder="Product quantity" required>
                        </div>
                        <div class="product-status">
                            <label for="">Status</label> </br>
                            <select name="product_status" id="" required>
                                <option value="Available">Available</option>
                                <option value="Out of Stock">Out of Stock</option>
                            </select>
                        </div>
                        <div class="product-order">
                            <label for="">Order</label></br>
                            <input type="number" name="product_order" placeholder="Product order number" required>
                        </div>
                    </div>
                </div>

                <div class="add-image-product-container">
                    <h4>Product Image</h4>
                    <div class="product-image-container">
                        <img id="choosen-image" src="" alt="Product Image">
                        <p id="file-name"></p>
                    </div>
                    <div class="submit">
                        <input type="file" name="product_image" id="upload-button" accept="image/*" required>
                        <label for="upload-button">
                            <i class="fa-solid fa-upload"></i> &nbsp; Upload Image
                        </label>
                    </div>
                </div>
            </div>
            <div class="submit-button">
                <input type="submit"  value="Add product">
            </div>
        </form>
    </div>
</div>
<!--Add product form-->