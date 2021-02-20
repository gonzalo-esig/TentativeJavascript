<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>C&M Comptabilité Sàrl</title>
  </head>
  <body>

    <?php
      $titre = "C&M - Contact";
      include('navbar.php');

    ?>

    <?php
    if(isset($_POST['button'])) {
       if(!empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['message']) AND !empty($_POST['mail'])) {

          $header="MIME-Version: 1.0\r\n";
          $header.='From:'.$_POST['nom'].'<'.$_POST['mail'].'>'."\n";
          $header.='Content-Type:text/html; charset="uft-8"'."\n";
          $header.='Content-Transfer-Encoding: 8bit';
          $sujet= $_POST['sujet'];
          $message='
          <html>
             <body>
                <div align="left">
                   <br />
                   <u>Nom de l\'expéditeur: </u>'.$_POST['nom'].'<br />
                   <u>Mail de l\'expéditeur: </u>'.$_POST['mail'].'<br />
                   <br />
                   '.nl2br($_POST['message']).'
                   <br />
                </div>
             </body>
          </html>
          ';
          mail("elv-diego.ptn@eduge.ch", "Formulaire de contact: " .$sujet , $message, $header);


            $msg= "<div class='alert alert-success' role='alert'> Votre message a bien été envoyer!</div>";

       }
       else {
          $msg="<div class='alert alert-danger' role='alert'> Vous devez remplir tout les champs!</div>";
       }

    }
    ?>

		<main role="main" class="container">
			<div class="row">
				<div class="col-md-12 blog-main">
					<section id="contact">
						<div class="container">
							<div class="well well-sm">
								<h3><strong>Contact </strong></h3>


							</div>


              <?php if (isset($_POST['button'])):

                echo $msg;
              endif; ?>

							<div class="row">
								<div class="col-md-7">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2762.0709793999126!2d6.132564715836894!3d46.18914619279765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478c7b288f52b40d%3A0xa4b771d96d8a3be2!2sAvenue%20Industrielle%2014%2C%201227%20Carouge!5e0!3m2!1sfr!2sch!4v1599144012637!5m2!1sfr!2sch" width="100%" height="315" frameborder="0" style="border:0" allowfullscreen></iframe>
								</div>
								<div class="col-md-5">
									<h4><strong>Nous contacter</strong></h4>
									<form method="POST" action="contact.php" >
										<div class="form-group">
											<input class="form-control mb-2" pattern="[a-zA-ZÀ-ÿ]{1,15}" type="text"  name="nom" placeholder="Votre nom" value="" />
											<input class="form-control mb-2" type="email" name="mail" placeholder="Votre email" value="" />
                      <input class="form-control mb-2" type="text" name="sujet" placeholder="Sujet du message" value="" />
                      <textarea class="form-control" name="message" placeholder="Votre message" rows="3"> </textarea>
										</div>
										<button class="btn btn-secondary" type="submit" name="button" value="Envoyer !">Envoyer</button>
									</form>



								</div>
							</div>
						</div>
					</section>
				</div><!-- /.row -->
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
            <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0" st>
              <h6 class="mb-0" style="color:white;">Vous pouvez aussi nous contactez sur les réseaux sociaux!</h6>
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
  </body>
</html>
