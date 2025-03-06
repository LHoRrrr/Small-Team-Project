<?php
$page = "dashboard.php";
$p = "dashboard";
$footer = true;
if (isset($_GET['p'])) {
    $p = $_GET['p'];
    switch ($p) {
        case "products":
            $page = "products.php";
            $footer = false;
            break;
        case "banners":
            $page = "banners.php";
            break;
        case "users":
            $page = "users.php";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include "include/head.php" ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "include/sidebar.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "include/header.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?php include "$page" ?>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php  if ($footer) include "include/footer.php"; ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>

    <?php include "include/foot.php" ?>
</body>

</html>