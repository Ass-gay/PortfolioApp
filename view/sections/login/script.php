	<!-- ================== BEGIN BASE JS ================== -->
    <script src="public/templates/templateAdmin/assets/js/app.min.js"></script>
	<script src="public/templates/templateAdmin/assets/js/theme/default.min.js"></script>

	
	<!-- ==================  APPELE login.js ================== -->
	<script src="public/js/user/login.js"></script>


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

		loadScriptsIfPathEndsWhith("reinitEmail",[
			"public/js/user/reinitConfirmEmailValidator.js",

		]);

		loadScriptsIfPathEndsWhith("reinit",[
			"public/js/user/reinitPasswordValidator.js",
		]);
	</script>