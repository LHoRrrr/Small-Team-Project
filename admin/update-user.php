<?php
include "../config/connectDB.php";
$errorMessage = "";
$successMessage = "";

$id = $firstname = $lastname = $email = $password = "";

if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['update'])){
  $successMessage = "User updated successfully!";
}

if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id'])) {
  $id = $_GET['id'];
  
  $sql = "SELECT * FROM tblusers WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id); // "i" stands for integer
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if (!$row) {
    $errorMessage = "User not found!";
  } else {
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $email = $row['email'];
    $password = $row['password'];
  }
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $id = $_POST['user_id'];
  $firstname = $_POST['user_firstname'];
  $lastname = $_POST['user_lastname'];
  $email = $_POST['user_email'];
  $password = $_POST['user_password'];

  if (empty($id) || empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
    $errorMessage = "All fields must be filled!";
  } else {
    // Update user information in the database
    $sql = "UPDATE tblusers SET firstname = ?, lastname = ?, email = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $firstname, $lastname, $email, $password, $id);
    if ($stmt->execute()) {
      $successMessage = "User updated successfully!";
      header("Location: update-user.php?update=success");
      exit;
    } else {
      $errorMessage = "Failed to update the user. Please try again.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Update user</title>
  <link href="endor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/product-list-style.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS (for close button to work) -->


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
      .product-general-information-container{
        border-radius: 8px;
        padding: 30px 20px;
      }
    </style>
</head>
<body>

    <!-- Add product form -->
    <div class="form-container-add-product">
        <h1 class="">UPDATE USER</h1>
        <?php 
        if($errorMessage){
            echo '
            <div class="container text-center alert alert-dismissible fade show alert-danger" role="alert">
                ' . $errorMessage . '.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        if($successMessage) {
            echo '
            <div class="container text-center alert alert-dismissible fade show alert-success" role="alert">
                ' . $successMessage . '.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <div class="form-body-add-product">
            <form id="myForm" method="POST" action="update-user.php" enctype="multipart/form-data">
                <div class="product-php-container">
                    <div class="product-general-information-container">
                        <!-- <h4 class="text-center">General Information</h4> -->
                        <div class="product-name-container">
                            <input type="hidden" name="user_id" value="<?=$id?>">
                            <label for="firstname">First Name</label> <br>
                            <input type="text" id="firstname" name="user_firstname" value="<?=$firstname?>"> <br>
                            <label for="lastname">Last Name</label> <br>
                            <input type="text" id="lastname" name="user_lastname" value="<?=$lastname?>" > <br>
                            <label for="email">Email</label> <br>
                            <input type="email" name="user_email" value="<?=$email?>"> <br>
                            <label for="password">Password</label> <br>
                            <input type="text" id="password" name="user_password" value=" <?=$password?>"> <br>
                        </div>
                    </div>
                </div> <!-- ✅ Closing missing div -->
                <div class="submit-button">
                    <input type="submit" value="Update">
                    <a class="btn btn-danger display-inline fw-bold" href="index.php?p=users">Close</a>
                </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>