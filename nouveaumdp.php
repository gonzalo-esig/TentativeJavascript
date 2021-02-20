<?php
  $titre = "C&M - Nouveau mot de passe";
  include('navbar.php');
  $codevalide = 0;
  $errormdp = "";
  $errorcodeverif = "";



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




<?php


if (isset($_POST['btnVerifCode'])) {

$codeverif = $_POST['codeverif'];

$user = getOneUserCodeVerif($codeverif);
$email = $user['PER_EMAIL'];

if (!empty($user)) {

$_SESSION['PER_EMAIL'] = $email;
deleteCodeValidation($email);
$codevalide = 1;

} else {
  $user = getOneUserCodeVerifmorale($codeverif);
  $email = $user['PERM_EMAIL'];
if (!empty($user)) {

  $_SESSION['PERM_EMAIL'] = $email;
  deleteCodeValidationmorale($email);
  $codevalide = 1;


} else {
  $errorcodeverif = "<div class='alert alert-danger' role='alert'>  Le code est incorrect !</div>";
}
}
}



if (isset($_POST['btnChangermdp'])) {

$mdp = $_POST['nvmdp1'];
$mdp2 = $_POST['nvmdp2'];
$email = $_SESSION['PER_EMAIL'];

if (empty($email)) {
$email = $_SESSION['PERM_EMAIL'];
if ($mdp == $mdp2) {


changeMDPmorale($email,sha1($mdp));
session_destroy();
header("Location:login.php");

} else {

$errormdp = "<div class='alert alert-danger' role='alert'>  Les mots de passes doivent être identiques ! </div>";
  $codevalide = 1;

}

}else {

  if ($mdp == $mdp2) {


  changeMDP($email,sha1($mdp));
  session_destroy();
  header("Location:login.php");

  } else {

  $errormdp = "<div class='alert alert-danger' role='alert'>  Les mots de passes doivent être identiques ! </div>";
    $codevalide = 1;


  }




}


if ($mdp == $mdp2) {


changeMDP($email,sha1($mdp));
session_destroy();
header("Location:login.php");

} else {

$errormdp = "<div class='alert alert-danger' role='alert'>  Les mots de passes doivent être identiques ! </div>";
  $codevalide = 1;


}

}





 ?>















<main role="main" class="container">
  <div class="row">
    <div class="col-md-12 blog-main">
      <div class="modal-dialog cascading-modal" role="document">
<!--Content-->
<div class="modal-content">


	<div class="modal-c-tabs">





  <div class="tab-pane fade in show active" id="panel1" role="tabpanel">

<?php if ($codevalide == 0): ?>
<?php echo $errorcodeverif ?>

  <form method="post" action="nouveaumdp.php">
    <div class="modal-body mb-1">
      <div class="md-form form-sm mb-3">
<h4>Un code de vérification a été envoyer à votre adresse mail </h4>
        <div class="md-form form-sm mb-3">
          <div class="input-group">
            <input class="form-control py-2 border-right-0 border" name="codeverif" type="text" placeholder="Code de validation" required>

          </div>
        </div>

      <div class="text-center mt-2">
        <button class="btn btn-dark" name="btnVerifCode" type="submit">Vérifier</button>
      </div>
    </div>
  </form>
</div>
</div>
</div>
</div>
</div>
</main>

<?php else: ?>
<?php echo $errormdp ?>

  <form method="post" action="nouveaumdp.php">
    <div class="modal-body mb-1">
      <div class="md-form form-sm mb-3">

        <div class="md-form form-sm mb-3">
          <div class="input-group">
            <input class="form-control py-2 border-right-0 border" name="nvmdp1" type="password" placeholder="Nouveau mot de passe" required maxlength="30" minlength = "6">
            <span class="input-group-append">
              <div class="input-group-text bg-transparent"><i class="fas fa-key"></i></div>
            </span>
          </div>
        </div>

      <div class="md-form form-sm mb-3">
        <div class="input-group">
          <input class="form-control py-2 border-right-0 border" name="nvmdp2" type="password" placeholder="retapez votre mot de passe" required maxlength="30" minlength = "6">
          <span class="input-group-append">
            <div class="input-group-text bg-transparent"><i class="fas fa-key"></i></div>
          </span>
        </div>
      </div>

      <div class="text-center mt-2">
        <button class="btn btn-dark" name="btnChangermdp" type="submit">Changer mot de passe</button>
      </div>
    </div>
  </form>
</div>
</div>
</div>
</div>
</div>
</main>
<?php endif; ?>
























<?php

  include('footer.php');
?>
