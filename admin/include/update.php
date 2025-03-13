<?php
include "../../config/connectDB.php";

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
$sucessMessage = "";

// Initialize variables
$id = $name = $specs = $description = $brand = $mark = $price = $status = $quantity = $order = $image = "";

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Securely fetch product data
    $stmt = $conn->prepare("SELECT * FROM tblphone WHERE id_phone = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $name = $row['name_phone'];
        $specs = $row['space_phone'];
        $description = $row['description_phone'];
        $brand = $row['brand_phone'];
        $mark = $row['mark_phone'];
        $price = $row['price_phone'];
        $status = $row['status_phone'];
        $quantity = $row['total_quantity'];
        $order = $row['order_phone'];
        $image = $row['photo_phone'];
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['product_id'])) {
    $product_id = trim($_POST['product_id']);
    $product_name = $_POST['product_name'];
    $product_specs = $_POST['product_specs'];
    $product_description = $_POST['product_description'];
    $product_brand = $_POST['product_brand'];
    $product_mark = $_POST['product_mark'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_status = $_POST['product_status'];
    $product_order = $_POST['product_order'];

    // Handle the product image upload (optional)
    $photo_path_file = $image; // Default to existing image
    
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = $_FILES['product_image']['type'];

        if (!in_array($fileType, $allowedTypes)) {
            die("Invalid image type. Only JPG, PNG, and GIF allowed.");
        }

        $target_dir = "../../img/";
        if (!is_writable($target_dir)) {
            die("Upload directory is not writable.");
        }

        $photo_path_file = basename($_FILES['product_image']['name']);
        move_uploaded_file($_FILES['product_image']['tmp_name'], $target_dir . $photo_path_file);
    }

    // Update the product in the database
    $updateQuery = "UPDATE tblphone SET name_phone=?, price_phone=?, space_phone=?, description_phone=?, photo_phone=?, brand_phone=?, status_phone=?, mark_phone=?, total_quantity=?, order_phone=? WHERE id_phone=?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sisssssssis", $product_name, $product_price, $product_specs, $product_description, $photo_path_file, $product_brand, $product_status, $product_mark, $product_quantity, $product_order, $product_id);

    if ($stmt->execute()) {
        $sucessMessage = "Product updated!";
        header("location: ../index.php?p=products");
    } else {
        die("Error updating product: " . $stmt->error);
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Update Product</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/product-list-style.css">
    <link rel="stylesheet" href="../css/product.css">
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
    <h1 class="">UPDATE PRODUCT</h1>
    <div class="form-body-add-product">
        <form method="POST" action="update.php" enctype="multipart/form-data">
          <!-- <input type="hidden" value="<?#=$id?>"> -->
           <?php if($sucessMessage){ 
                echo '
                <div class="container mt-4">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Product updated successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
                    </div>
                </div>
            ';
           }?>
            <div class="product-php-container">
                <div class="product-general-information-container">
                    <h4>General Information</h4>
                    <div class="product-name-container">
                        <label for="id">ID</label> </br>
                        <input type="text" id="id" placeholder="Product ID" name="product_id" value="<?=$id?>" readonly required> </br>
                        <label for="name">Name</label> </br>
                        <input type="text" placeholder="Product name" id="name" name="product_name" value="<?=$name?>" required> </br>
                    </div>
                    
                    <div class="product-specs-container">
                        <div class="product-specs">
                            <label for="specs">Specs</label> </br>
                            <input type="text" name="product_specs" id="specs" placeholder="Product specs" value="<?=$specs?>" required>
                        </div>
                        
                        <div class="product-description">
                            <label for="description">Short description</label> </br>
                            <textarea name="product_description" cols="50" rows="10" id="description" placeholder="Product description" required><?=$description?></textarea>

                        </div>
                    </div>
                    
                    <div class="product-brand-container">
                        <div class="product-brand">
                            <label for="brand">Product brand</label> </br>
                            <input type="text" id="brand" name="product_brand" placeholder="Example: APPLE..." value="<?=$brand?>" required>
                        </div>
                        <div class="product-mark">
                            <label for="mark">Product Mark</label> </br>
                            <select name="product_mark" id="mark" required>
                                <option value="<?=$mark?>"><?=$mark?></option>
                                <option value="New release">New Releasing</option>
                                <option value="New">New</option>
                                <option value="Second hand">Second Hand</option>
                            </select>
                        </div>
                        
                        <div class="product-price">
                            <label for="price">Price</label> </br>
                            <input type="number" name="product_price" id="price" placeholder="Product price" step="0.01" value="<?=$price?>" required>
                        </div>
                        <div class="product-quantity">
                            <label for="quantity">Quantity</label></br>
                            <input type="number" name="product_quantity" id="quantity" placeholder="Product quantity" required value="<?=$quantity?>">
                        </div>
                        <div class="product-status">
                            <label for="status">Status</label> </br>
                            <select name="product_status" id="status" required>
                                <option value="<?=$status?>"><?=$status?></option>
                                <option value="Available">Available</option>
                                <option value="Out of Stock">Out of Stock</option>
                            </select>
                        </div>
                        <div class="product-order">
                            <label for="order">Order</label></br>
                            <input type="number" id="order" name="product_order" placeholder="Product order number" value="<?=$order?>" required>
                        </div>
                    </div>
                </div>
                
                <div class="add-image-product-container">
                    <h4>Product Image</h4>
                    <div class="product-image-container">
                        <img id="choosen-image" src="../../img/<?=$image?>" alt="Product Image">
                        <p id="file-name"></p>
                    </div>
                    <div class="submit">
                        <input type="file" name="product_image" id="upload-button" value="<?=$image?>" accept="image/*" >
                        <label for="upload-button">
                            <i class="fa-solid fa-upload"></i> &nbsp; Upload Image
                        </label>
                    </div>
                </div>
            </div> <!-- ✅ Closing missing div -->

            <div class="submit-button">
                <input type="submit" value="Update">
                <a class="btn btn-danger display-inline" href="../index.php?p=products">Close</a>
            </div>
        </form>
    </div>
</div>
  <script src="../js/product.js"></script>
</body>
</html>

