<?php
$page = "dashboard.php";
$p = "dashboard";
if (isset($_GET['p'])) {
    $p = $_GET['p'];
    switch ($p) {
        case "charts":
            $page = "products.php";
            break;
        case "tables":
            $page = "tables.php";
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
            <?php include "include/footer.php" ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
    </div>

    <?php include "include/foot.php" ?>
</body>

</html>