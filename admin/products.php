<?php
include "../config/connectDB.php"; 

if (isset($_POST['product_id'])) {
    $product_id = trim($_POST['product_id']);

    // Check if the product ID already exists
    $stmt = $conn->prepare("SELECT id_phone FROM tblphone WHERE id_phone = ?");
    $stmt->bind_param("s", $product_id); // Use "s" for string
    $stmt->execute();
    $stmt->store_result(); // Store the result to check row count

    if ($stmt->num_rows > 0) {
        echo json_encode(["exists" => true]); // Product ID exists
    } else {
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
            if ($insertStmt->execute()) {
                echo json_encode(["success" => true, "message" => "Product added successfully!"]);
            } else {
                echo json_encode(["error" => "Failed to add the product"]);
            }
        } else {
            echo json_encode(["error" => "Missing required form fields."]);
        }
    }
    // Close the statement
    $stmt->close();
} 

// Close the database connection
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
                            <select name="product_mark" id="mark" required >
                                <!-- <option value=""></option> -->
                                <option value="New release">New Releasing</option>
                                <option value="New">New</option>
                                <option value="Second hand">Second Hand</option>
                            </select>
                        </div>

                        <div class="product-price">
                            <label for="price">Price</label> </br>
                            <input type="number" name="product_price" id="price" placeholder="Product price" required>
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
                            <input type="number"  id="order" name="product_order" placeholder="Product order number" required>
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
<script>
document.addEventListener("DOMContentLoaded", function () {
    const productIdInput = document.querySelector('input[name="product_id"]');
    const submitButton = document.querySelector('input[type="submit"]');
    const messageContainer = document.createElement("p");
    productIdInput.parentNode.appendChild(messageContainer);

    productIdInput.addEventListener("input", function () {
        const productId = productIdInput.value.trim();

        if (productId.length === 0) {
            messageContainer.textContent = "";
            submitButton.disabled = false;
            return;
        }

        fetch("check_product_id.php", {  // Correct URL for ID checking
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: "product_id=" + encodeURIComponent(productId),
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                messageContainer.textContent = "❌ Product ID already exists!";
                messageContainer.style.color = "red";
                submitButton.disabled = true;
            } else {
                messageContainer.textContent = "✅ Product ID is available!";
                messageContainer.style.color = "green";
                submitButton.disabled = false;
            }
        })
        .catch(error => {
            messageContainer.textContent = "⚠️ Error checking product ID!";
            messageContainer.style.color = "orange";
        });
    });
});

</script> 
<!--Add product form-->