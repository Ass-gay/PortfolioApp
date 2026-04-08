<!-- ==================  BASE JS ================== -->
	<script src="public/templates/templateAdmin/assets/js/app.min.js"></script>
	<script src="public/templates/templateAdmin/assets/js/theme/default.min.js"></script>
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="public/templates/templateAdmin/assets/plugins/d3/d3.min.js"></script>
	<script src="public/templates/templateAdmin/assets/plugins/nvd3/build/nv.d3.min.js"></script>
	<script src="public/templates/templateAdmin/assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
	<script src="public/templates/templateAdmin/assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
	<script src="public/templates/templateAdmin/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
	<script src="public/templates/templateAdmin/assets/plugins/moment/min/moment.min.js"></script>
	<script src="public/templates/templateAdmin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="public/templates/templateAdmin/assets/js/demo/dashboard-v3.js"></script>

	<!-- ================== BEGIN BASE JS TABLE ================== -->
	<script src="public/templates/templateAdmin/assets/js/app.min.js"></script>
	<script src="public/templates/templateAdmin/assets/js/theme/default.min.js"></script>
	
	<!-- ================== BEGIN PAGE LEVEL JS TABLE ================== -->
	<script src="public/templates/templateAdmin/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="public/templates/templateAdmin/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="public/templates/templateAdmin/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="public/templates/templateAdmin/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="public/templates/templateAdmin/assets/js/demo/table-manage-default.demo.js"></script>

	<!-- ================== CDN SWEETALERT ================== -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
	<!-- ==================  GLOBAL JS ================== -->
	<script src="public/js/global/Validator.js"></script>


	

	<!-- ================== STYLE JS APP================== -->
	<script>
		function loadScriptsIfPathEndsWhith(path, scriptsSources) {
			if (window.location.pathname.endsWith(path)) {
				scriptsSources.forEach(src => {
					const script = document.createElement("script");
					script.src = src;
					document.body.appendChild(script);
				});
			}
		}

		loadScriptsIfPathEndsWhith("listeServiceRea",[
			"public/js/serviceRea/addFrmValidator.js",
			"public/js/serviceRea/editFrmValidator.js",
			"public/js/serviceRea/confirmDelet.js",
			"public/js/serviceRea/confirmRestaurer.js",
			"public/js/serviceRea/confirmSupDef.js",
			"public/js/serviceRea/showHide.js"

		]);

		loadScriptsIfPathEndsWhith("listeUser",[
			"public/js/user/addFrmValidator.js",
			"public/js/user/editFrmValidator.js",
			"public/js/user/confirmDeletUser.js",
			"public/js/user/confirmRestaurerUser.js",
			"public/js/user/confirmSupDef.js",
			"public/js/user/showHideUser.js",
			"public/js/user/changePasswordValidator.js",
		]);
	</script>
	


