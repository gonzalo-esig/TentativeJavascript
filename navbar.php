<!doctype html>
<?php
require 'fonction.php';
session_start();

?>


<html lang="en">
  <head>
    <!-- responsive Smartphone -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
    <meta charset="utf-8">

    <title><?= $titre ?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
	  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icon page avec logo-->
    <link rel="icon" href="img/logo.png" type="image/gif">

    <link href='fullcalendar/main.css' rel='stylesheet' />
    <script src='fullcalendar/main.js'></script>

		<!-- Custom styles for this template -->
    <link href="css/footer.css" rel="stylesheet">
		<link href="css/blog.css" rel="stylesheet">
		<!-- JS, Popper.js, and jQuery -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
		<!-- Les icones utilisé -->
		<script src="https://kit.fontawesome.com/693819749c.js" crossorigin="anonymous"></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

    </script>
  </head>

  <body>
    <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-12 text-center">
            <a class="blog-header-logo text-dark" href="index.php"><img src="./img/logo.png" style="width:220px;"/></a>
          </div>
        </div>
      </header>
      <nav class="navbar navbar-expand-xl navbar-dark bg-dark1 rounded" style="margin:10px">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse colw" id="navbarsExample06">
        <ul class="navbar-nav mr-auto">
            <a class="text-muted1" href="index.php">Accueil</a>

            <a class="text-muted1" href="services.php">Services</a>

            <a class="text-muted1" href="partenaires.php">Partenaires</a>

            <a class="text-muted1" href="contact.php">Contact</a>

            <a class="text-muted1" href="reservation.php">Rendez-vous</a>

            <?php if(!empty($_SESSION["EST_CLIENT"]) ) : ?>
                  <a class="text-muted1" href="espaceClient.php">Espace Client</a>
                  <a class="text-muted1" href="logout.php">Se déconnecter</a>
            <?php elseif(!empty($_SESSION["EST_ADMIN"]))  : ?>
                  <a class="text-muted1" href="espaceAdmin.php">Espace Admin</a>
                  <a class="text-muted1" href="logout.php">Se déconnecter</a>

            <?php else : ?>
                <a class=" text-muted1" href="login.php">Se connecter</a>
            <?php endif; ?>
          </ul>
      </div>
    </nav>
  </div>
