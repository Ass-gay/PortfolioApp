
<!-- ========= Recuperation liste des competence ========= -->
<?php

	require_once("model/CompetenceRepository.php");
	$competenceRepository = new CompetenceRepository();

	try {
		$listeCompetence = $competenceRepository->getAll(1);
	} catch (Exception $error) {
		echo "<P>Erreur lors du changement de liste des competence" . $error->getMessage() . "</P>";
		$listeCompetence = [];
	}
?>

<!-- Skills Section -->
<section id="skills" class="skills section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2> # Mes Compétences</h2>
      <p>Je mets à votre service mes compétences en design graphique et en développement web pour créer des solutions modernes, esthétiques et performantes adaptées à vos besoins.</p>
    </div>

    <!-- Liste des competence -->
    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row g-4 skills-animation">

        <?php if(!empty($listeCompetence)) : ?>
				<?php foreach ($listeCompetence as $competence) : ?>
          <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
            <div class="skill-box">
              <!-- Nom -->
              <h3><?= htmlspecialchars($competence['nom']); ?></h3>
              <!-- Description -->
              <p><?= htmlspecialchars($competence['description']); ?></p>

              <!-- Niveau -->
              <span class="text-end d-block"><?= htmlspecialchars($competence['niveau']); ?></span>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?= htmlspecialchars($competence['niveau']); ?>" aria-valuemin="0" aria-valuemax="100"></div>
              </div>

            </div>
          </div>

        <?php endforeach ?>
				<?php else :?>
					<p class="alert alert-danger text-center h3 fw-bold">Aucun Competence trouvee !</p>
				<?php endif ?>

      </div>

    </div>
    
</section>