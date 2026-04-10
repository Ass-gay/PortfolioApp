<!DOCTYPE html>
<html lang="en">
    <!-- ==================SECTION HEAD ================== -->
		<?php require_once ("../../../sections/admin/head.php"); ?>
<body>


 	<!-- ================== Verification Session ================== -->
		<?php require_once ("../../../sections/admin/verifieSession.php"); ?>


	<!-- ========= Recuperation liste competence Dans BD ========= -->
 	<?php

 		require_once("../../../../model/CompetenceRepository.php");
		$competenceRepository = new CompetenceRepository();

		try {
			$listeCompetence = $competenceRepository->getAll(1);
			$listeCompetenceSupprimer = $competenceRepository->getAll(0);
		} catch (Exception $error) {
			echo "<P>Erreur lors du changement de liste des Competence" . $error->getMessage() . "</P>";
			$listeCompetence = [];
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
                    <a href="#modal-add-competence" class="btn btn-sm btn-dark text-white fw-bold" data-toggle="modal">Ajouter</a>
                </li>
				<li id="btn-show-liste" class="breadcrumb-item"><a href="#" class="btn btn-sm btn-dark text-white fw-bold">Afficher Liste</a></li>
				<li id="btn-show-corbeille" class="breadcrumb-item"><a href="#" class="btn btn-sm btn-dark text-white fw-bold">Afficher Corbeille</a></li>
				<li class="breadcrumb-item active"><a href="listeUser" class="btn btn-sm btn-dark text-white fw-bold">User</a></li>
			</ol>
	        <!-- ================== SECTION HEADER ================== -->
			<h1 class="page-header"># Competence</h1>

			<!-- Liste Competence -->
			<div id="table-liste" class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Liste Competence</h4>
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
								<th class="text-nowrap text-center">Description</th>
								<th class="text-nowrap text-center">Niveau</th>
								<th class="text-nowrap text-center">Créer le</th>
								<th class="text-nowrap text-center">Modifier le</th>
								<th class="text-nowrap text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($listeCompetence)) : ?>
								<?php foreach ($listeCompetence as $competence) : ?>
									<tr class="odd gradeX">
										
										<!-- nom -->
										<td class="text-center">
											<?= htmlspecialchars($competence['nom']); ?>
										</td>

										<!-- Description -->
										<td class="text-center" data-toggle="tooltip" data-placement="top" title="<?= htmlspecialchars($competence['description']); ?>">
											<?= htmlspecialchars(mb_substr($competence['description'], 0, 20)) . (strlen($competence['description']) > 20 ? "... Lire Plus" : ""); ?>
										</td>

                                        <!-- niveau -->
										<td class="text-center">
											<?= htmlspecialchars($competence['niveau']); ?>
										</td>

										<!-- Creer Le -->
										<td class="text-center">
											<?= htmlspecialchars(date("d/m/Y H:i:s"), strtotime($competence['created_at'])); ?> </br>
												par <?= htmlspecialchars($competence['created_by_email']); ?>
										</td>

										<!-- Modifier Le -->
										<td class="text-center">
											<?php if($competence['updated_at']) :?>
												<?= htmlspecialchars(date("d/m/Y H:i:s"), strtotime($competence['updated_at'])); ?> </br>
												par <?= htmlspecialchars($competence['updated_by_email']); ?>
											<?php else :?>
												<span class='text-danger f-w-700'>jamais modifier</span>
											<?php endif?>
										</td>

										<!-- Actions -->
										<td class="text-center">
											<!-- Edition -->
											 <a href="javascript:;"
												data-id="<?= htmlspecialchars($competence['id']); ?>"
												data-nom="<?= htmlspecialchars($competence['nom']); ?>"
												data-description="<?= htmlspecialchars($competence['description']); ?>"
												data-niveau="<?= htmlspecialchars($competence['niveau']); ?>"
												class="btn-edit-competence" data-toggle="modal" data-target="#modal-edit-competence" title="Modifier"
											 >
												<i class="fa fa-edit btn btn-success fw-bold"></i>
											 </a>

											 <!-- Suppressions -->
											 <a href="#"
											 data-id-competence="<?= htmlspecialchars($competence['id']); ?>"
											 data-name-competence="<?= htmlspecialchars($competence['nom']); ?>"
											class="btn-delete-competence" data-toggle="tooltip" data-placement="top" title="Supprimer">
												<i class="fa fa-trash btn btn-danger fw-bold"></i>
											 </a>
										</td>
									</tr>
								<?php endforeach ?>
							<?php else :?>
								<p class="alert alert-danger text-center h3 fw-bold">La liste des competence est vide !</p>
							<?php endif ?>

						</tbody>
					</table>
				</div>
			</div>

			<!-- Corbeille Competence -->
			<div id="table-corbeille" class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Corbeille Competence</h4>
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
								<th class="text-nowrap text-center">Description</th>
								<th class="text-nowrap text-center">Niveau</th>
								<th class="text-nowrap text-center">Créer le</th>
								<th class="text-nowrap text-center">Modifier le</th>
								<th class="text-nowrap text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($listeCompetenceSupprimer)) : ?>
								<?php foreach ($listeCompetenceSupprimer as $competence) : ?>
									<tr class="odd gradeX">
										
										<!-- nom -->
										<td class="text-center">
											<?= htmlspecialchars($competence['nom']); ?>
										</td>

										<!-- Description -->
										<td class="text-center" data-toggle="tooltip" data-placement="top" title="<?= htmlspecialchars($competence['description']); ?>">
											<?= htmlspecialchars(mb_substr($competence['description'], 0, 20)) . (strlen($competence['description']) > 20 ? "... Lire Plus" : ""); ?>
										</td>

                                        <!-- niveau -->
										<td class="text-center">
											<?= htmlspecialchars($competence['niveau']); ?>
										</td>

										<!-- Creer Le -->
										<td class="text-center">
											<?= htmlspecialchars(date("d/m/Y H:i:s"), strtotime($competence['created_at'])); ?> </br>
												par <?= htmlspecialchars($competence['created_by_email']); ?>
										</td>

										<!-- Modifier Le -->
										<td class="text-center">
											<?php if($competence['updated_at']) :?>
												<?= htmlspecialchars(date("d/m/Y H:i:s"), strtotime($competence['updated_at'])); ?> </br>
												par <?= htmlspecialchars($competence['updated_by_email']); ?>
											<?php else :?>
												<span class='text-danger fw-700'>jamais modifier</span>
											<?php endif?>
										</td>

										<!-- Actions -->
										<td class="text-center">
											<!-- Restaurer -->
											 <a href="#"
											 data-id-restaurer="<?= htmlspecialchars($competence['id']); ?>"
											 data-name-restaurer="<?= htmlspecialchars($competence['nom']); ?>"
												class="btn-restaurer-competence" data-toggle="tooltip" data-placement="top" title="Restaurer">
												<span class="btn btn-warning fw-bold">Restaurer</span>
											 </a>

											 <!-- Supprimer def -->
											  <a href="#"
											 data-id-sup-competence="<?= htmlspecialchars($competence['id']); ?>"
											 data-name-sup-competence="<?= htmlspecialchars($competence['nom']); ?>"
												class="btn-sup-def-competence" data-toggle="tooltip" data-placement="top" title="supDef">
												<span class="btn btn-danger fw-bold">Sup Def</span>
											 </a>
										</td>
									</tr>
								<?php endforeach ?>
							<?php else :?>
								<p class="alert alert-danger text-center h3 fw-bold">Aucun competence supprime !</p>
							<?php endif ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>


	    <!-- ================== SECTION MODAL ADD Competence ================== -->
        <div class="modal fade" id="modal-add-competence" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <!-- HEADER -->
                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter un Competence</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- FORM -->
                    
                    <div class="modal-body">

                        <form action="competenceMainController" method="POST" enctype="multipart/form-data" id="addCompetenceForm">
                            
                                <!-- nom -->
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom-competence" class="form-control" id="nom-competence" placeholder="Entrer le nom" required>
									<p class="error-message mt-2"></p>
                                </div>

                                <!-- Description -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description-competence" class="form-control" id="description-competence" placeholder="Entrer la description" required></textarea>
									<p class="error-message mt-2"></p>
                                </div>

                                <!-- Niveau -->
                                <div class="form-group">
                                    <label for="niveau">Niveau</label>
                                    <input type="text" name="niveau-competence" class="form-control" id="niveau-competence" placeholder="Entrer le niveau" required>
									<p class="error-message mt-2"></p>
                                </div>
                                
                                <!-- Soumissions -->
                                <div style="display: flex; justify-content: center;">
                                    <button type="submit" name="frmAddcompetence" class="btn btn-primary fw-bold">Ajouter</button>
                                    <button type="reset" name="" class="btn btn-danger fw-bold">Annuler</button>
                                </div>
                                
                        </form>
                    </div>

                </div>
            </div>
        </div>

	
	    <!-- ================== SECTION MODAL EDIT Competence ================== -->
        <div class="modal fade" id="modal-edit-competence" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <!-- HEADER -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modifier une Competence</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- FORM -->
                    
                    <div class="modal-body">

                        <form action="competenceMainController" method="POST" enctype="multipart/form-data" id="editcompetenceForm">
                            
                                <!-- nom -->
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="edit-nom-competence" class="form-control" id="edit-nom-competence" placeholder="Modifier le nom" required>
									<p class="error-message mt-2"></p>
                                </div>

                                <!-- Description -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="edit-description-competence" class="form-control" id="edit-description-competence" placeholder="Modifier la description" required></textarea>
									<p class="error-message mt-2"></p>
                                </div>

                                <!-- Niveau -->
                                <div class="form-group">
                                    <label for="niveau">Niveau</label>
                                    <input type="text" name="edit-niveau-competence" class="form-control" id="edit-niveau-competence" placeholder="Modifier le niveau" required>
									<p class="error-message mt-2"></p>
                                </div>

								<input type="text" hidden id="edit-id-competence" name="edit-id-competence" value="">

                                
                                <!-- Soumissions -->
                                <div style="display: flex; justify-content: center;">
                                    <button type="submit" name="frmEditcompetence" class="btn btn-primary fw-bold">Modifier</button>
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