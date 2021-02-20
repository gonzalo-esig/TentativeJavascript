<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<?php
			 $titre = "C&M Comptabilité Sàrl - Espace Admin";
			include('navbar.php');
			




if(!empty($_GET['amp;c'])){
	$est_client =$_GET['amp;c'];
}else {
	$est_client =$_GET['c'];
}








			$id = $_GET['id'];
			include_once 'dbconnect.php';

			$errorEC = "";
			$errorECexist ="";
		?>
				<title>C&M Comptabilité Sàrl</title>
				<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

				<!-- Custom styles for this template -->
				<link href="blog.css" rel="stylesheet">
				<!-- JS, Popper.js, and jQuery -->
				<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
				<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
				<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
				<!-- Les icones utilisé -->
				<script src="https://kit.fontawesome.com/693819749c.js" crossorigin="anonymous"></script>
	</head>
	<body>
		<main role="main" class="container">
			<div class="row">
				<div class="col-md-12 blog-main">
				<?php if ($est_client == 1): ?>
					<?php $user = getOneUserid($id); ?>
						<h2 class="text-center">Page documents de <strong style="color : #dc3545"><?= $user['PER_NOM']." ". $user['PER_PRENOM'] ?></h2>
						<hr>
					<?php else: ?>
					<?php $user = getOneUseridmorale($id); ?>
						<h2 class="text-center">Page documents de <strong style="color : #dc3545"><?= $user['PERM_NOM']?></h2>
						<hr>
				<?php endif; ?>

				<?php if ($_GET['st'] == 'success') { echo "<div class='alert alert-success text-center'> La modification a été faite </div>";	}?>
				<?php if ($_GET['dl'] == 'success') { echo "<div class='alert alert-success text-center'> La suppression a été faite </div>";	}?>

				<?php
					if (isset($_POST['btnValiderEspaceClientAD'])){
						if ($est_client == 1) {

							$idclientpostespace = $user['ID_PERSONNEP'];
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
									if ($emailpostespace == $user['PER_EMAIL']) {
										updateespaceclientC($idclientpostespace,$nompostespace,$prenompostespace,$emailpostespace,$datenaissancepostespace,$phonepostespace,$codepostalpostespace,$localitepostespace,$adressepostespace);
										$user = getOneUser($emailpostespace);
									}
									else {
									$errorEC = "<div class='alert alert-danger' role='alert'> Cette adresse mail est déjà utlisée !</div>";
									}
								}
								else {
								updateespaceclientC($idclientpostespace,$nompostespace,$prenompostespace,$emailpostespace,$datenaissancepostespace,$phonepostespace,$codepostalpostespace,$localitepostespace,$adressepostespace);
								$user = getOneUser($emailpostespace);
								}
							}
							else {
							$errorECexist = "<div class='alert alert-danger' role='alert'> Cette adresse mail n'est pas valide !</div>";
							}
						}
						else {
							$idclientpostespace = $user['ID_PERSONNEMORALE'];
							$nompostespace = $_POST["nomES"];
							$emailpostespace = $_POST["emailES"];
							$phonepostespace= $_POST["telES"];

							$adressepostespace =$_POST["adresseES"];
							$codepostalpostespace = $_POST["zipCodeES"];
							$localitepostespace = $_POST["localiteES"];
							if (filter_var($emailpostespace,FILTER_VALIDATE_EMAIL)) {
								$user = getOneUsermorale($emailpostespace);
								if (!empty($user)) {
									if ($emailpostespace == $user['PERM_EMAIL']) {
										updateespaceclientE($idclientpostespace,$nompostespace,$emailpostespace,$phonepostespace,$codepostalpostespace,$localitepostespace,$adressepostespace);
										$user = getOneUsermorale($emailpostespace);
									}
									else {
										$errorEC = "<div class='alert alert-danger' role='alert'> Cette adresse mail est déjà utlisée !</div>";
									}
								}
								else {
									updateespaceclientE($idclientpostespace,$nompostespace,$emailpostespace,$phonepostespace,$codepostalpostespace,$localitepostespace,$adressepostespace);
									$user = getOneUsermorale($emailpostespace);
								}
							}
							else {
								$errorECexist = "<div class='alert alert-danger' role='alert'> Cette adresse mail n'est pas valide !</div>";
							}
						}
					}

					if (isset($_POST['ValiderD'])){
						ValiderDocument();
					}
				?>
				<?php
					// fetch files
					$sql =" select DOC_NOM,DOC_STATUS,d.ID_DOCUMENT from document as d , appartient as ap, personnephysique as pp WHERE d.ID_DOCUMENT = ap.ID_DOCUMENT AND ap.ID_PERSONNEP = pp.ID_PERSONNEP AND pp.ID_PERSONNEP = ".$user['ID_PERSONNEP']."";
					$result = mysqli_query($con, $sql);
				?>
					<div class=" cascading-modal" role="document">
						<!--Content-->
						<div class="modal-content">

															<div class="modal-body">

																<div class="row">
																	<div class="col-12 col-xs-offset-2 mt-3">
																		<table class="table table-striped table-hover">

																			<thead>
																				<tr>
																					<th>Nom Document</th>
																					<th>Voir</th>
																					<th>Télécharger</th>
																					<th>Status</th>
																					<?php if($row['DOC_STATUS'] == 0 ){
																						echo "<th> Action </th>";
																						echo "<th></th>";
																						}
																						elseif($row['DOC_STATUS'] == 1){
																						echo "<th> Action </th>";
																						}
																						else{
																						echo "<th> Action </th>";
																						}
																				?>
																				</tr>
																			</thead>
																			<tbody>
																			<?php
																			while($row = mysqli_fetch_array($result)) { ?>
																			<tr>
																				<td><?php echo $row['DOC_NOM']; ?></td>
																				<td><a href="uploads/<?php echo $user['PER_NOM'].$user['PER_PRENOM']."/"; ?><?php echo $row['DOC_NOM']; ?>" target="_blank">Voir</a></td>
																				<td><a href="uploads/<?php echo $user['PER_NOM'].$user['PER_PRENOM']."/"; ?><?php echo $row['DOC_NOM']; ?>" download><i class="fa fa-download"></i>Télécharger</td>
																				<?php if($row['DOC_STATUS'] == 0 ){
																						echo "<td class='alert alert-primary pt-3' > En Traitement </td>";
																						echo "<td>";
																						echo "<form action='accepter.php/?id_doc=$row[ID_DOCUMENT]&idpersonne=$user[ID_PERSONNEP]' method='post' enctype='multipart/form-data'>";
																						echo "<input type='submit' name='submit' value='Accepter' class='btn btn-success'/>";
																						echo "</form>";
																						echo "</td>";
																						echo "<td>";
																						echo "<form action='refuser.php/?id_doc=$row[ID_DOCUMENT]&idpersonne=$user[ID_PERSONNEP]' method='post' enctype='multipart/form-data'>";
																						echo "<input type='submit' name='submit' value='Refuser' class='btn btn-danger'/>";
																						echo "</form>";
																						echo "</td>";
																						}
																						elseif($row['DOC_STATUS'] == 1){
																						echo "<td class='alert alert-success' > Validé </td>";
																						echo "<td>";
																						echo "<form action='supprimer.php/?id_doc=$row[ID_DOCUMENT]&idpersonne=$user[ID_PERSONNEP]' method='post' enctype='multipart/form-data'>";
																						echo "<input type='submit' name='submit' value='Supprimer' class='btn btn-dark'/>";
																						echo "</form>";
																						echo "</td>";
																						echo "<td>";
																						echo "<form action='refuser.php/?id_doc=$row[ID_DOCUMENT]&idpersonne=$user[ID_PERSONNEP]' method='post' enctype='multipart/form-data'>";
																						echo "<input type='submit' name='submit' value='Refuser' class='btn btn-danger'/>";
																						echo "</form>";
																						echo "</td>";
																						}
																						else{
																						echo "<td class='alert alert-danger' > Refusé </td>";
																						echo "<td>";
																						echo "<form action='supprimer.php/?id_doc=$row[ID_DOCUMENT]&idpersonne=$user[ID_PERSONNEP]' method='post' enctype='multipart/form-data'>";
																						echo "<input type='submit' name='submit' value='Supprimer' class='btn btn-dark'/>";
																						echo "</form>";
																						echo "</td>";
																						echo "<td>";
																						echo "<form action='accepter.php/?id_doc=$row[ID_DOCUMENT]&idpersonne=$user[ID_PERSONNEP]' method='post' enctype='multipart/form-data'>";
																						echo "<input type='submit' name='submit' value='Accepter' class='btn btn-success'/>";
																						echo "</form>";
																						echo "</td>";
																						}
																				?>

																			</tr>
																			<?php } ?>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
														</div>
														<!--/.Panel 2019-->


			</div>
					  <div class="btn-group ml-3 mr-2 mt-4" role="group" aria-label="Second group">
						<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#ModalModifInfo" style="background-color : #26479e;">Modifier  informations </button>
					  </div>
		</main><!-- /.container -->


    <?php if (!empty($user['ID_PERSONNEP']) ): ?>
      <?php echo $errorEC ?>
      <?php echo $errorECexist ?>

      <form action="docsClient.php?id=<?=$user['ID_PERSONNEP']?>&amp;c=1" method="post">




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
              <input type="text" name="nomES" class="form-control" placeholder="Insérez votre nom" required autofocus=""value='<?php echo $user['PER_NOM'] ?>'pattern="[a-zA-ZÀ-ÿ]{1,15}" maxlength="15">
              <input type="text" name="prenomES" class="form-control" placeholder="Insérez votre prénom" required autofocus="" value='<?php echo $user['PER_PRENOM'] ?>'pattern="[a-zA-ZÀ-ÿ]{1,15}" maxlength="15">
            </div>
          </div>
          <div class="md-form form-sm mb-3">
            <div class="input-group">
              <input type="email" name="emailES" class="form-control" placeholder="Insérez votre adresse mail" required autofocus=" "value='<?php echo $user['PER_EMAIL'] ?>'maxlength="30">
              <span class="input-group-append">
                <div class="input-group-text bg-transparent"><i class="fas fa-at"></i></div>
              </span>
            </div>
          </div>

          <div class="md-form form-sm mb-3">
            <input type="date" name="dateNaissanceES" class="form-control"  required autofocus="" value='<?php echo $user['PER_DATEDENAISSANCE'] ?>'maxlength="6">
          </div>
          <div class="md-form form-sm mb-3">
            <input type="text" name="telES" class="form-control" placeholder="Insérez votre numéro de téléphone portable" required autofocus="" value='<?php echo "0".$user['PER_TELEPHONE'] ?>'maxlength="15" minlength="10">
          </div>
          <div class="md-form form-sm mb-3">
            <div class="input-group">
              <span class="input-group-append">
                <div class="input-group-text bg-transparent">Adresse</div>
              </span>
              <input type="text" name="adresseES" class="form-control" placeholder="votre adresse" required autofocus="" value='<?php echo $user['PER_ADRESSE'] ?>'maxlength="50">
            </div>
          </div>
          <div class="md-form form-sm mb-3">
            <div class="input-group">
              <input type="text" name="zipCodeES" class="form-control" placeholder="Code Postale" required autofocus=""value='<?php echo $user['PER_CODEPOSTAL'] ?>'minlength="4">
              <span class="input-group-append">

              </span>
              <input type="text" name="localiteES" class="form-control" placeholder="Localité" required autofocus=""value='<?php echo $user['PER_LOCALITE'] ?>'pattern="[a-zA-ZÀ-ÿ]{1,15}" maxlength="15">
            </div>
          </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-secondary" data-dismiss="modal" >Fermer</button>
              <button type="submit" class="btn btn-dark" name="btnValiderEspaceClientAD">Envoyer</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <?php else: ?>
      <?php echo $errorEC ?>
      <?php echo $errorECexist ?>


        <form  action="docsClient.php?id=<?=$user['ID_PERSONNEMORALE']?>&amp;c=1" method="post">
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
              <input type="text" name="nomES" class="form-control" placeholder="Insérez votre nom" required autofocus=""value='<?php echo $user['PERM_NOM'] ?>'>

            </div>
          </div>
          <div class="md-form form-sm mb-3">
            <div class="input-group">
              <input type="email" name="emailES" class="form-control" placeholder="Insérez votre adresse mail" required autofocus=" "value='<?php echo $user['PERM_EMAIL'] ?>'>
              <span class="input-group-append">
                <div class="input-group-text bg-transparent"><i class="fas fa-at"></i></div>
              </span>
            </div>
          </div>


          <div class="md-form form-sm mb-3">
            <input type="text" name="telES" class="form-control" placeholder="Insérez votre numéro de téléphone portable" required autofocus="" value='<?php echo "0".$user['PERM_TELEPHONE'] ?>'>
          </div>
          <div class="md-form form-sm mb-3">
            <div class="input-group">
              <span class="input-group-append">
                <div class="input-group-text bg-transparent">Adresse</div>
              </span>
              <input type="text" name="adresseES" class="form-control" placeholder="votre adresse" required autofocus="" value='<?php echo $user['PERM_ADRESSE'] ?>'>
            </div>
          </div>
          <div class="md-form form-sm mb-3">
            <div class="input-group">
              <input type="text" name="zipCodeES" class="form-control" placeholder="Code Postale" required autofocus=""value='<?php echo $user['PERM_CODEPOSTAL'] ?>'>
              <span class="input-group-append">

              </span>
              <input type="text" name="localiteES" class="form-control" placeholder="Localité" required autofocus=""value='<?php echo $user['PERM_LOCALITE'] ?>'>
            </div>
          </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-dark" name="btnValiderEspaceClientAD">Envoyer</button>
            </div>
          </div>
        </div>
      </div>
      </form>

    <?php endif; ?>

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
