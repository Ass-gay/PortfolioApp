<!DOCTYPE html>
<html lang="en">
    <!-- ==================SECTION HEAD ================== -->
		<?php require_once ("../../../sections/admin/head.php"); ?>
<body>

 	<!-- ================== Verification Session ================== -->
		<?php require_once ("../../../sections/admin/verifieSession.php"); ?>


	<!-- ========= Recuperation liste User Dans BD ========= -->
 	<?php

 		require_once("../../../../model/ContactRepository.php");
		$contactRepository = new ContactRepository();

		try {
			$listeContacts = $contactRepository->getAll();
		} catch (Exception $error) {
			echo "<P>Erreur lors du changement de liste des contacts" . $error->getMessage() . "</P>";
			$listeContacts = [];
		}
	?>
	

	<!-- ================== page-loader ================== -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	
	<!-- ================== page-container ================== -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">

	<!-- ==================SECTION MENU HAUT ================== -->
		<?php require_once ("../../../sections/admin/menuHaut.php"); ?>
		
	<!-- ================== SECTION MENU GAUCHE ================== -->
		<?php require_once ("../../../sections/admin/meneGauche.php"); ?>
		
	<!-- ================== SECTION BASE CONTENT ================== -->
        <div id="content" class="content">
			<ol class="breadcrumb float-xl-right">
				<!-- Btn  Pour aller vers User -->
				<li class="breadcrumb-item">
                    <a href="listeUser" class="btn btn-sm btn-dark text-white fw-bold" data-toggle="modal">User</a>
                </li>

 				<!-- Btn Pour aller vers userlisation -->
				<li id="btn-show-liste-users" class="breadcrumb-item">
					<a href="listeProjetService" class="btn btn-sm btn-dark text-white fw-bold">Projet/Service</a>
				</li>

			</ol>
	        <!-- ================== SECTION HEADER ================== -->
			<h1 class="page-header"># Contact</h1>

			<!-- Liste Users -->
			<div id="table-liste-contact" class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Liste des Contacts</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<div class="panel-body">
					<table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th class="text-nowrap text-center">Nom</th>
								<th class="text-nowrap text-center">Email</th>
								<th class="text-nowrap text-center">Sujet</th>
								<th class="text-nowrap text-center">Message</th>
								<th class="text-nowrap text-center">Créer le</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($listeContacts)) : ?>
								<?php foreach ($listeContacts as $contact) : ?>
									<tr class="odd gradeX">

										<!-- Nom -->
										<td class="text-center">
											<?= htmlspecialchars($contact['nom']); ?>
										</td>

                                        <!-- Email -->
										<td class="text-center">
											<?= htmlspecialchars($contact['email']); ?>
										</td>

                                        <!-- Nom -->
										<td class="text-center">
											<?= htmlspecialchars($contact['sujet']); ?>
										</td>

										<!-- Message -->
                                        <td class="text-center" data-toggle="tooltip" data-placement="top" title="<?= htmlspecialchars($contact['message']); ?>">
											<?= htmlspecialchars(mb_substr($contact['message'], 0, 20)) . (strlen($contact['message']) > 20 ? "... Lire Plus" : ""); ?>
										</td>


										<!-- Creer Le -->
										<td class="text-center">
											<?= htmlspecialchars(date("d/m/Y H:i:s"), strtotime($contact['created_at'])); ?>
										</td>
									</tr>
								<?php endforeach ?>
							<?php else :?>
								<p class="alert alert-danger text-center h3 fw-bold">La liste des utilisateurs est vide !</p>
							<?php endif ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>

	<!-- ================== SECTION MODAL CHANGER PASSWORD ================== -->
        <div class="modal fade" id="modal-change-Password" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <!-- HEADER -->
                    <div class="modal-header">
                        <h4 class="modal-title">Changement du mot de passe</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- FORM -->
                    
                    <div class="modal-body">

                        <form action="userMainController" method="POST" enctype="multipart/form-data" id="changePasswordForm">
                            
                                <!-- Mot de passe actuel -->
                                <div class="form-group">
                                    <label for="current_password">Mot de passe actuel</label>
                                    <input type="text" name="current_password" class="form-control" id="current_password" placeholder="Entrer le mot de passe actuel" required>
									<p class="error-message mt-2"></p>
                                </div>

								<!-- Nouveau mot de passe -->
                                <div class="form-group">
                                    <label for="new_password">Nouveau mot de passe</label>
                                    <input type="text" name="new_password" class="form-control" id="new_password" placeholder="Entrer Le Nouveau mot de passe" required>
									<p class="error-message mt-2"></p>
                                </div>

								<!-- Confirmer le nouveau mot de passe -->
                                <div class="form-group">
                                    <label for="confirm_password">Confirmer le nouveau mot de passe</label>
                                    <input type="text" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirmer le nouveau mot de passe" required>
									<p class="error-message mt-2"></p>
                                </div>

                                <!-- Soumissions -->
                                <div style="display: flex; justify-content: center;">
                                    <button type="submit" name="frmChangePassword" class="btn btn-primary fw-bold">Changer mot de passe</button>
                                    <button type="reset" name="" class="btn btn-danger fw-bold">Annuler</button>
                                </div>
                                
                        </form>
                    </div>

                </div>
            </div>
        </div>

        
	<!-- ================== SECTION CONFIG PANEL ================== -->
		<?php require_once ("../../../sections/admin/config.php"); ?>
		
	<!-- ================== SECTION SCROLL TOP ================== -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	</div>
	<!-- ================== SECTION SCRIPT ================== -->
		<?php require_once ("../../../sections/admin/script.php"); ?>
		
	<!-- ================== SECTION Message Erreur/Success ================== -->
		<?php require_once ("../../../sections/admin/msgErreuSuccess.php"); ?>
</body>
</html>