<?php 
    include "../config/connectDB.php";

    if (isset($_POST['username'])) {
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeat_password = $_POST['repeat_password']; // Fixed typo

        // Hash the password for security (Recommended)
        //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Debugging output (Remove in production)
        echo $lastname . " " . $firstname . " " . $username . " " . $email . " " . $repeat_password;

        // Use prepared statements for security
        $sql = "INSERT INTO tbladmin (firstname_admin, lastname_admin, username_admin, email_admin, password_admin) 
                VALUES (?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $username, $email, $password);
            $result = mysqli_stmt_execute($stmt);
            
            if ($result) {
                echo "Admin successfully registered!";
                $SESSION['valid'] = true;
                header("Location: index.php?valid=true");
            } else {
                die("Error inserting data: " . mysqli_error($conn));
            }

            mysqli_stmt_close($stmt);
        } else {
            die("SQL Error: " . mysqli_error($conn));
        }
        mysqli_close($conn);
    }
?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

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

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form method="POST" action="register.php" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input required name="firstname" type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="First Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="lastname" type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input required name="username" type="text" class="form-control form-control-user" 
                                        placeholder="Username...">
                                </div>
                                <div class="form-group">
                                    <input required name="email" type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address...">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input required name="password" type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input required name="repeat_password" type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <input type="submit" value="Register"  class="btn btn-primary btn-user btn-block"> 
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
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