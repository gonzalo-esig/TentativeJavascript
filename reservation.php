<?php
$titre = "C&M - Réservation";
include('navbar.php');
?>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<html lang="en" dir="ltr">
  <head>
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
    <?php if(!empty($_SESSION["EST_CLIENT"]) ) { ?>
      <?php if ($_SESSION["EST_CLIENT"] == 1){
        $res=getReservation($_SESSION['ID_PERSONNEP']);
        $date1=date_create(date("d-m-Y", strtotime($res["RES_DATEDEBUT"])));
        $date2=date_create(date('d-m-Y'));
        $diff = date_diff($date2,$date1);

         if (!empty($res)){ ?>

          <?php if (isset($_POST['btnannulerres'])){

            delReservation($res['ID_PERSONNEP']);
            header("Location:reservation.php");
          }

  ?>
           <div class="d-flex justify-content-center"><h3>Votre rendez vous du <?= date("d-m-Y", strtotime($res["RES_DATEDEBUT"])); ?> </h3></div>
           <div class="d-flex justify-content-center"><h4>Heure : <?= date("H:i", strtotime($res["RES_DATEDEBUT"])); ?> </h4></div>
           <div class="d-flex justify-content-center"><h4>Motif : <?= $res["RES_MOTIF"]; ?> </h4></div>
           <div class="d-flex justify-content-center"><h4>Adresse : </h4></div><br>

           <div class="center-content-center">
             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2762.0709793999126!2d6.132564715836894!3d46.18914619279765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478c7b288f52b40d%3A0xa4b771d96d8a3be2!2sAvenue%20Industrielle%2014%2C%201227%20Carouge!5e0!3m2!1sfr!2sch!4v1599144012637!5m2!1sfr!2sch" width="100%" height="315" frameborder="0" style="border:0" allowfullscreen></iframe>
           </div>
           <div class="col-md-12 text-center">
             <br><br>

             <div class="d-flex justify-content-center"><h6>Annulation possible minimum 72h avant rendez-vous</h6></div>
            <?php   if ($diff->format("%R%a") >= 3): ?>

              <form method="POST" action="reservation.php">
              <button type="submit" name="btnannulerres" class="btn btn-primary"  >Annuler réservation</button>
              </form>
            <?php  else : ?>
              <button type="button" name="btnannulerres" class="btn btn-primary" disabled>Annuler réservation</button>
            <?php endif; ?>
       </div>
     <?php }else{ ?>
          <div class="d-flex justify-content-center"><h1>Prendre rendez-vous</h1></div>
          <link href='fullcalendar/main.css' rel='stylesheet' />
          <script src='fullcalendar/main.js'></script>
          <link href="calendar.css" rel="stylesheet">
          <script src="calendrierC.js"></script>
          <div id='calendar'></div>

        <?php } ?>
      <?php }else{
        $res=getReservationE($_SESSION['ID_PERSONNEMORALE']);
        $date1=date_create(date("d-m-Y", strtotime($res["RES_DATEDEBUT"])));
        $date2=date_create(date('d-m-Y'));
        $diff = date_diff($date2,$date1);

         if (!empty($res)){ ?>

          <?php if (isset($_POST['btnannulerres'])){

            delReservationE($res['ID_PERSONNEMORALE']);
            header("Location:reservation.php");
          }?>


           <div class="d-flex justify-content-center"><h3>Votre rendez vous du <?= date("d-m-Y", strtotime($res["RES_DATEDEBUT"])); ?> </h3></div>
           <div class="d-flex justify-content-center"><h4>Heure : <?= date("H:i", strtotime($res["RES_DATEDEBUT"])); ?> </h4></div>
           <div class="d-flex justify-content-center"><h4>Motif : <?= $res["RES_MOTIF"]; ?> </h4></div>
           <div class="d-flex justify-content-center"><h4>Adresse : </h4></div><br>

           <div class="center-content-center">
             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2762.0709793999126!2d6.132564715836894!3d46.18914619279765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478c7b288f52b40d%3A0xa4b771d96d8a3be2!2sAvenue%20Industrielle%2014%2C%201227%20Carouge!5e0!3m2!1sfr!2sch!4v1599144012637!5m2!1sfr!2sch" width="100%" height="315" frameborder="0" style="border:0" allowfullscreen></iframe>
           </div>
           <div class="col-md-12 text-center">
             <br><br>

             <div class="d-flex justify-content-center"><h6>Annulation possible minimum 72h avant rendez-vous</h6></div>
            <?php   if ($diff->format("%R%a") >= 3): ?>

              <form method="POST" action="reservation.php">
              <button type="submit" name="btnannulerres" class="btn btn-primary"  >Annuler réservation</button>
              </form>
            <?php  else : ?>
              <button type="button" name="btnannulerres" class="btn btn-primary" disabled>Annuler réservation</button>
            <?php endif; ?>
       </div>
      <?php }else{ ?>

        <div class="d-flex justify-content-center"><h1>Prendre rendez-vous</h1></div>
        <link href='fullcalendar/main.css' rel='stylesheet' />
        <script src='fullcalendar/main.js'></script>
        <link href="calendar.css" rel="stylesheet">
        <script src="calendrierE.js"></script>
        <div id='calendar'></div>

      <?php }} ?>
    <?php }elseif (!empty($_SESSION["EST_ADMIN"])) { ?>
      <link href='fullcalendar/main.css' rel='stylesheet' />
      <script src='fullcalendar/main.js'></script>
      <link href="calendar.css" rel="stylesheet">
      <script src="calendrierA.js"></script>
      <div id='calendar'></div>

    <?php }else{ ?>

      <h1 class="mb-6 text-center" >Veuillez <a href="login.php">vous connecter</a> pour prendre rendez-vous.</h1>


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
  <?php }?>
  </body>
</html>
