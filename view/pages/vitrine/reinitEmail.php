		
<!DOCTYPE html>
<html lang="en">
	<!-- ================== SECTION HEAD ================== -->
		<?php require_once("../../sections/login/head.php"); ?>

<body class="pace-top">
	
        <!-- ================== SECTION LOADER ================== -->
		<?php require_once("../../sections/login/loader.php"); ?>
	
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
                            <form action="userMainController" method="post" id="reinitConfirmMailForm" class="margin-bottom-0">

                                <!-- Email -->
                                <div class="form-group m-b-20">
                                    <input type="email" id="reinit-confirm-email" name="reinit-confirm-email" class="form-control form-control-lg inverse-mode" placeholder="Confirmer votre adresse email" required />
                                    <p class="error-message"></p>
                                </div>

                                
                                <!-- Connexion -->
                                <div class="login-buttons">
                                    <button type="submit" id="btnSubmit" name="frmReinitConfirmMail" class="btn btn-success btn-block btn-lg">Confirmer</button>
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