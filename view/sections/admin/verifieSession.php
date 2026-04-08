<!-- ================== Verification Session ================== -->
		<?php 
			session_start();
			if (!$_SESSION['email']) {
				header("Location: login?error=1&message=" . urldecode("Merci de vous connecter") . "&title=" .urldecode("Accès interdit ! !"));
			}
			$nom = $_SESSION['nom'];
			$email = $_SESSION['email'];
			$photo = $_SESSION['photo'];
		?>