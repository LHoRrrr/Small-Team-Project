<?php
include "../config/connectDB.php";
$sql = "SELECT * FROM tblbanner;";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Error!");
}
?>
<?php
include "include/banner-list.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>Banner</title>

</head>

<body>
    <h2 class="ml-5">Add Banner</h2>
    <form class="row g-1 p-5">
        <div class="col-md-4">
            <label for="id" class="form-label">ID</label>
            <input type="text" class="form-control" id="">
        </div>
        <div class="col-md-4">
            <label for="brand" class="form-label">Brand</label>
            <input type="text" class="form-control" id="">
        </div>
        <div class="col-md-4">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="">
        </div>
        <div class="col-md-4">
            <label for="link" class="form-label">Link</label>
            <input type="text" class="form-control" id="">
        </div>
        <div class="col-md-4">
            <label for="status" class="form-label">Status</label>
            <input type="text" class="form-control" id="">
        </div>
        <div class="col-md-4">
            <label for="order" class="form-label">Order</label>
            <input type="text" class="form-control" id="">
        </div>
        <div class="col-md-4">
            <label for="image" class="form-label">Image</label>
            <div class="product-image-container">
                <img id="choosen-image" src="" alt="Product Image">
                <p id="file-name"></p>
            </div>
            <div class="submit mt-1">
                <input type="file" name="product_image" id="upload-button" accept="image/*" required>
                <label for="upload-button">
                    <i class="fa-solid fa-upload"></i> &nbsp; Upload Image
                </label>
            </div>
    </form>
</body>

</html>