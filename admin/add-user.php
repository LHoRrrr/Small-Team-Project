<?php 
  include "../config/connectDB.php";
  $errorMessage = "";
  $successMessage = "";
  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  $firstname = $_POST['user_firstname'] ?? '';
  $lastname= $_POST['user_lastname'] ?? '';
  $email = $_POST['user_email'] ?? '';
  $password = $_POST['user_password']?? '';
  $comfirm_password = $_POST['user_comfirm_password'];
  $created_at = date("Y-m-d H:i:s");
  if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($comfirm_password) ){
    $errorMessage = "All field must be filled!";
  }else {
      $sql = "INSERT INTO tblusers (firstname, lastname, email, password, created_at) 
        VALUES ('$firstname', '$lastname', '$email', '$password', '$created_at')";
      $result = mysqli_query($conn,$sql);
      if(!$result){
        $errorMessage = "Invalid query!";
      }else {
        $successMessage = "User added successfully!";
      }
  }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Add user</title>
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
        <h1 class="">ADD USER</h1>
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
            <form id="myForm" method="POST" action="add-user.php" enctype="multipart/form-data">
                <div class="product-php-container">
                    <div class="product-general-information-container">
                        <!-- <h4 class="text-center">General Information</h4> -->
                        <div class="product-name-container">
                            <label for="firstname">First Name</label> <br>
                            <input type="text" id="firstname" name="user_firstname"> <br>
                            <label for="lastname">Last Name</label> <br>
                            <input type="text" id="lastname" name="user_lastname"> <br>
                            <label for="email">Email</label> <br>
                            <input type="email" name="user_email"> <br>
                            <label for="password">Password</label> <br>
                            <input type="password" id="password" name="user_password"> <br>
                            <label for="comfirm_password">Confirm password</label> <br>
                            <input type="password" id="comfirm_password" name="user_comfirm_password"> 
                            <!-- Error message container for JavaScript -->
                            <div id="error-message" style="color: red;"></div>
                        </div>
                    </div>
                </div> <!-- ✅ Closing missing div -->
                <div class="submit-button">
                    <input type="submit" value="Submit">
                    <a class="btn btn-danger display-inline fw-bold" href="index.php?p=users">Close</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Get the password and confirm password fields
        const passwordField = document.getElementById("password");
        const confirmPasswordField = document.getElementById("comfirm_password");
        const errorMessage = document.getElementById("error-message");

        // Event listeners for the input fields
        passwordField.addEventListener("input", checkPasswords);
        confirmPasswordField.addEventListener("input", checkPasswords);

        function checkPasswords() {
            // Clear any previous error messages
            errorMessage.innerHTML = '';

            // Check if both fields are filled
            if (passwordField.value === "" || confirmPasswordField.value === "") {
                
            } else {
                // If both fields are filled, check if they match
                if (passwordField.value !== confirmPasswordField.value) {
                    errorMessage.innerHTML = "Passwords do not match.";
                }
            }
        }
    </script>
</body>



</html>
