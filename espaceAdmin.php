<?php
  $titre = "C&M - Espace admin";
  include('navbar.php');

?>
<script type="text/javascript">


</script>


		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

		<!-- Custom styles for this template -->
		<link href="css/blog.css" rel="stylesheet">
		<!-- JS, Popper.js, and jQuery -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
		<!-- Les icones utilisé -->
		<script src="https://kit.fontawesome.com/693819749c.js" crossorigin="anonymous"></script>
		<!-- Barre de recheche-->
		<script>
		$(document).ready(function(){
		  $("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#ListeClient *").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		});
		</script>


		<main role="main" class="container">
			<div class="row">
				<div class="col-md-12 blog-main">
				  <h1>Liste des clients</h1>
					
												<div class="modal-body mb-3">
													<input class="form-control" id="myInput" type="text" placeholder="Search..">
													<br>

													<div id="ListeClient">
														<div class="row">
                              <?php foreach (getAllUser() as $physique ): ?>

                              <div class="col-md-3 m-2"><a href="docsClient.php?id=<?= $physique['ID_PERSONNEP'] ?>&amp;c=1"  ><?= $physique['PER_NOM']." ". $physique['PER_PRENOM'] ?></a></div>
                              <?php endforeach; ?>



                              <?php foreach (getAllUserMorale() as $Morale ): ?>
                              <div class="col-md-3 m-2"><a href="docsClient.php?id=<?= $Morale['ID_PERSONNEMORALE'] ?>&amp;c=0"  ><?= $Morale['PERM_NOM'] ?></a></div>
                              <?php endforeach; ?>


														</div>
													</div>

												</div>
										</div>
									</div>
									<!--/.Panel 2-->
								</div>
							</div>
							<!--/.Content-->
						</div>

					</div>
			</div>

		</main><!-- /.container -->
    <!-- Footer -->
    <footer class="page-footer font-small">

      <div style="background-color: #26479e; margin-top:50px">
        <div class="container">

          <!-- Grid row-->
          <div class="row py-4 d-flex align-items-center">

            <!-- Grid column -->
            <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
              <h6 class="mb-0">Vous pouvez aussi nous contactez sur les réseaux sociaux!</h6>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-6 col-lg-7 text-center text-md-right">

              <!-- Facebook -->
              <a class="fb-ic" href="https://www.facebook.com/CM-Comptabilit%C3%A9-S%C3%A0rl-107024997531257/">
                <i class="fab fa-facebook-f white-text mr-4"> </i>
              </a>
              <!--Instagram-->
              <a class="ins-ic" href="https://instagram.com/cm.comptabilite?igshid=1awx5885odk3t">
                <i class="fab fa-instagram white-text"> </i>
              </a>

            </div>
            <!-- Grid column -->

          </div>
          <!-- Grid row-->

        </div>
      </div>

      <!-- Footer Links -->
      <div class="container text-center text-md-left mt-5" style="background-color:lightgrey">

        <!-- Grid row -->
        <div class="row mt-3">

          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

            <!-- Content -->
            <h6 class="text-uppercase font-weight-bold">C&M Comptabilité</h6>
            <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
            <p>Que vous soyez indépendant ou particulier, votre demande et votre satisfaction sont nos
              premiers critères de collaboration.</p>

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

            <!-- Links -->
            <h6 class="text-uppercase font-weight-bold"></h6>
            <!-- <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;"> -->
            <p>
              <a href="#!"></a>
            </p>
            <p>
              <a href="#!"></a>
            </p>
            <p>
              <a href="#!"></a>
            </p>
            <p>
              <a href="#!"></a>
            </p>

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

            <!-- Links -->
            <h6 class="text-uppercase font-weight-bold">Liens utiles</h6>
            <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
            <p>
              <a href="login.php">Connectez vous!</a>
            </p>
            <p>
              <a href="reservation.php">Prenez un rendez-vous</a>
            </p>
            <p>
              <a href="services.php">Nos services</a>
            </p>
            <p>
              <a href="contact.php">Nous contater</a>
            </p>

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

            <!-- Links -->
            <h6 class="text-uppercase font-weight-bold">Contact</h6>
            <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 70px; height:5px;">
            <p>
              <i class="fas fa-home mr-3"></i> Avenue Industrielle 14</p>
            <p>
              <i class="fas fa-map-pin mr-4"></i> 1227 Carouge </p>
            <p>
              <i class="fas fa-envelope mr-3"></i> info@cm-comptabilite.ch</p>
            <p>
              <i class="fas fa-phone mr-3"></i> 076 375 33 06 </p>
            <p>
              <i class="fas fa-phone mr-3"></i> 078 778 07 11 </p>
          </div>
          <!-- Grid column -->

        </div>
        <!-- Grid row -->

      </div>
      <!-- Footer Links -->

      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="https://esig-sandbox.ch/team2020_2"> C&M-Comptabilité.com</a>
      </div>
      <!-- Copyright -->

    </footer>
