<!DOCTYPE html>
<html lang="en">

	<!-- ================== SECTION HEAD ================== -->
		<?php require_once("view/sections/login/head.php"); ?>

<body class="pace-top">
	<!-- ================== SECTION FORM ================== -->
		<?php require_once("view/sections/login/loader.php"); ?>
	
	<div id="page-container" class="fade">

	<!-- ================== SECTION FORM ================== -->
		<?php require_once("view/sections/login/form.php"); ?>
		

		<!-- ================== SECTION THEM PANEL COLOR ================== -->
		<?php require_once("view/sections/login/config.php"); ?>

		<!-- ================== SECTION SCROL ================== -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top">
			<i class="fa fa-angle-up"></i>
		</a>
	</div>
	
	<!-- ================== SECTION JS ================== -->
		<?php require_once("view/sections/login/script.php"); ?>

	<!-- ================== CDN SWEETALERT ================== -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- ================== SECTION Message erreur/success ================== -->
		<?php require_once ("view/sections/admin/msgErreuSuccess.php"); ?>
</body>
</html>