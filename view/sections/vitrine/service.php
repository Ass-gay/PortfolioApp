
<!-- ========= Recuperation liste des Service ========= -->
<?php

	require_once("model/ProjetServiceRepository.php");
	$projetServiceRepository = new ProjetServiceRepository();

	try {
		$listeServices = $projetServiceRepository->getAllByEtatAndType(1, 'Service');
	} catch (Exception $error) {
		echo "<P>Erreur lors du changement de liste des Services" . $error->getMessage() . "</P>";
		$listeServices = [];
	}
?>



<main class="main">

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Titre -->
      <div class="container section-title" data-aos="fade-up">
        <h2># Nos Services</h2>
        <p>
            Nous proposons une gamme complète de services créatifs pour accompagner les particuliers et entreprises dans leur communication visuelle.
					  Notre objectif est de vous aider à vous démarquer avec des créations modernes, professionnelles et efficaces.
        </p>
      </div>

      <!-- Liste des service -->
      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row justify-content-center g-5">
          <?php if(!empty($listeServices)) : ?>
						<?php foreach ($listeServices as $service) : ?>

              <div class="col-md-6" data-aos="fade-right" data-aos-delay="100">

                  <div class="service-item">

                      <!-- Photo -->
                      <div class="service-icon">
                        <img height="50px;" src="public/images/projetService/<?= htmlspecialchars($service['photo']); ?>" alt="Photo Service">
                      </div>

                      <!-- Text -->
                      <div class="service-content">
                        <h3><?= htmlspecialchars($service['titre']); ?></h3>
                        <p><?= htmlspecialchars($service['description']); ?></p> 
                      </div>
                  </div>
              </div>

          <?php endforeach ?>
						<?php else :?>
							<p class="alert alert-danger text-center h3 fw-bold">Aucun Service trouvee !</p>
						<?php endif ?>

        </div>

      </div>
      
    </section>

  </main>