<?php
  $titre = "C&M - Espace client";
  include('navbar.php');
  $errorEC = "";
  $errorECexist ="";
  $nvmdpE="";
?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

		<!-- Custom styles for this template -->
		<link href="css/blog.css" rel="stylesheet">
		<!-- JS, Popper.js, and jQuery -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
		<!-- Les icones utilisé -->
		<script src="https://kit.fontawesome.com/693819749c.js" crossorigin="anonymous"></script>

		<main role="main" class="container">
			<div class="row">
				<div class="col-md-12 blog-main">
					<div class="row">
						<div class="col-sm-3 col-md-3" >
						</div>
						<div class="col-sm-6 col-md-6">



              <?php if ($_SESSION['EST_CLIENT'] == 1): ?>
                <?php


                 $nomespace = $_SESSION["PER_NOM"];
                      $prenomespace = $_SESSION["PER_PRENOM"];
                      $emailespace = $_SESSION["PER_EMAIL"];
                      $datenaissancespace = $_SESSION['PER_DATEDENAISSANCE'];
                      $datenaissancespacef = date("d-m-Y", strtotime($_SESSION["PER_DATEDENAISSANCE"]));
                      $telespace = $_SESSION["PER_TELEPHONE"];
                      $adresseespace = $_SESSION["PER_ADRESSE"];
                      $cpespace = $_SESSION["PER_CODEPOSTAL"];
                      $localiteespace = $_SESSION["PER_LOCALITE"];

                ?>

                <h4><?php echo  $nomespace  ?></h4>
                <h5><?php echo   $prenomespace ?></h5>
                <h6><?php echo   $emailespace ?></h6>
                <h6><?php echo $datenaissancespacef ?></h6>
                <h6><?php echo $telespace ?></h6>
                <h6><?php echo $adresseespace ?></h6>
				<h6><?php echo  $cpespace ." ". $localiteespace ?></h6>

              <?php else: ?>

                <?php  $nomespaceE = $_SESSION["PERM_NOM"];
                      $emailespaceE = $_SESSION["PERM_EMAIL"];
                      $telespaceE = $_SESSION["PERM_TELEPHONE"];
                      $adresseespaceE = $_SESSION["PERM_ADRESSE"];
                      $cpespaceE = $_SESSION["PERM_CODEPOSTAL"];
                      $localiteespaceE = $_SESSION["PERM_LOCALITE"];

                ?>

                <h4><?php echo   $nomespaceE ?></h4>
                <h6><?php echo   $emailespaceE ?></h6>
                <h6><?php echo $telespaceE ?></h6>
                <h6><?php echo   $adresseespaceE ." ". $cpespaceE ." ". $localiteespaceE ?></h6>

              <?php endif; ?>

							<div class="btn-group ml-2 mr-2" role="group" aria-label="Second group">
								<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#ModalModifInfo" style="background-color : #26479e;">Modifier vos informations </button>
							</div>
							<div class="btn-group" role="group" aria-label="Third group">
								<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#ModalModifMdp" style="background-color : #26479e;">Modifier votre mot de passe </button>
							</div>
						</div>
						<div class="col-sm-3 col-md-3">
						</div>
					</div>
					<!-- Modal Modif Infos-->
          <?php if (isset($_POST['btnValiderEspaceClient'])){
            if ($_SESSION['EST_CLIENT'] == 1) {

              $idclientpostespace = $_SESSION['ID_PERSONNEP'];
              $nompostespace = $_POST["nomES"];
              $prenompostespace = $_POST["prenomES"];
              $emailpostespace = $_POST["emailES"];
              $datenaissancepostespace = $_POST['dateNaissanceES'];
              $phonepostespace= $_POST["telES"];

              $adressepostespace =$_POST["adresseES"];
              $codepostalpostespace = $_POST["zipCodeES"];
              $localitepostespace = $_POST["localiteES"];
			  
				if (!preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $adressepostespace)){
				
				
              if (filter_var($emailpostespace,FILTER_VALIDATE_EMAIL)) {
              $user = getOneUser($emailpostespace);
              if (!empty($user)) {
                if ($emailpostespace == $_SESSION['PER_EMAIL']) {
                  updateespaceclientC($idclientpostespace,$nompostespace,$prenompostespace,$emailpostespace,$datenaissancepostespace,$phonepostespace,$codepostalpostespace,$localitepostespace,$adressepostespace);
                  $user = getOneUser($emailpostespace);
                  $_SESSION["ID_PERSONNEP"]  = $user["ID_PERSONNEP"];
                  $_SESSION["PER_NOM"]  = $user["PER_NOM"];
                  $_SESSION["PER_PRENOM"]  = $user["PER_PRENOM"];
                  $_SESSION["PER_EMAIL"]  = $user["PER_EMAIL"];
                  $_SESSION["PER_DATEDENAISSANCE"]  = $user["PER_DATEDENAISSANCE"];
                  $_SESSION["PER_TELEPHONE"]  = $user["PER_TELEPHONE"];
                  $_SESSION["PER_CODEPOSTAL"]  = $user["PER_CODEPOSTAL"];
                  $_SESSION["PER_LOCALITE"]  = $user["PER_LOCALITE"];
                  $_SESSION["PER_ADRESSE"]  = $user["PER_ADRESSE"];

                        header("Location:espaceClient.php");

                }else {

                    $errorEC = "<div class='alert alert-danger' role='alert'> Cette adresse mail est déjà utlisée !</div>";
                }

              }else {
                updateespaceclientC($idclientpostespace,$nompostespace,$prenompostespace,$emailpostespace,$datenaissancepostespace,$phonepostespace,$codepostalpostespace,$localitepostespace,$adressepostespace);
                $user = getOneUser($emailpostespace);
                $_SESSION["ID_PERSONNEP"]  = $user["ID_PERSONNEP"];
                $_SESSION["PER_NOM"]  = $user["PER_NOM"];
                $_SESSION["PER_PRENOM"]  = $user["PER_PRENOM"];
                $_SESSION["PER_EMAIL"]  = $user["PER_EMAIL"];
                $_SESSION["PER_DATEDENAISSANCE"]  = $user["PER_DATEDENAISSANCE"];
                $_SESSION["PER_TELEPHONE"]  = $user["PER_TELEPHONE"];
                $_SESSION["PER_CODEPOSTAL"]  = $user["PER_CODEPOSTAL"];
                $_SESSION["PER_LOCALITE"]  = $user["PER_LOCALITE"];
                $_SESSION["PER_ADRESSE"]  = $user["PER_ADRESSE"];

                      header("Location:espaceClient.php");

              }
            }else {
              $errorECexist = "<div class='alert alert-danger' role='alert'> Cette adresse mail n'est pas valide !</div>";
            }
            }else {
				
				echo "<div class='alert alert-danger' role='alert'> cette adresse n'est pas valide !</div>";
			}
			
			
			}else {
              $idclientpostespace = $_SESSION['ID_PERSONNEMORALE'];
              $nompostespace = $_POST["nomES"];
              $prenompostespace = $_POST["prenomES"];
              $emailpostespace = $_POST["emailES"];
              $datenaissancepostespace = $_POST['dateNaissanceES'];
              $phonepostespace= $_POST["telES"];

              $adressepostespace =$_POST["adresseES"];
              $codepostalpostespace = $_POST["zipCodeES"];
              $localitepostespace = $_POST["localiteES"];
              if (filter_var($emailpostespace,FILTER_VALIDATE_EMAIL)) {
              $user = getOneUser($emailpostespace);
              if (!empty($user)) {
                if ($emailpostespace == $_SESSION['PERM_EMAIL']) {
                  updateespaceclientE($idclientpostespace,$nompostespace,$emailpostespace,$phonepostespace,$codepostalpostespace,$localitepostespace,$adressepostespace);
                  $user = getOneUsermorale($emailpostespace);
                  $_SESSION["ID_PERSONNEMORALE"]  = $user["ID_PERSONNEMORALE"];
                  $_SESSION["PERM_NOM"]  = $user["PERM_NOM"];
                  $_SESSION["PERM_PRENOM"]  = $user["PERM_PRENOM"];
                  $_SESSION["PERM_EMAIL"]  = $user["PERM_EMAIL"];
                  $_SESSION["PERM_DATEDENAISSANCE"]  = $user["PERM_DATEDENAISSANCE"];
                  $_SESSION["PERM_TELEPHONE"]  = $user["PERM_TELEPHONE"];
                  $_SESSION["PERM_CODEPOSTAL"]  = $user["PERM_CODEPOSTAL"];
                  $_SESSION["PERM_LOCALITE"]  = $user["PERM_LOCALITE"];
                  $_SESSION["PERM_ADRESSE"]  = $user["PERM_ADRESSE"];

                        header("Location:espaceClient.php");

                }else {

                    $errorEC = "<div class='alert alert-danger' role='alert'> Cette adresse mail est déjà utlisée !</div>";
                }
              }else {
                updateespaceclientE($idclientpostespace,$nompostespace,$emailpostespace,$phonepostespace,$codepostalpostespace,$localitepostespace,$adressepostespace);
                $user = getOneUsermorale($emailpostespace);
                $_SESSION["ID_PERSONNEMORALE"]  = $user["ID_PERSONNEMORALE"];
                $_SESSION["PERM_NOM"]  = $user["PERM_NOM"];
                $_SESSION["PERM_PRENOM"]  = $user["PERM_PRENOM"];
                $_SESSION["PERM_EMAIL"]  = $user["PERM_EMAIL"];
                $_SESSION["PERM_DATEDENAISSANCE"]  = $user["PERM_DATEDENAISSANCE"];
                $_SESSION["PERM_TELEPHONE"]  = $user["PERM_TELEPHONE"];
                $_SESSION["PERM_CODEPOSTAL"]  = $user["PERM_CODEPOSTAL"];
                $_SESSION["PERM_LOCALITE"]  = $user["PERM_LOCALITE"];
                $_SESSION["PERM_ADRESSE"]  = $user["PERM_ADRESSE"];

                      header("Location:espaceClient.php");

              }
            }else {
              $errorECexist = "<div class='alert alert-danger' role='alert'> Cette adresse mail n'est pas valide !</div>";
            }
            }
			} 
          if (isset($_POST['btnValiderEspaceMDP'])) {
            if ($_SESSION['EST_CLIENT'] == 1) {
              $nvmdpE1 = $_POST['nvmdpE1'];
              $nvmdpE2 = $_POST['nvmdpE2'];
              $email = $_SESSION['PER_EMAIL'];
              if ($nvmdpE1 == $nvmdpE2) {
              changeMDP($email,sha1($nvmdpE1));
              $nvmdpE = "<div class='alert alert-success' role='alert'> Votre mot de passe a été modifié !</div>";

              }else {
              $nvmdpE= "<div class='alert alert-danger' role='alert'>  Les mots de passes doivent être identiques ! </div>";
              }
              }else {
                $nvmdpE1 = $_POST['nvmdpE1'];
                $nvmdpE2 = $_POST['nvmdpE2'];
                $email = $_SESSION['PERM_EMAIL'];
                if ($nvmdpE1 == $nvmdpE2) {
                changeMDPmorale($email,sha1($nvmdpE1));
                $nvmdpE = "<div class='alert alert-success' role='alert'> Votre mot de passe a été modifié !</div>";

                }else {
                $nvmdpE= "<div class='alert alert-danger' role='alert'>  Les mots de passes doivent être identiques ! </div>";
                }
            }
          }

           ?>
                        <?php if ($_SESSION['EST_CLIENT'] == 1): ?>
                          <form action="espaceClient.php" method="post">

                          <?php echo $errorEC ?>
                          <?php echo $errorECexist ?>
                          <?php echo $nvmdpE ?>


                          <div class="modal fade" id="ModalModifInfo" tabindex="-1" role="dialog" aria-labelledby="MotDePasseOublier" aria-hidden="true">
                						<div class="modal-dialog" role="document">
                							<div class="modal-content">
                								<div class="modal-header">
                									<h5 class="modal-title" id="MotDePasseOublier">Modifier ses informations</h5>
                									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                										<span aria-hidden="true">&times;</span>
                									</button>
                								</div>
                								<div class="modal-body">

                							<div class="md-form form-sm mb-3">
                								<div class="input-group">
                									<input type="text" name="nomES" class="form-control" placeholder="Insérez votre nom" required autofocus=""value='<?php echo $nomespace; ?>'pattern="[a-zA-ZÀ-ÿ]{1,15}" maxlength="15">
                									<input type="text" name="prenomES" class="form-control" placeholder="Insérez votre prénom" required autofocus="" value='<?php echo $prenomespace; ?>'pattern="[a-zA-ZÀ-ÿ]{1,15}" maxlength="15">
                								</div>
                							</div>
                							<div class="md-form form-sm mb-3">
                								<div class="input-group">
                									<input type="email" name="emailES" class="form-control" placeholder="Insérez votre adresse mail" required autofocus=" "value='<?php echo $emailespace; ?>'maxlength="30">
                									<span class="input-group-append">
                										<div class="input-group-text bg-transparent"><i class="fas fa-at"></i></div>
                									</span>
                								</div>
                							</div>

                							<div class="md-form form-sm mb-3">
                								<input type="date" name="dateNaissanceES" class="form-control"  required autofocus="" value='<?php echo $datenaissancespace; ?>'maxlength="6">
                							</div>
                							<div class="md-form form-sm mb-3">
                								<input type="text" name="telES" class="form-control" placeholder="Insérez votre numéro de téléphone portable" required autofocus="" value='<?php echo "0".$telespace ?>'maxlength="15" minlength="10">
                							</div>
                							<div class="md-form form-sm mb-3">
                								<div class="input-group">
                									<span class="input-group-append">
                										<div class="input-group-text bg-transparent">Adresse</div>
                									</span>
                									<input type="text" name="adresseES" class="form-control" placeholder="votre adresse" required autofocus="" value='<?php echo $adresseespace; ?>' pattern="[a-zA-ZÀ-ÿ ]{1,50}">
                								</div>
                							</div>
                							<div class="md-form form-sm mb-3">
                								<div class="input-group">
                									<input type="text" name="zipCodeES" class="form-control" placeholder="Code Postale" required autofocus=""value='<?php echo $cpespace; ?>'minlength="4">
                									<span class="input-group-append">

                									</span>
                									<input type="text" name="localiteES" class="form-control" placeholder="Localité" required autofocus=""value='<?php echo $localiteespace; ?>'pattern="[a-zA-ZÀ-ÿ]{1,15}" maxlength="15">
                								</div>
                							</div>
                								</div>
                								<div class="modal-footer">
                									<button type="reset" class="btn btn-secondary" data-dismiss="modal" >Fermer</button>
                									<button type="submit" class="btn btn-dark" name="btnValiderEspaceClient">Envoyer</button>
                								</div>
                							</div>
                						</div>
                					</div>
                        </form>
                        <?php else: ?>

                            <?php echo $errorEC ?>
                            <?php echo $errorECexist ?>
                            <?php echo $nvmdpE ?>
                            <form  action="espaceClient.php" method="post">
                          <div class="modal fade" id="ModalModifInfo" tabindex="-1" role="dialog" aria-labelledby="MotDePasseOublier" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="MotDePasseOublier">Modifier ses informations</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                              <div class="md-form form-sm mb-3">
                                <div class="input-group">
                                  <input type="text" name="nomES" class="form-control" placeholder="Insérez votre nom" required autofocus=""value='<?php echo $nomespaceE; ?>'>

                                </div>
                              </div>
                              <div class="md-form form-sm mb-3">
                                <div class="input-group">
                                  <input type="email" name="emailES" class="form-control" placeholder="Insérez votre adresse mail" required autofocus=" "value='<?php echo $emailespaceE; ?>'>
                                  <span class="input-group-append">
                                    <div class="input-group-text bg-transparent"><i class="fas fa-at"></i></div>
                                  </span>
                                </div>
                              </div>


                              <div class="md-form form-sm mb-3">
                                <input type="text" name="telES" class="form-control" placeholder="Insérez votre numéro de téléphone portable" required autofocus="" value='<?php echo "0".$telespaceE ?>'>
                              </div>
                              <div class="md-form form-sm mb-3">
                                <div class="input-group">
                                  <span class="input-group-append">
                                    <div class="input-group-text bg-transparent">Adresse</div>
                                  </span>
                                  <input type="text" name="adresseES" class="form-control" placeholder="votre adresse" required autofocus="" value='<?php echo $adresseespaceE; ?>'>
                                </div>
                              </div>
                              <div class="md-form form-sm mb-3">
                                <div class="input-group">
                                  <input type="text" name="zipCode" class="form-control" placeholder="Code Postale" required autofocus=""value='<?php echo $cpespaceE; ?>'>
                                  <span class="input-group-append">

                                  </span>
                                  <input type="text" name="localite" class="form-control" placeholder="Localité" required autofocus=""value='<?php echo $localiteespaceE; ?>'>
                                </div>
                              </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="reset" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                  <button type="submit" class="btn btn-dark" name="btnValiderEspaceClient">Envoyer</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          </form>

                        <?php endif; ?>

					<!-- Fin Modal Modif Infos-->
					<!-- Modal Modif Infos-->

					<div class="modal fade" id="ModalModifMdp" tabindex="-1" role="dialog" aria-labelledby="MotDePasseOublier" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="MotDePasseOublier">Modifier votre mot de passe</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>

      <form  action="espaceClient.php" method="post">

								<div class="modal-body">

                  <div class="md-form form-sm mb-3">
                    <div class="input-group">
                      <input class="form-control py-2 border-right-0 border" name="nvmdpE1" type="password" placeholder="Nouveau mot de passe" required maxlength="30" minlength = "6">
                      <span class="input-group-append">
                        <div class="input-group-text bg-transparent"><i class="fas fa-key"></i></div>
                      </span>
                    </div>
                  </div>

                <div class="md-form form-sm mb-3">
                  <div class="input-group">
                    <input class="form-control py-2 border-right-0 border" name="nvmdpE2" type="password" placeholder="retapez votre mot de passe" required maxlength="30" minlength = "6">
                    <span class="input-group-append">
                      <div class="input-group-text bg-transparent"><i class="fas fa-key"></i></div>
                    </span>
                  </div>
                </div>

							</div>
								<div class="modal-footer">
									<button type="reset" class="btn btn-secondary" data-dismiss="modal" >Fermer</button>
									<button type="submit" class="btn btn-dark" name="btnValiderEspaceMDP">Envoyer</button>
								</div>
          </form>
							</div>
						</div>
					</div>

					<!-- Fin Modal Modif Infos-->

					<div class="mt-5 row">

						<div class="col-sm-4 col-md-4" >
						<button id="document" type="submit" class="btn btn-dark" style="background-color : #26479e;" onclick="document.location.href='documents.php';">Mes documents</button>
						</div>

						<div class="col-sm-4 col-md-4">
						</div>
						<div class="col-sm-4 col-md-4">
						</div>
					</div>

				</div><!-- /.row -->
			</div>
		</main><!-- /.container -->
    <!-- Footer -->
    <footer class="page-footer font-small">

      <div style="background-color: #4560a7; margin-top:50px">
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
