<?php include "../config/connectDB.php";
  if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])){
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM tblusers WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()){
      header("Location: index.php?p=users");
    }
    
  }
?>