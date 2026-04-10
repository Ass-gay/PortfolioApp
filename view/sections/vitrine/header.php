<header id="header" class="header d-flex align-items-center light-background sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <!-- Logo -->
      <!-- <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <img src="assets/img/logo.webp" alt="">
        <h1 class="sitename">AG</h1> 
      </a> -->

      <!-- Nav Bar -->
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="home" class="active">ACCUEIL</a></li>
          <li><a href="#about">À-PROPOS</a></li>
          <li><a href="#skills">COMPÉTENCE</a></li>
          <li><a href="#resume">CV</a></li>
          <li><a href="#services">SERVICE</a></li>
          <li><a href="#portfolio">PROJET</a></li>
          <li><a href="#testimonials">TÉMOIGNAGE</a></li>
          <li><a href="#contact">CONTACT</a></li>
          
          <?php 
						session_start();
						if(isset($_SESSION['email'])) :?>
							<li class="nav-item">
								<a class="nav-link" href="admin">
									<span class="brand-text">
										Retour Vers<span class="text-primary">Admin</span>
									</span>
								</a>
							</li>
						<?php else : ?>
							<li class="nav-item"><a class="nav-link" href="login">CONNEXION</a></li>
						<?php endif ?>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>

    </div>
  </header>