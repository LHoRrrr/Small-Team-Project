<?php

	$page = "home.php";
	$p = "home";
	if (isset($_GET['p'])){
		$p = $_GET['p'];
		switch($p){
			case "apple": $page = "apple.php";
				break;
			case "samsung": $page = "samsung.php";
				break;
			case "xiaomi": $page = "xiaomi.php";
				break;
			case "checkout": $page = "checkout.php";
				break;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<?php
		include "include/head.php"
	?>
	<body>
		<!-- HEADER -->
		<?php include "include/header.php" ?>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<?php include "include/nav.php"?>
		<!-- /NAVIGATION -->

		<!-- Page -->
		<?php include "page/$page" ?>
		<!-- Page -->

		<!-- FOOTER -->
		<?php include "include/footer.php"?>
		<!-- /FOOTER -->

		<!-- jQuery Plugins foot -->
		 <?php include "include/foot.php"?>


	</body>
</html>
