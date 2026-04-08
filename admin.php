<!DOCTYPE html>
<html lang="en">
    <!-- ==================SECTION HEAD ================== -->
		<?php require_once ("view/sections/admin/head.php"); ?>
<body>
	


	<!-- ================== page-loader ================== -->
		<?php require_once ("view/sections/admin/loader.php"); ?>
	
	<!-- ================== page-container ================== -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">

	<!-- ==================SECTION MENU HAUT ================== -->
		<?php require_once ("view/sections/admin/menuHaut.php"); ?>
		
	<!-- ================== SECTION MENU GAUCHE ================== -->
		<?php require_once ("view/sections/admin/meneGauche.php"); ?>
		
	<!-- ================== SECTION BASE CONTENT ================== -->
		<?php require_once ("view/sections/admin/baseContent.php"); ?>
		
	<!-- ================== SECTION CONFIG PANEL ================== -->
		<?php require_once ("view/sections/admin/config.php"); ?>
		
	<!-- ================== SECTION SCROLL TOP ================== -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	</div>
	<!-- ================== SECTION SCRIPT ================== -->
		<?php require_once ("view/sections/admin/script.php"); ?>

	<!-- ================== SECTION Message erreur/success ================== -->
		<?php require_once ("view/sections/admin/msgErreuSuccess.php"); ?>

	

	
	
</body>
</html>