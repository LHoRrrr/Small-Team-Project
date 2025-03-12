<?php
include "../../config/connectDB.php"; // Ensure the database connection is correct

if (isset($_POST['product_id'])) {
    // Sanitize the product ID input
    $product_id = trim($_POST['product_id']);

    // Prepare the query to check if the product ID exists
    $stmt = $conn->prepare("SELECT id_phone FROM tblphone WHERE id_phone = ?");
    $stmt->bind_param("s", $product_id); // Use "s" for string
    $stmt->execute();
    $stmt->store_result(); // Store the result to check row count

    if ($stmt->num_rows > 0) {
        echo json_encode(["exists" => true]); // Product ID exists
    } else {
        echo json_encode(["exists" => false]); // Product ID does not exist
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(["error" => "Product ID not provided111."]);
}

// Close the database connection
?>
