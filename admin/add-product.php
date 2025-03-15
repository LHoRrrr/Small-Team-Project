<?php

use LDAP\Result;

include "../config/connectDB.php"; 

// Close the database connection
?>
    <?php 
        if (isset($_POST['product_id'])) {
            $product_id = trim($_POST['product_id']);
        
            // Check if the product ID already exists
            $stmt = $conn->prepare("SELECT id_phone FROM tblphone WHERE id_phone = ?");
            $stmt->bind_param("s", $product_id); // Use "s" for string
            $stmt->execute();
            $stmt->store_result(); // Store the result to check row count
        
            if ($stmt->num_rows == 0) {
                // Insert data into the database if product ID is unique
                if (isset($_POST['product_name'], $_POST['product_specs'], $_POST['product_description'], $_POST['product_brand'], $_POST['product_mark'], $_POST['product_price'], $_POST['product_quantity'], $_POST['product_status'], $_POST['product_order'])) {
                    
                    // Sanitize and validate the input data
                    $product_name = $_POST['product_name'];
                    $product_specs = $_POST['product_specs'];
                    $product_description = $_POST['product_description'];
                    $product_brand = $_POST['product_brand'];
                    $product_mark = $_POST['product_mark'];
                    $product_price = $_POST['product_price'];
                    $product_quantity = $_POST['product_quantity'];
                    $product_status = $_POST['product_status'];
                    $product_order = $_POST['product_order'];
        
        
                    // Handle the product image upload
                    $photo_path = "";
                    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
                        $target_dir = "../img/";  // Set your upload directory
                        $photo_path = $target_dir . basename($_FILES['product_image']['name']);
                        $photo_path_file = basename($_FILES['product_image']['name']);
        
                        // Move the uploaded image to the correct directory
                        if (!move_uploaded_file($_FILES['product_image']['tmp_name'], $photo_path)) {
                            echo json_encode(["error" => "Failed to upload the image."]);
                            exit;
                        }
                    }
        
                    // Prepare the insert query
                    $insertQuery = "INSERT INTO tblphone (id_phone, name_phone, price_phone, space_phone, description_phone, photo_phone, brand_phone, status_phone, mark_phone, total_quantity, order_phone)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
                    $insertStmt = $conn->prepare($insertQuery);
                    $insertStmt->bind_param("ssissssssii", $product_id, $product_name, $product_price, $product_specs, $product_description, $photo_path_file, $product_brand, $product_status, $product_mark, $product_quantity, $product_order);
        
                    // Execute the insert query
                    if (!($insertStmt->execute())) {
                        echo json_encode(["error" => "Failed to add the product"]);
                    }else {
                        header("Location: index.php?p=products");
                    }
                } else {
                    echo json_encode(["error" => "Missing required form fields."]);
                }
            } else {
                
            }
            // Close the statement
            
            $stmt->close();
        } 
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Add Product</title>
  <link href="endor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/product-list-style.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
      .submit-button {
        width: 100%;
        display: flex;
        justify-content: space-around;
      }
      .submit-button input {
        width: 20%;
      }
      .submit-button a {
        width: 20%;
      }
    </style>
</head>
<body>

    <!--Add product form-->
    <div class="form-container-add-product">
    <h1 class="">ADD PRODUCT </h1>
    <div class="form-body-add-product">
        <form method="POST" action="add-product.php" enctype="multipart/form-data">
            <div class="product-php-container">
                <div class="product-general-information-container">
                    <h4>General Information</h4>
                    <div class="product-name-container">
                        <label for="id">ID</label> </br>
                        <input type="text" id="id" placeholder="Product ID" name="product_id" required> </br>
                        <label for="name">Name</label> </br>
                        <input type="text" placeholder="Product name" id="name" name="product_name" required> </br>
                    </div>
                    
                    <div class="product-specs-container">
                        <div class="product-specs">
                            <label for="specs">Specs</label> </br>
                            <input type="text" name="product_specs" id="specs" placeholder="Product specs" required>
                        </div>
                        
                        <div class="product-description">
                            <label for="description">Short description</label> </br>
                            <textarea name="product_description" cols="50" rows="10" id="description" placeholder="Product description" required></textarea>
                        </div>
                    </div>
                    
                    <div class="product-brand-container">
                        <div class="product-brand">
                            <label for="brand">Product brand</label> </br>
                            <input type="text" id="brand" name="product_brand" placeholder="Example: APPLE..." required>
                        </div>
                        <div class="product-mark">
                            <label for="mark">Product Mark</label> </br>
                            <select name="product_mark" id="mark" required>
                                <option value="New release">New Releasing</option>
                                <option value="New">New</option>
                                <option value="Second hand">Second Hand</option>
                            </select>
                        </div>
                        
                        <div class="product-price">
                            <label for="price">Price</label> </br>
                            <input type="number" name="product_price" id="price" placeholder="Product price" step="0.01" required>
                        </div>
                        <div class="product-quantity">
                            <label for="quantity">Quantity</label></br>
                            <input type="number" name="product_quantity" id="quantity" placeholder="Product quantity" required>
                        </div>
                        <div class="product-status">
                            <label for="status">Status</label> </br>
                            <select name="product_status" id="status" required>
                                <option value="Available">Available</option>
                                <option value="Out of Stock">Out of Stock</option>
                            </select>
                        </div>
                        <div class="product-order">
                            <label for="order">Order</label></br>
                            <input type="number" id="order" name="product_order" placeholder="Product order number" required>
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
            </div> <!-- ✅ Closing missing div -->

            <div class="submit-button">
                <input type="submit" value="Submit">
                <a class="btn btn-danger display-inline" href="index.php?p=products">Close</a>
            </div>
        </form>
    </div>
</div>
  <script src="js/product.js"></script>
</body>
</html>



