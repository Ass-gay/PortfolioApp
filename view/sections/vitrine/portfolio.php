
<!-- ========= Recuperation liste des Projet ========= -->
<?php

	require_once("model/ProjetServiceRepository.php");
	$projetServiceRepository = new ProjetServiceRepository();

	try {
		$listeProjet = $projetServiceRepository->getAllByEtatAndType(1, 'Projet');
	} catch (Exception $error) {
		echo "<P>Erreur lors du changement de liste des Projet" . $error->getMessage() . "</P>";
		$listeProjet = [];
	}
?>

<main class="main">

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2># Mes Projets</h2>
        <p>
          Découvrez une sélection de mes réalisations en développement web, design et autres projets personnels.
          Chaque projet illustre mes compétences et ma créativité.
        </p>
      </div>

      <!-- Liste des Projet -->
      <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="300">

            <?php if(!empty($listeProjet)) : ?>
						<?php foreach ($listeProjet as $projet) : ?>
              
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-strategy">
              <div class="portfolio-card">
                <div class="portfolio-img">
                  <img height="100px;" width="100px;" src="public/images/projetService/<?= htmlspecialchars($projet['photo']); ?>" alt="Photo Projet">
                  <div class="portfolio-overlay">
                    <a href="public/templates/templateVitrine/assets/img/portfolio/portfolio-1.webp" class="glightbox portfolio-lightbox"><i class="bi bi-plus"></i></a>
                    <a href="#" class="portfolio-details-link"><i class="bi bi-link"></i></a>
                  </div>
                </div>

                <!-- Titre -->
                <div class="portfolio-info">
                  <h4><?= htmlspecialchars($projet['titre']); ?></h4>
                  <p><?= htmlspecialchars($projet['description']); ?></p>
                </div>

              </div>
            </div>

            <?php endforeach ?>
						<?php else :?>
							<p class="alert alert-danger text-center h3 fw-bold">Aucun Service Projet !</p>
						<?php endif ?>

          </div>
      </div>

      

    </section><!-- /Portfolio Section -->

  </main>