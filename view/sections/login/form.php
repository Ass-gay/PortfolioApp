		<div class="login login-v1">
			<div class="login-container">

				<!-- header -->
				<div class="login-header">
					<div class="brand">
						<span class="logo"></span> <b>Connexion</b>
						<small>Bienvenue sur Tidiany Creative</small>
					</div>
					<div class="icon">
						<i class="fa fa-lock"></i>
					</div>
				</div>
				<!-- Form -->
				<div class="login-body">
					<div class="login-content">
						<form action="userMainController" method="post" id="loginForm" class="margin-bottom-0">

                            <!-- Email -->
							<div class="form-group m-b-20">
								<input type="email" id="email" name="email" class="form-control form-control-lg inverse-mode" placeholder="Email Address" required />
								<p class="error-message"></p>
							</div>

                            <!-- Password -->
							<div class="form-group m-b-20">
								<input type="password" id="password" name="password" class="form-control form-control-lg inverse-mode" placeholder="Password" required />
								<p class="error-message"></p>
							</div>

                            <!-- Remember Me -->
							<div class="checkbox checkbox-css m-b-20">
								<input type="checkbox" id="remember_checkbox" name="remember" /> 
								<label for="remember_checkbox">Remember Me</label>
								<!-- Retourner vers l'accueil -->
								<small class="ml-2">
								<a class="text-center fw-bold text-white h6" href="home">Retourner vers l'accueil</a>
								</small>

								<!-- Reinitialissation mot de passe  -->
								<small class="ml-2">
								<a class="text-center fw-bold text-white h6" href="reinitEmail">Mot de passe oublie</a>
								</small>
							</div>
							

                            <!-- Connexion -->
							<div class="login-buttons">
								<button type="submit" id="btnSubmit" name="frmLogin" class="btn btn-success btn-block btn-lg">Connexion</button>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>