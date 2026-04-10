		
<!DOCTYPE html>
<html lang="en">
	<!-- ================== SECTION HEAD ================== -->
		<?php require_once("../../sections/login/head.php"); ?>

<body class="pace-top">
	
        <!-- ================== SECTION LOADER ================== -->
		<?php require_once("../../sections/login/loader.php"); ?>


        <!-- ================== Verification Session ================== -->
		<?php 
			session_start();
			if (!$_SESSION['code']) {
				header("Location: reinitEmail?error=1&message=" . urldecode("Lien corrompu") . "&title=" .urldecode("Accès interdit ! !"));
			}
		?>
	
            <!-- ================== SECTION page-container ================== -->
        <div id="page-container" class="fade">

            <div class="login login-v1">
                <div class="login-container">

                    <!-- header -->
                    <div class="login-header">
                        <div class="brand">
                            <span class="logo"></span> <b>Confirmation email</b>
                            <small class="ml-5">Reinitialisation du mot de passe</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>
                    <!-- Form -->
                    <div class="login-body">
                        <div class="login-content">
                            <form action="userMainController" method="post" id="reiniPasswordForm" class="margin-bottom-0">

                               <!-- Nouveau mot de passe -->    
                                <div class="form-group">
                                    <label for="new-password-reinit">Nouveau mot de passe</label>
                                    <input type="text" name="new-password-reinit" class="form-control" id="new-password-reinit" placeholder="Entrer Le Nouveau mot de passe" required>
									<p class="error-message mt-2"></p>
                                </div>

								<!-- Confirmer le nouveau mot de passe -->
                                <div class="form-group">
                                    <label for="confirm-password-reinit">Confirmer le nouveau mot de passe</label>
                                    <input type="text" name="confirm-password-reinit" class="form-control" id="confirm-password-reinit" placeholder="Confirmer le nouveau mot de passe" required>
									<p class="error-message mt-2"></p>
                                </div>


                                
                                <!-- Connexion -->
                                <div class="login-buttons">
                                    <button type="submit" id="btnSubmitReinit" name="frmReiniPassword" class="btn btn-success btn-block btn-lg">Confirmer</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <!-- ================== SECTION CONFIG ================== -->
            <?php require_once("../../sections/login/config.php"); ?>
            
            <!-- ================== SECTION SCOROLL TOP ================== -->
            <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        
        </div>

        <!-- ================== SECTION SCRIPT ================== -->
		<?php require_once("../../sections/login/script.php"); ?>

        <!-- ================== SECTION Message erreur/success ================== -->
		<?php require_once ("../../sections/admin/msgErreuSuccess.php"); ?>
</body>
</html>