 <!DOCTYPE html>
<html lang="en">
    <!-- ==================SECTION HEAD ================== -->
		<?php require_once ("../../../sections/admin/head.php"); ?>
<body>

 	<!-- ================== Verification Session ================== -->
		<?php require_once ("../../../sections/admin/verifieSession.php"); ?>


	<!-- ========= Recuperation liste User Dans BD ========= -->
 	<?php

 		require_once("../../../../model/UserRepository.php");
		$userRepository = new UserRepository();

		try {
			$listeUser = $userRepository->getAll(1);
			$listeUserSupprimer = $userRepository->getAll(0);
		} catch (Exception $error) {
			echo "<P>Erreur lors du changement de liste des utilisateur" . $error->getMessage() . "</P>";
			$listeUser = [];
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
				<!-- Btn Ajouter -->
				<li class="breadcrumb-item">
                    <a href="#modal-add-user" class="btn btn-sm btn-dark text-white fw-bold" data-toggle="modal">Ajouter</a>
                </li>

 				<!-- Btn Affiche List -->
				<li id="btn-show-liste-users" class="breadcrumb-item">
					<a href="#" class="btn btn-sm btn-dark text-white fw-bold">Afficher Liste</a>
				</li>

				<!-- Btn Affiche Corbeille -->
				<li id="btn-show-corbeille-users" class="breadcrumb-item">
					<a href="#" class="btn btn-sm btn-dark text-white fw-bold">Afficher Corbeille</a>
				</li>

				<!-- Btn Changer Password -->
				<li class="breadcrumb-item">
                    <a href="#modal-change-Password" class="btn btn-sm btn-dark text-white fw-bold" data-toggle="modal">Changer Mot de passe</a>
                </li>

			</ol>
	        <!-- ================== SECTION HEADER ================== -->
			<h1 class="page-header"># User</h1>

			<!-- Liste Users -->
			<div id="table-liste-user" class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Liste des Utilisateurs</h4>
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
								<th width="1%" data-orderable="false">Photo</th>
								<th class="text-nowrap text-center">Nom</th>
								<th class="text-nowrap text-center">Adresse</th>
								<th class="text-nowrap text-center">Telephone</th>
								<th class="text-nowrap text-center">Email</th>
								<th class="text-nowrap text-center">Role</th>
								<th class="text-nowrap text-center">Créer le</th>
								<th class="text-nowrap text-center">Modifier le</th>
								<th class="text-nowrap text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($listeUser)) : ?>
								<?php foreach ($listeUser as $user) : ?>
									<tr class="odd gradeX">

										<!-- Photo -->
										<td width="1%" class="with-img text-center">
											<?php if(!empty($user['photo'])) : ?>	
												<img src="public/images/user/<?= htmlspecialchars($user['photo']); ?>" style="width: 40px; height: 40px;" class="img-rounded height-30" />
											<?php else :?>
												<img src="public/images/user/default.jpg" class="img-rounded height-30" />
											<?php endif ?>
										</td>
										
										<!-- Nom -->
										<td class="text-center">
											<?= htmlspecialchars($user['nom']); ?>
										</td>

										<!-- Adresse -->
										<td class="text-center">
											<?= htmlspecialchars($user['adresse']); ?>
										</td>

										<!-- Telephone -->
										<td class="text-center">
											<?= htmlspecialchars($user['telephone']); ?>
										</td>

										<!-- Email -->
										<td class="text-center">
											<?= htmlspecialchars($user['email']); ?>
										</td>

										<!-- Role -->
										<td class="text-center">
											<?= htmlspecialchars($user['role']); ?>
										</td>

										<!-- Creer Le -->
										<td class="text-center">
											<?= htmlspecialchars(date("d/m/Y H:i:s"), strtotime($user['created_at'])); ?> </br>
												par
												<?php if($user['created_by_email']) :?>
													<?= htmlspecialchars($user['created_by_email']); ?>
												<?php else :?>
													<span class='f-w-700'>admin@gmail.com</span>
												<?php endif?>

										</td>

										<!-- Modifier Le -->
										<td class="text-center">
											<?php if($user['updated_at']) :?>
												<?= htmlspecialchars(date("d/m/Y H:i:s"), strtotime($user['updated_at'])); ?> </br>
												par <?= htmlspecialchars($user['updated_by_email']); ?>
											<?php else :?>
												<span class='text-danger f-w-700'>jamais modifier</span>
											<?php endif?>
										</td>

										<!-- Actions -->
										<td class="text-center">
											<!-- Edition -->
											 <a href="javascript:;"
												data-id="<?= htmlspecialchars($user['id']); ?>"
												data-nom="<?= htmlspecialchars($user['nom']); ?>"
												data-adresse="<?= htmlspecialchars($user['adresse']); ?>"
												data-telephone="<?= htmlspecialchars($user['telephone']); ?>"
												data-email="<?= htmlspecialchars($user['email']); ?>"
												data-role="<?= htmlspecialchars($user['role']); ?>"
												data-photo="<?= htmlspecialchars($user['photo']); ?>"
												class="btn-edit-user" data-toggle="modal" data-target="#modal-edit-user" title="Modifier"
											 >
												<i class="fa fa-edit btn btn-success fw-bold"></i>
											 </a>

											 <!-- Suppressions -->
											 <a href="#"
											 data-id-user="<?= htmlspecialchars($user['id']); ?>"
											 data-name-user="<?= htmlspecialchars($user['nom']); ?>"
											class="btn-delete-user" data-toggle="tooltip" data-placement="top" title="Supprimer">
												<i class="fa fa-trash btn btn-danger fw-bold"></i>
											 </a>
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

			<!-- Corbeille Users -->
			<div id="table-corbeille-user" class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Corbeille Utilisateur</h4>
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
								<th width="1%" data-orderable="false">Photo</th>
								<th class="text-nowrap text-center">Nom</th>
								<th class="text-nowrap text-center">Adresse</th>
								<th class="text-nowrap text-center">Telephone</th>
								<th class="text-nowrap text-center">Email</th>
								<th class="text-nowrap text-center">Role</th>
								<th class="text-nowrap text-center">Créer le</th>
								<th class="text-nowrap text-center">Modifier le</th>
								<th class="text-nowrap text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($listeUserSupprimer)) : ?>
								<?php foreach ($listeUserSupprimer as $user) : ?>
									<tr class="odd gradeX">

										<!-- Photo -->
										<td width="1%" class="with-img text-center">
											<?php if(!empty($user['photo'])) : ?>	
												<img src="public/images/user/<?= htmlspecialchars($user['photo']); ?>" style="width: 40px; height: 40px;" class="img-rounded height-30" />
											<?php else :?>
												<img src="public/images/user/default.jpg" class="img-rounded height-30" />
											<?php endif ?>
										</td>
										
										<!-- Nom -->
										<td class="text-center">
											<?= htmlspecialchars($user['nom']); ?>
										</td>

										<!-- Adresse -->
										<td class="text-center">
											<?= htmlspecialchars($user['adresse']); ?>
										</td>

										<!-- Telephone -->
										<td class="text-center">
											<?= htmlspecialchars($user['telephone']); ?>
										</td>

										<!-- Email -->
										<td class="text-center">
											<?= htmlspecialchars($user['email']); ?>
										</td>

										<!-- Role -->
										<td class="text-center">
											<?= htmlspecialchars($user['role']); ?>
										</td>


										<!-- Creer Le -->
										<td class="text-center">
											<?= htmlspecialchars(date("d/m/Y H:i:s"), strtotime($user['created_at'])); ?> </br>
												par
												<?php if($user['created_by_email']) :?>
													<?= htmlspecialchars($user['created_by_email']); ?>
												<?php else :?>
													<span class='f-w-700'>admin@gmail.com</span>
												<?php endif?>
										</td>

										<!-- Modifier Le -->
										<td class="text-center">
											<?php if($user['updated_at']) :?>
												<?= htmlspecialchars(date("d/m/Y H:i:s"), strtotime($user['updated_at'])); ?> </br>
												par <?= htmlspecialchars($user['updated_by_email']); ?>
											<?php else :?>
												<span class='text-danger fw-700'>jamais modifier</span>
											<?php endif?>
										</td>

										<!-- Actions -->
										<td class="text-center">
											<!-- Restaurer -->
											 <a href="#"
											 data-id-user="<?= htmlspecialchars($user['id']); ?>"
											 data-name-user="<?= htmlspecialchars($user['nom']); ?>"
												class="btn-restaurer-user" data-toggle="tooltip" data-placement="top" title="Restaurer">
												<span class="btn btn-warning fw-bold">Restaurer</span>
											 </a>

										</td>
									</tr>
								<?php endforeach ?>
							<?php else :?>
								<p class="alert alert-danger text-center h3 fw-bold">La liste des Utilisateur est vide !</p>
							<?php endif ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>


	<!-- ================== SECTION MODAL ADD USER ================== -->
        <div class="modal fade" id="modal-add-user" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <!-- HEADER -->
                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter un User</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- FORM -->
                    
                    <div class="modal-body">

                        <form action="userMainController" method="POST" enctype="multipart/form-data" id="addUserForm">
                            
                                <!-- Nom -->
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="add-user-nom" class="form-control" id="add-user-nom" placeholder="Entrer le nom" required>
									<p class="error-message mt-2"></p>
                                </div>

								<!-- Adresse -->
                                <div class="form-group">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" name="add-user-adresse" class="form-control" id="add-user-adresse" placeholder="Entrer l'adresse" required>
									<p class="error-message mt-2"></p>
                                </div>

								<!-- Telephone -->
                                <div class="form-group">
                                    <label for="telephone">Telephone</label>
                                    <input type="text" name="add-user-telephone" class="form-control" id="add-user-telephone" placeholder="Entrer numero telephone" required>
									<p class="error-message mt-2"></p>
                                </div>

								<!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="add-user-email" class="form-control" id="add-user-email" placeholder="Entrer votre email" required>
									<p class="error-message mt-2"></p>
                                </div>

								<!-- Photo -->
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <input type="file" name="add-user-photo" class="form-control" id="add-user-photo" accept="image/*" required>
									<p class="error-message mt-2"></p>
                                </div>

                                <!-- Role -->
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="add-user-role" class="form-control" id="add-user-role" required>
                                        <option value="">-- Choisir un role --</option>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
									<p class="error-message mt-2"></p>
                                </div>

                                
                                <!-- Soumissions -->
                                <div style="display: flex; justify-content: center;">
                                    <button type="submit" name="frmAddUser" class="btn btn-primary fw-bold">Ajouter</button>
                                    <button type="reset" name="" class="btn btn-danger fw-bold">Annuler</button>
                                </div>
                                
                        </form>
                    </div>

                </div>
            </div>
        </div>

	
	<!-- ================== SECTION MODAL EDIT USER ================== -->
        <div class="modal fade" id="modal-edit-user" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <!-- HEADER -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modifier un User</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- FORM -->
                    
                    <div class="modal-body">

                        <form action="userMainController" method="POST" enctype="multipart/form-data" id="editUserForm">
                            
                                <!-- Nom -->
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="edit-user-nom" class="form-control" id="edit-user-nom" placeholder="Modifier le nom" required>
									<p class="error-message mt-2"></p>
                                </div>

								<!-- Adresse -->
                                <div class="form-group">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" name="edit-user-adresse" class="form-control" id="edit-user-adresse" placeholder="Modifier l'adresse" required>
									<p class="error-message mt-2"></p>
                                </div>

								<!-- Telephone -->
                                <div class="form-group">
                                    <label for="telephone">Telephone</label>
                                    <input type="text" name="edit-user-telephone" class="form-control" id="edit-user-telephone" placeholder="Modifier le numero telephone" required>
									<p class="error-message mt-2"></p>
                                </div>

								<!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="edit-user-email" class="form-control" id="edit-user-email" placeholder="Modifier l'email" required>
									<p class="error-message mt-2"></p>
                                </div>

								<!-- Photo -->
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <input type="file" name="edit-user-photo" class="form-control" id="edit-user-photo" accept="image/*">
									<div class="image-preview-container">
										<img src="" id="photo-preview-edit" alt="Apercu de l'image">
									</div>
									<p class="error-message mt-2"></p>
                                </div>

                                <!-- Role -->
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="edit-user-role" class="form-control" id="edit-user-role" required>
                                        <option value="">-- Choisir le Role --</option>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
									<p class="error-message mt-2"></p>
                                </div>

								<input type="text" hidden id="edit-user-id" name="edit-user-id" value="">

                                
                                <!-- Soumissions -->
                                <div style="display: flex; justify-content: center;">
                                    <button type="submit" name="frmEditUser" class="btn btn-primary fw-bold">Modifier</button>
                                </div>
                                
                        </form>
                    </div>

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