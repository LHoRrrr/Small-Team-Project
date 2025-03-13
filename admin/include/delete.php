<?php 
  include "../../config/connectDB.php";

  if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the DELETE statement
    $sql = "DELETE FROM tblphone WHERE id_phone = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "s", $id); // Assuming id_phone is a string. Use "i" if it's an integer.

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            echo "Record deleted successfully!";
            header("Location: ../index.php?p=products");
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Invalid query!";
    }
  } else {
    echo "Invalid request!";
  }

  // Close the database connection
  mysqli_close($conn);
?>
