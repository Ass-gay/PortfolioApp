 <!DOCTYPE html>
<html lang="en">
    <!-- ==================SECTION HEAD ================== -->
		<?php require_once ("../../../sections/admin/head.php"); ?>
<body>


 	<!-- ================== Verification Session ================== -->
		<?php require_once ("../../../sections/admin/verifieSession.php"); ?>


	<!-- ========= Recuperation liste serviceProjet Dans BD ========= -->
 	<?php

 		require_once("../../../../model/ProjetServiceRepository.php");
		$projetServiceRepository = new ProjetServiceRepository();

		try {
			$listeprojetService = $projetServiceRepository->getAll(1);
			$listeprojetServiceSupprimer = $projetServiceRepository->getAll(0);
		} catch (Exception $error) {
			echo "<P>Erreur lors du changement de liste des projetServices" . $error->getMessage() . "</P>";
			$listeprojetService = [];
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
				<li class="breadcrumb-item">
                    <a href="#modal-add-service-projet" class="btn btn-sm btn-dark text-white fw-bold" data-toggle="modal">Ajouter</a>
                </li>
				<li id="btn-show-liste" class="breadcrumb-item"><a href="#" class="btn btn-sm btn-dark text-white fw-bold">Afficher Liste</a></li>
				<li id="btn-show-corbeille" class="breadcrumb-item"><a href="#" class="btn btn-sm btn-dark text-white fw-bold">Afficher Corbeille</a></li>
				<li class="breadcrumb-item active"><a href="listeUser" class="btn btn-sm btn-dark text-white fw-bold">User</a></li>
			</ol>
	        <!-- ================== SECTION HEADER ================== -->
			<h1 class="page-header"># Service / Projet</h1>

			<!-- Liste Service/Projet -->
			<div id="table-liste" class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Liste Service / Projet</h4>
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
								<th class="text-nowrap text-center">Titre</th>
								<th class="text-nowrap text-center">Description</th>
								<th class="text-nowrap text-center">Type</th>
								<th class="text-nowrap text-center">Créer le</th>
								<th class="text-nowrap text-center">Modifier le</th>
								<th class="text-nowrap text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($listeprojetService)) : ?>
								<?php foreach ($listeprojetService as $serviceProjet) : ?>
									<tr class="odd gradeX">

										<!-- Photo -->
										<td width="1%" class="with-img text-center">
											<?php if(!empty($serviceProjet['photo'])) : ?>	
												<img src="public/images/projetService/<?= htmlspecialchars($serviceProjet['photo']); ?>" style="width: 40px; height: 40px;" class="img-rounded height-30" />
											<?php else :?>
												<img src="public/images/projetService/default.png" class="img-rounded height-30" />
											<?php endif ?>
										</td>
										
										<!-- titre -->
										<td class="text-center">
											<?= htmlspecialchars($serviceProjet['titre']); ?>
										</td>

										<!-- Description -->
										<td class="text-center" data-toggle="tooltip" data-placement="top" title="<?= htmlspecialchars($serviceProjet['description']); ?>">
											<?= htmlspecialchars(mb_substr($serviceProjet['description'], 0, 20)) . (strlen($serviceProjet['description']) > 20 ? "... Lire Plus" : ""); ?>
										</td>

										<!-- type -->
										<td class="text-center">
											<?= htmlspecialchars($serviceProjet['type'] === "Projet" ? "Projet" : "Service"); ?>
										</td>

										<!-- Creer Le -->
										<td class="text-center">
											<?= htmlspecialchars(date("d/m/Y H:i:s"), strtotime($serviceProjet['created_at'])); ?> </br>
												par <?= htmlspecialchars($serviceProjet['created_by_email']); ?>
										</td>

										<!-- Modifier Le -->
										<td class="text-center">
											<?php if($serviceProjet['updated_at']) :?>
												<?= htmlspecialchars(date("d/m/Y H:i:s"), strtotime($serviceProjet['updated_at'])); ?> </br>
												par <?= htmlspecialchars($serviceProjet['updated_by_email']); ?>
											<?php else :?>
												<span class='text-danger f-w-700'>jamais modifier</span>
											<?php endif?>
										</td>

										<!-- Actions -->
										<td class="text-center">
											<!-- Edition -->
											 <a href="javascript:;"
												data-id="<?= htmlspecialchars($serviceProjet['id']); ?>"
												data-titre="<?= htmlspecialchars($serviceProjet['titre']); ?>"
												data-description="<?= htmlspecialchars($serviceProjet['description']); ?>"
												data-type="<?= htmlspecialchars($serviceProjet['type']); ?>"
												data-photo="<?= htmlspecialchars($serviceProjet['photo']); ?>"
												class="btn-edit" data-toggle="modal" data-target="#modal-edit-service-projet" title="Modifier"
											 >
												<i class="fa fa-edit btn btn-success fw-bold"></i>
											 </a>

											 <!-- Suppressions -->
											 <a href="#"
											 data-id-serviceProjet="<?= htmlspecialchars($serviceProjet['id']); ?>"
											 data-name-serviceProjet="<?= htmlspecialchars($serviceProjet['titre']); ?>"
											class="btn-delete-serviceProjet" data-toggle="tooltip" data-placement="top" title="Supprimer">
												<i class="fa fa-trash btn btn-danger fw-bold"></i>
											 </a>
										</td>
									</tr>
								<?php endforeach ?>
							<?php else :?>
								<p class="alert alert-danger text-center h3 fw-bold">La liste des services/projet est vide !</p>
							<?php endif ?>

						</tbody>
					</table>
				</div>
			</div>

			<!-- Corbeille Service/Realisation -->
			<div id="table-corbeille" class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Corbeille Service / Projet</h4>
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
								<th class="text-nowrap text-center">Titre</th>
								<th class="text-nowrap text-center">Description</th>
								<th class="text-nowrap text-center">Type</th>
								<th class="text-nowrap text-center">Créer le</th>
								<th class="text-nowrap text-center">Modifier le</th>
								<th class="text-nowrap text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($listeprojetServiceSupprimer)) : ?>
								<?php foreach ($listeprojetServiceSupprimer as $serviceProjet) : ?>
									<tr class="odd gradeX">

										<!-- Photo -->
										<td width="1%" class="with-img text-center">
											<?php if(!empty($serviceProjet['photo'])) : ?>	
												<img src="public/images/projetService/<?= htmlspecialchars($serviceProjet['photo']); ?>" style="width: 40px; height: 40px;" class="img-rounded height-30" />
											<?php else :?>
												<img src="public/images/projetService/default.png" class="img-rounded height-30" />
											<?php endif ?>
										</td>
										
										<!-- Titre -->
										<td class="text-center">
											<?= htmlspecialchars($serviceProjet['titre']); ?>
										</td>

										<!-- Description -->
										<td class="text-center" data-toggle="tooltip" data-placement="top" title="<?= htmlspecialchars($serviceProjet['description']); ?>">
											<?= htmlspecialchars(mb_substr($serviceProjet['description'], 0, 20)) . (strlen($serviceProjet['description']) > 20 ? "... Lire Plus" : ""); ?>
										</td>

										<!-- type -->
										<td class="text-center">
											<?= htmlspecialchars($serviceProjet['type'] === "Projet" ? "Projet" : "Service"); ?>
										</td>

										<!-- Creer Le -->
										<td class="text-center">
											<?= htmlspecialchars(date("d/m/Y H:i:s"), strtotime($serviceProjet['created_at'])); ?> </br>
												par <?= htmlspecialchars($serviceProjet['created_by_email']); ?>
										</td>

										<!-- Modifier Le -->
										<td class="text-center">
											<?php if($serviceProjet['updated_at']) :?>
												<?= htmlspecialchars(date("d/m/Y H:i:s"), strtotime($serviceProjet['updated_at'])); ?> </br>
												par <?= htmlspecialchars($serviceProjet['updated_by_email']); ?>
											<?php else :?>
												<span class='text-danger fw-700'>jamais modifier</span>
											<?php endif?>
										</td>

										<!-- Actions -->
										<td class="text-center">
											<!-- Restaurer -->
											 <a href="#"
											 data-id="<?= htmlspecialchars($serviceProjet['id']); ?>"
											 data-name="<?= htmlspecialchars($serviceProjet['titre']); ?>"
												class="btn-restaurer" data-toggle="tooltip" data-placement="top" title="Restaurer">
												<span class="btn btn-warning fw-bold">Restaurer</span>
											 </a>

											 <!-- Supprimer def -->
											  <a href="#"
											 data-id="<?= htmlspecialchars($serviceProjet['id']); ?>"
											 data-name="<?= htmlspecialchars($serviceProjet['titre']); ?>"
												class="btn-sup-def" data-toggle="tooltip" data-placement="top" title="supDef">
												<span class="btn btn-danger fw-bold">Sup Def</span>
											 </a>
										</td>
									</tr>
								<?php endforeach ?>
							<?php else :?>
								<p class="alert alert-danger text-center h3 fw-bold">Aucun services ou Projet supprime !</p>
							<?php endif ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>


	<!-- ================== SECTION MODAL ADD SERVICE / PROJET ================== -->
        <div class="modal fade" id="modal-add-service-projet" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <!-- HEADER -->
                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter un Projet</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- FORM -->
                    
                    <div class="modal-body">

                        <form action="projetServiceMainController" method="POST" enctype="multipart/form-data" id="addProjetServiceForm">
                            
                                <!-- Titre -->
                                <div class="form-group">
                                    <label for="titre">Titre</label>
                                    <input type="text" name="titre" class="form-control" id="titre" placeholder="Entrer le titre" required>
									<p class="error-message mt-2"></p>
                                </div>

                                <!-- Description -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" id="description" placeholder="Entrer la description" required></textarea>
									<p class="error-message mt-2"></p>
                                </div>

                                <!-- Photo -->
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <input type="file" name="photo" class="form-control" id="photo" accept="image/*" required>
									<p class="error-message mt-2"></p>
                                </div>

                                <!-- Type -->
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select name="type" class="form-control" id="type" required>
                                        <option value="">-- Choisir le type --</option>
                                        <option value="Projet">Projet</option>
                                        <option value="Service">Service</option>
                                    </select>
									<p class="error-message mt-2"></p>
                                </div>

                                
                                <!-- Soumissions -->
                                <div style="display: flex; justify-content: center;">
                                    <button type="submit" name="frmAddServiceProjet" class="btn btn-primary fw-bold">Ajouter</button>
                                    <button type="reset" name="" class="btn btn-danger fw-bold">Annuler</button>
                                </div>
                                
                        </form>
                    </div>

                </div>
            </div>
        </div>

	
	<!-- ================== SECTION MODAL EDIT SERVICE / PROJET ================== -->
        <div class="modal fade" id="modal-edit-service-projet" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <!-- HEADER -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modifier une Projet</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- FORM -->
                    
                    <div class="modal-body">

                        <form action="projetServiceMainController" method="POST" enctype="multipart/form-data" id="editServiceProjetForm">
                            
                                <!-- Titre -->
                                <div class="form-group">
                                    <label for="titre">Titre</label>
                                    <input type="text" name="edit-titre" class="form-control" id="edit-titre" placeholder="Modifier le titre" required>
									<p class="error-message mt-2"></p>
                                </div>

                                <!-- Description -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="edit-description" class="form-control" id="edit-description" placeholder="Modifier la description" required></textarea>
									<p class="error-message mt-2"></p>
                                </div>

                                <!-- Photo -->
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <input type="file" name="edit-photo" class="form-control" id="edit-photo" accept="image/*">
									<div class="image-preview-container">
										<img src="" id="photo-preview" alt="Apercu de l'image">
									</div>
									<p class="error-message mt-2"></p>
                                </div>

                                <!-- Type -->
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select name="edit-type" class="form-control" id="edit-type" required>
                                        <option value="">-- Choisir le type --</option>
                                        <option value="Projet">Projet</option>
                                        <option value="Service">Service</option>
                                    </select>
									<p class="error-message mt-2"></p>
                                </div>

								<input type="text" hidden id="edit-id" name="edit-id" value="">

                                
                                <!-- Soumissions -->
                                <div style="display: flex; justify-content: center;">
                                    <button type="submit" name="frmEditServiceProjet" class="btn btn-primary fw-bold">Modifier</button>
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