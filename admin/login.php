<?php
    include "../config/connectDB.php";
    session_start();
    if(!isset($_SESSION['valid']) || $valid == "true"){
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = mysqli_real_escape_string($conn, trim($_POST['username']));
        $password = $_POST['password']; 
    
        if (empty($username) || empty($password)) {
            die("Username or password cannot be empty.");
        }
    
        // Fetch user from database
        $sql = "SELECT * FROM tbladmin WHERE username_admin = '$username'";
        $result = mysqli_query($conn, $sql);
    
        if (!$result) {
          die("Query error: " . mysqli_error($conn));
        }
    
        // Check if user exists
        if ($row = mysqli_fetch_assoc($result)) {
          print_r($row); // Debugging: Check fetched data
    
          // If passwords are stored as plain text
          if ($row['password_admin'] === $password) {
            header("Location: index.php?p=dashboard");
            //session_start();
            $_SESSION['valid'] = true;
            $_SESSION['name'] = $row['username_admin'];
            exit(); 
          } else {
            echo "Invalid password.";
          }
        } else {
          echo "User not found.";
        }
      }
    
      mysqli_close($conn);
    }else {
        header("Location: index.php?p=dashboard");
    }
    ?>

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

<div class="container">
        <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4 ">Please Login here</h1>
                                    </div>
                            <form method="POST" action="login.php" class="user">
                                <div class="form-group">
                                    <input required type="text" class="form-control form-control-user"
                                        placeholder="Username..." name="username">
                                </div>
                                <div class="form-group">
                                    <input required type="password" name="password" class="form-control form-control-user"
                                        placeholder="Password..">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input  type="checkbox" name = "remember" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember
                                            Me</label>
                                    </div>
                                </div>
                                <input type="submit" href="index.php" class="btn btn-primary btn-user btn-block" value="Login">
                            </form>
                            <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="register.php">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>