<main class="main">

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem aperiam</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4 g-lg-5">
          <div class="col-lg-5">
            <div class="info-box" data-aos="fade-up" data-aos-delay="200">
              <h3>Contact Info</h3>
              <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum primis.</p>

              <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box">
                  <i class="bi bi-geo-alt"></i>
                </div>
                <div class="content">
                  <h4>Our Location</h4>
                  <p>A108 Adam Street</p>
                  <p>New York, NY 535022</p>
                </div>
              </div>

              <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box">
                  <i class="bi bi-telephone"></i>
                </div>
                <div class="content">
                  <h4>Phone Number</h4>
                  <p>+1 5589 55488 55</p>
                  <p>+1 6678 254445 41</p>
                </div>
              </div>

              <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                <div class="icon-box">
                  <i class="bi bi-envelope"></i>
                </div>
                <div class="content">
                  <h4>Email Address</h4>
                  <p>info@example.com</p>
                  <p>contact@example.com</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-7">
            <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
            
              <form action="contactMainController" method="post" id="addContact" class="form-horizontal">
                  <!-- Nom -->
                  <div class="form-group row">
                    <label for="nom" class="col-form-label col-lg-3 text-lg-right">Nom <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                      <input type="text" name="nom" id="nom" class="form-control" placeholder="Entre votre nom" />
                      <p class="error-message mt-2"></p>
                    </div>
                  </div>

                  <!-- Email -->
                  <div class="form-group row">
                    <label for="email" class="col-form-label col-lg-3 text-lg-right">Email <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                      <input type="email" name="email" id="email" class="form-control" placeholder=" Entrer votre email" />
                      <p class="error-message mt-2"></p>
                    </div>
                  </div>

                  <!-- Sujet -->
                  <div class="form-group row">
                    <label for="sujet" class="col-form-label col-lg-3 text-lg-right">Sujet <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                      <input type="text" name="sujet" id="sujet" class="form-control" placeholder="De quoi sagit il ?" />
                      <p class="error-message mt-2"></p>
                    </div>
                  </div>

                  <!-- Message -->
                  <div class="form-group row">
                    <label for="message" class="col-form-label col-lg-3 text-lg-right">Message <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                      <textarea name="message" id="message" class="form-control" rows="5" placeholder="Laissez votre message..."></textarea>
                      <p class="error-message mt-2"></p>
                    </div>
                  </div>

                  <!-- Button Soumission -->
                  <div class="form-group row">
                    <div class="col-lg-12 offset-lg-5">
                      <button type="submit" name="frmContact" class="btn btn-theme btn-primary btn-block">
                        Envoyer le message
                      </button>
                    </div>
                  </div>

              </form>
            </div>
            
          </div>

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>