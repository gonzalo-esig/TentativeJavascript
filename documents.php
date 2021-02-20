 <!doctype html>
<html>
  <head>
    <?php
      $titre = "C&M Comptabilité Sàrl - Espace Client";
      include('navbar.php');
      include_once 'dbconnect.php';

    if ($_SESSION['EST_CLIENT'] == 1){
        $nom = $_SESSION["PER_NOM"];
        $prenom = $_SESSION["PER_PRENOM"];
    	$idpersonne = $_SESSION["ID_PERSONNEP"];
    	// fetch files
    	$sql =" select DOC_NOM,DOC_STATUS from document as d , appartient as ap, personnephysique as pp WHERE d.ID_DOCUMENT = ap.ID_DOCUMENT AND ap.ID_PERSONNEP = pp.ID_PERSONNEP AND pp.ID_PERSONNEP = ".$idpersonne."";
    	$result = mysqli_query($con, $sql);
     }
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
          <?php if(isset($_GET['st'])) { ?>
                <?php if ($_GET['st'] == 'success') {
                  echo "<div class='alert alert-success text-center'> Le document a bien été téléchargé ! </div>";
                }
                else
                {
                  echo "<div class='alert alert-danger text-center'> Téléchargement refusé ! Vous avez mis une mauvaise extension de fichier, veuillez choisir soit .pdf ou .docx </div>";
                } ?>
          <?php } ?>
                        <div id="alert"></div>
                                <div class="row">
                                  <div class="cold-md-12 ml-3">
                                    <form action="uploads.php" method="post" enctype="multipart/form-data">
                                        <legend>Choisir un fichier à ajouter :</legend>
                                        <div class="row">
                                          <div class="cold-md-4 mt-4 ml-4 mb-2">
                                            <input type="file" name="file1" id="FileAdd"/>
                                          </div>
                                          <div class="cold-md-4 mt-4 mr-3" id="ajout">
                                            
                                          </div>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-12 col-xs-offset-2 mt-3">
                                    <table class="table table-striped table-hover">
                                      <thead>
                                        <tr>
                                          <th>Nom Document</th>
                                          <th>Voir</th>
                                          <th>Télécharger</th>
                                          <th>Status</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                      while($row = mysqli_fetch_array($result)) { ?>
                                      <tr>
                                        <td><?php echo $row['DOC_NOM']; ?></td>
                                        <td><a href="uploads/<?php echo $nom.$prenom."/"; ?><?php echo $row['DOC_NOM']; ?>" target="_blank">Voir</a></td>
                                        <td><a href="uploads/<?php echo $nom.$prenom."/"; ?><?php echo $row['DOC_NOM']; ?>" download>Télécharger</td>
                                        <?php if($row['DOC_STATUS'] == 0 ){
                                            echo "<td class='alert alert-primary' > En Traitement </td>";
                                            }
                                            elseif($row['DOC_STATUS'] == 1){
                                            echo "<td class='alert alert-success' > Validé </td>";
                                            }
                                            else{
                                            echo "<td class='alert alert-danger' > Refusé </td>";
                                            }
                                        ?>
                                      </tr>
                                      <?php } ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                            <!--/.Panel 2019-->
        </div>
      </div>
    </main>
  <footer>
    <!-- /.container -->
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
<script src="js/document.js"></script>
  </body>
</html>
