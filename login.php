
<html>
  <head>
    <?php
    $titre = "C&M - Login";
      include('navbar.php');
    ?>
  </head>
  <body>
    <title>C&M - Login</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="blog.css" rel="stylesheet">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- Les icones utilisé -->
    <script src="https://kit.fontawesome.com/693819749c.js" crossorigin="anonymous"></script>

    <?php
    // Inscription client
    $error = "";
    $erroremailinscriptionC = "";
    $erroremailinscriptionE = "";
    $erroremailinscriptioninvalideC = "";
    $erroremailinscriptioninvalideE = "";
    $errordatenaissance18 ="";
    $errordatenaissance100="";
    $errornouveaumdp="";

    		if (isset($_POST["btnInscrireclient"])) {

    		$nom = $_POST["nom"];
    		$prenom = $_POST["prenom"];
    	    $email = $_POST["email"];
    		$pswrd = $_POST["mdp1"];
			$datenaissance = $_POST['dateNaissance'];
    	    $phone= $_POST["tel"];
			$nRue = $_POST['NRue'];
    		$adresse =$nRue. ' ' .$_POST["adresse"];
    	    $codepostal = $_POST["codepostal"];
    		$localite = $_POST["localite"];
			$bday = new DateTime($datenaissance);
			$today = new Datetime(date('d.m.y'));
			$diff = $today->diff($bday);
			$age =  $diff->y;

    			try {

            if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
              if($age >= 18){
                if ($age <= 100) {

    				$user = getOneUser($email);
    				if (empty($user)) {
    						createUser($nom, $prenom, $email, sha1($pswrd), $datenaissance, $phone, $codepostal, $localite, $adresse);
							mkdir("uploads/".$nom.$prenom);
    						header("Location:login.php");
    				} else {

              $erroremailinscriptionC = "<div class='alert alert-danger' role='alert'> Cette adresse mail est déjà utlisée !</div>";
    				}
          }else {
              $errordatenaissance100 = "<div class='alert alert-danger' role='alert'> La date est incorrect !</div>";
          }
            }else{

            $errordatenaissance18 = "<div class='alert alert-danger' role='alert'> Il faut au moins avoir 18 ans pour s'inscrire !</div>";

             }
          }else {
            $erroremailinscriptioninvalideC = "<div class='alert alert-danger' role='alert'> Cette adresse mail n'est pas valide !</div>";
          }
    			} catch (Exception $e) {
    						$_SESSION["ID_PERSONNEP"]  = 0;
    						header("Location:error.php?message=".$e->getMessage());
    			}
    		}
    	// Inscription entreprise
        if (isset($_POST["btnInscrireentreprise"])) {

          $nom = $_POST["nom"];
          $domaine = $_POST["domaine"];
          $email = $_POST["email"];
          $pswrd = $_POST["mdp1"];
          $phone = $_POST["tel"];
          $nRue = $_POST['NRue'];
          $adresse =$nRue. ' ' .$_POST["adresse"];
          $codepostal = $_POST["codepostal"];
          $localite = $_POST["localite"];


          try {

            if (filter_var($email,FILTER_VALIDATE_EMAIL)) {

            $user = getOneUsermorale($email);
            if (empty($user)) {
                createUserMorale($nom, $email, sha1($pswrd), $phone, $codepostal, $localite, $adresse, $domaine);
                header("Location:login.php");

            } else {
              $erroremailinscriptionE = "<div class='alert alert-danger' role='alert'> Cette adresse mail est déjà utlisée !</div>";

            }
          }else {
              $erroremailinscriptioninvalideE = "<div class='alert alert-danger' role='alert'> Cette adresse mail n'est pas valide !</div>";
          }
          } catch (Exception $e) {
                $_SESSION["ID_PERSONNEP"]  = 0;
                header("Location:error.php?message=".$e->getMessage());
          }
        }

    	// Connexion
    if (isset($_POST["btnSeConnecter"])) {
      $email = $_POST["emailconnexion"];
      $pswrd = $_POST["motdepasseconnexion"];
    	try {
    			$user = getOneUser($email);
        if (!empty($user)) {

          if ($user["PER_MOTDEPASSE"]   == sha1($pswrd)) {
              $_SESSION["ID_PERSONNEP"]  = $user["ID_PERSONNEP"];
              $_SESSION["PER_NOM"]  = $user["PER_NOM"];
              $_SESSION["PER_PRENOM"]  = $user["PER_PRENOM"];
              $_SESSION["PER_EMAIL"]  = $user["PER_EMAIL"];
              $_SESSION["PER_DATEDENAISSANCE"]  = $user["PER_DATEDENAISSANCE"];
              $_SESSION["PER_TELEPHONE"]  = $user["PER_TELEPHONE"];
              $_SESSION["PER_CODEPOSTAL"]  = $user["PER_CODEPOSTAL"];
              $_SESSION["PER_LOCALITE"]  = $user["PER_LOCALITE"];
              $_SESSION["PER_ADRESSE"]  = $user["PER_ADRESSE"];
              $_SESSION["EST_CLIENT"]  = 1;

              header("Location:index.php");
          } else {$_SESSION["ID_PERSONNEP"]  = 0;
            $error="<div class='alert alert-danger' role='alert'>  Adresse mail ou mot de passe incorrect !</div>";
          }

        }else {
            $user = getOneUsermorale($email);
          if (!empty($user)) {

              if ($user["PERM_MOTDEPASSE"]   == sha1($pswrd)) {
                  $_SESSION["ID_PERSONNEMORALE"]  = $user["ID_PERSONNEMORALE"];
                  $_SESSION["PERM_NOM"]  = $user["PERM_NOM"];
                  $_SESSION["PERM_EMAIL"]  = $user["PERM_EMAIL"];
                  $_SESSION["PERM_TELEPHONE"]  = $user["PERM_TELEPHONE"];
                  $_SESSION["PERM_CODEPOSTAL"]  = $user["PERM_CODEPOSTAL"];
                  $_SESSION["PERM_LOCALITE"]  = $user["PERM_LOCALITE"];
                  $_SESSION["PERM_ADRESSE"]  = $user["PERM_ADRESSE"];
                  $_SESSION["PERM_DOMAINE"]  = $user["PERM_DOMAINE"];
                  $_SESSION["EST_CLIENT"]  = 0;

                  header("Location:index.php");
              } else {$_SESSION["ID_PERSONNEMORALE"]  = 0;
                $error="<div class='alert alert-danger' role='alert'>  Adresse mail ou mot de passe incorrect !</div>";
              }
            }else {

              $user = getOneUseradmin($email);
            if (!empty($user)) {
                if ($user["ADM_MOTDEPASSE"]   == $pswrd) {
                  $_SESSION["ID_ADMIN"]  = $user["ID_ADMIN"];
                  $_SESSION["ADM_NOM"]  = $user["ADM_NOM"];
                  $_SESSION["ADM_PRENOM"]  = $user["ADM_PRENOM"];
                  $_SESSION["ADM_EMAIL"]  = $user["ADM_EMAIL"];
                  $_SESSION["ADM_DATEDENAISSANCE"]  = $user["ADM_DATEDENAISSANCE"];
                  $_SESSION["ADM_TELEPHONE"]  = $user["ADM_TELEPHONE"];
                  $_SESSION["ADM_CODEPOSTAL"]  = $user["ADM_CODEPOSTAL"];
                  $_SESSION["ADM_LOCALITE"]  = $user["ADM_LOCALITE"];
                  $_SESSION["ADM_ADRESSE"]  = $user["ADM_ADRESSE"];
                    $_SESSION["EST_ADMIN"]  = 1;
                    header("Location:index.php");
                } else {$_SESSION["ID_ADMIN"]  = 0;
                  $error="<div class='alert alert-danger' role='alert'>  Adresse mail ou mot de passe incorrect !</div>";
                }
              }

            else {
            $error="<div class='alert alert-danger' role='alert'>  Cette adresse mail n'existe pas </div>";

          }
        }
      }
      } catch (Exception $e) {

    					$_SESSION["ID_PERSONNEP"]  = 0;
    					header("Location:error.php?message=".$e->getMessage());
      }
    }




    if (isset($_POST['btnNouveaumdp'])) {
      $email = $_POST['emailnv'];
      $user = getOneUser($email);
    if (!empty($user)) {

      $code = passgen1(10);
      creatCodeValidation($email,$code);



      $header="MIME-Version: 1.0\r\n";
      $header.='From:"Mail de réinitialisation" '."\n";
      $header.='Content-Type:text/html; charset="uft-8"'."\n";
      $header.='Content-Transfer-Encoding: 8bit';
      $sujet= "Votre code de vérification";
      $message='
      <html>
         <body>
            <div align="left">
               <br />
               <u>Code de vérification :</u>'.$code.'<br />
               <br />

            </div>
         </body>
      </html>
      ';
      mail($email, $sujet , $message, $header);

    header("Location:nouveaumdp.php");


    }else {
    $user = getOneUsermorale($email);
    if (!empty($user)) {

      $code = passgen1(10);
      creatCodeValidationmorale($email,$code);



      $header="MIME-Version: 1.0\r\n";
      $header.='From:"Mail de réinitialisation" '."\n";
      $header.='Content-Type:text/html; charset="uft-8"'."\n";
      $header.='Content-Transfer-Encoding: 8bit';
      $sujet= "Votre code de vérification";
      $message='
      <html>
         <body>
            <div align="left">
               <br />
               <u>Code de vérification :</u>'.$code.'<br />
               <br />

            </div>
         </body>
      </html>
      ';
      mail($email, $sujet , $message, $header);

    header("Location:nouveaumdp.php");


    }else {
      $error="<div class='alert alert-danger' role='alert'>  Cette adresse mail n'existe pas </div>";
    }
    }
    }

      ?>

        <main role="main" class="container">
  		<div class="row">
  			<div class="col-md-12 blog-main">
  				<div class="modal-dialog cascading-modal" role="document">
  	<div class="modal-content">
  		<div class="modal-c-tabs">
  			<ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
  				<li class="nav-item">
  					<a class="nav-link active" data-toggle="tab" href="#panel1" role="tab"id="pageconnexion"><i class="fas fa-user mr-1" id="pageconnexion" ></i>Connexion</a>
  				</li>
  				<li class="nav-item">
  					<a class="nav-link" data-toggle="tab" href="#panel2" role="tab" id="pageinscription"><i class="fas fa-user-plus mr-1" id="pageinscription"></i>Inscription</a>
  				</li>
  			</ul>
  			<div class="tab-content">
  					<div class="modal-body mb-1" id="modalMain">
              <?php if ($erroremailinscriptionE != ""):

                echo $erroremailinscriptionE;

               else:

                echo $erroremailinscriptioninvalideE;
               endif;
               ?>
               <?php echo $errordatenaissance18 ?>
               <?php echo $errordatenaissance100 ?>
               <?php if ($erroremailinscriptionC != ""):

                 echo $erroremailinscriptionC;

                else:

                 echo $erroremailinscriptioninvalideC;
                endif;
                ?>
                <?php
                  echo $error;
                ?>

  						<div style="display:none" id="entreprise">
  							<div class="md-form form-sm mb-3">
  						<div class="form-check form-check-inline">
  							<input class="form-check-input" type="radio" name="radiobutton" value="option1" onchange="AfficherClient(this)"   >
  							<label class="form-check-label" for="inlineRadio1">Client Privé</label>
  						</div>
  						<div class="form-check form-check-inline">
  							<input class="form-check-input" type="radio" name="radiobutton"  id="radioentreprise" value="option2" onchange="AfficherEntreprise(this)"checked >
  							<label class="form-check-label" for="inlineRadio2">Entreprise</label>
  						</div>
  						</div>
  											<form  method="post" action ="login.php" onSubmit="return validation(this); ">
  							 <div class="md-form form-sm mb-3">
  								 <div class="input-group">
  									 <input type="text" name="nom" class="form-control" placeholder="Insérez le nom de votre entreprise" required autofocus="" maxlength="20" >

  								 </div>
  							 </div>
  							 <div class="md-form form-sm mb-3">
  								 <div class="input-group">
  									 <input type="email" name="email" class="form-control" placeholder="Insérez l'adresse mail de votre entreprise" required autofocus="" maxlength="25">

  								 </div>
  							 </div>
  							 <div class="md-form form-sm mb-3">
  								 <input type="password" name="mdp1" class="form-control" placeholder="Insérez votre mot de passe" required autofocus="" maxlength="30" minlength="6" >

  							 </div>

  							 <div class="md-form form-sm mb-3">
  								 <input type="password" name="mdp2" class="form-control" placeholder="Insérez votre mot de passe une nouvelle fois" required autofocus="" maxlength="30" minlength="6">
  							 </div>
  							 <div class="md-form form-sm mb-3">
  								 <input type="text" name="tel" class="form-control" placeholder="Insérez votre numéro de téléphone portable" required autofocus="" pattern="[0-9+]{10,18}">
  								 </div>
  								 <div class="md-form form-sm mb-3">
  									 <input type="text" name="domaine" class="form-control" placeholder="Insérez le domaine de votre entreprise" required autofocus="" maxlength="50">
  								 </div>

  							 <div class="md-form form-sm mb-3">
  								 <div class="input-group">
  									 <span class="input-group-append">
  										 <div class="input-group-text bg-transparent" >N° </div>
  									 </span>
  									 <input type="text" name="NRue" class="form-control" placeholder="de rue" required autofocus="" maxlength="6">
  									 <span class="input-group-append">
  										 <div class="input-group-text bg-transparent">Rue</div>
  									 </span>
  									 <input type="text" name="adresse" class="form-control" placeholder="l'adresse de votre entreprise" required autofocus="" maxlength="50">
  								 </div>
  							 </div>
  							 <div class="md-form form-sm mb-3">
  								 <div class="input-group">
  									 <input type="tel" name="codepostal" class="form-control" placeholder="Code Postale" required autofocus=""maxlength="6" minlength="4">
  									 <span class="input-group-append">

  									 </span>
  									 <input type="text" name="localite" class="form-control" placeholder="Localité" required autofocus=""pattern="[a-zA-ZÀ-ÿ]{1,15}" maxlength="15">
  								 </div>
  							 </div>
  							 <div class="text-center form-sm mt-2">
  								 <button class="btn btn-dark" type="submit" name="btnInscrireentreprise">inscrire votre entreprise</i></button>
  							 </div>
  							 </form>
  						 </div>
               <form method="post" action="login.php">
                 <div class="modal fade" id="ModalMdp" tabindex="-1" role="dialog" aria-labelledby="MotDePasseOublier" aria-hidden="true">

               						<div class="modal-dialog" role="document">
               							<div class="modal-content">
               								<div class="modal-header">
               									<h5 class="modal-title" id="MotDePasseOublier">Mot de passe oublié?</h5>
               									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
               										<span aria-hidden="true">&times;</span>
               									</button>
               								</div>
               								<div class="modal-body">
                                 <div class="input-group">
                                   <input type="email" name="emailnv" class="form-control" placeholder="Insérez votre adresse mail" required autofocus="">
                                   <span class="input-group-append">
                                     <div class="input-group-text bg-transparent">
                                       <i class="fas fa-at" aria-hidden="true"></i></div>
                                   </span>
                                 </div>
               								</div>
               								<div class="modal-footer">
               									<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
               									<button type="submit" class="btn btn-dark" name="btnNouveaumdp" >Envoyer</button>
               								</div>
               							</div>
               						</div>
               					</div>
				</form>
  					</div>
  			</div>
  		</div>
  	</div>
  </div>
  			</div>
  		</div>
  	</main>
    <script type="text/javascript">

    	// Création de la div principale
    	var modaleMain = document.getElementById('modalMain');
    	modaleMain.innerHTML += '<div id="divFormulaire" class="modal-body mb-1"></div> ';
    	var divFormulaire = document.getElementById('divFormulaire');
    	// Création du formulaire
    	var nvFormulaire = document.createElement('form');
    	nvFormulaire.action = 'login.php';
    	nvFormulaire.method = 'post';
    	divFormulaire.appendChild(nvFormulaire);
    	window.onload = creerLogin;
    	function creerLogin (){
    		var divinfoentreprise = document.getElementById('entreprise');
    		divinfoentreprise.style.display = 'none';
    			nvFormulaire.innerHTML = ''
    	// Création des inputs
    	// input email
    	creerInputBootstrap('type="email"  id="EmailConnexion" placeholder="Veuillez entrer votre adresse mail " name="emailconnexion" value="" required> ','<span id=EmailConnexionVerif></span> <br> ');
    	// input mot de passe
    	creerInputBootstrap('type="password"  id="MdpConnexion" placeholder="Veuiller entrer votre mot de passe" name="motdepasseconnexion" value="" required > <br>','<span id=mdpConnexionVerif></span><br> ');
    	// bouton valider
    	nvFormulaire.innerHTML +=	'<div class="text-center mt-2">'+
    														'<button class="btn btn-dark" type="submit" name="btnSeConnecter">Se connecter</button>'+
    														'</div>'+
    														'<div class="modal-footer">'+
    															'<div class="options text-md-left mt-1">'+
    																'<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#ModalMdp">Mot de passe oublié ? </button>'+
    															'</div>'+
    														'</div>';
                                document.getElementById('EmailConnexion').addEventListener("keyup",verificationEmail);
    	}

    	function verificationEmail(){
    		var email = document.getElementById('EmailConnexion').value;
    		var span = document.getElementById('EmailConnexionVerif');
    		if (email != ""){
    		patternEmail =  /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    		if (email.match(patternEmail)){
    		span.style.color = 'green';
    		span.innerHTML = "Adresse mail valide";
    		}else{
    		span.style.color = 'red';
    		span.innerHTML = "Adresse mail invalide";
    		}
    	}else {
    		span.style.color = '';
    		span.innerHTML = "";
    	}
    	}
    	function creerInputBootstrap (finInput,message){
    		nvFormulaire.innerHTML += '<div class="md-form form-sm mb-4">'+
    															'<input class="form-control"'+finInput+ message +
    															'</div>';
    }
    document.getElementById('pageinscription').addEventListener("click",creerinscription);
    document.getElementById('pageconnexion').addEventListener("click",creerLogin);

    function creerinscription () {
    	nvFormulaire.innerHTML =''
    	nvFormulaire.innerHTML += '<div class="md-form form-sm mb-3">'+
                            '<div class="form-check form-check-inline">'+
                            '  <input class="form-check-input" type="radio" name="radiobutton" value="option1" onchange="AfficherClient(this)" checked >'+
                              '<label class="form-check-label" for="inlineRadio1">Client Privé</label>'+
                          '</div>'+
                            '<div class="form-check form-check-inline">'+
                            '  <input class="form-check-input" type="radio" name="radiobutton"  value="option2" onchange="AfficherEntreprise(this)" onsubmit="AfficherEntreprise(this)"   >'+
                              '<label class="form-check-label" for="inlineRadio2">Entreprise</label>'+
                            '</div>'+
                            '</div>'
    	creerInputBootstrap('type="text" name="nom"  placeholder="Insérez votre nom" required autofocus="" pattern="[a-zA-ZÀ-ÿ]{1,15}" maxlength="15"> ','');
    	creerInputBootstrap('type="text" name="prenom"  placeholder="Insérez votre prénom" required autofocus="" pattern="[a-zA-ZÀ-ÿ]{1,15}" maxlength="15"> ','');
      creerInputBootstrap('type="email"  id="EmailConnexion" placeholder="Veuillez entrer votre adresse mail " name="email" value="" required> ','<span id=EmailConnexionVerif></span> <br> ');
    	creerInputBootstrap('type="password" name="mdp1"  placeholder="Insérez votre mot de passe" required autofocus="" maxlength="40" minlength="6">','');
    	creerInputBootstrap('type="password" name="mdp2"  placeholder="Insérez votre mot de passe une nouvelle fois" required autofocus="" maxlength="40" minlength="6">','');
    	nvFormulaire.innerHTML += '<div class="md-form form-sm mb-3">'+
    					                  '<div class="input-group">'+
    					                  '<span class="input-group-append">'+
    					                  '<div class="input-group-text bg-transparent">Date de naissance</div>'+
    					                  '</span>'+
    					    							'	<input type="date" name="dateNaissance" class="form-control"  required autofocus="" maxlength="6">'+
    					                  '</div>'+
    					    							'</div>';

    	creerInputBootstrap(' type="text" name="tel" class="form-control" placeholder="Insérez votre numéro de téléphone portable" required autofocus="" pattern="[0-9+]{10,18}">','');

    	nvFormulaire.innerHTML +='<div class="md-form form-sm mb-3">'+
        							'<div class="input-group">'+
        									'<span class="input-group-append">'+
        										'<div class="input-group-text bg-transparent">N°</div>'+
        									'</span>'+
        									'<input type="text" name="NRue" class="form-control" placeholder="de rue" required autofocus="" maxlength="6">'+
        									'<span class="input-group-append">'+
        										'<div class="input-group-text bg-transparent">Rue</div>'+
        									'</span>'+
        									'<input type="text" name="adresse" class="form-control" placeholder="votre adresse" required autofocus="" maxlength="50">'+
        								'</div>'+
        							'</div>'+
        							'<div class="md-form form-sm mb-3">'+
        								'<div class="input-group">'+
        									'<input type="text"  name="codepostal" class="form-control" placeholder="Code Postale" required autofocus=""maxlength="6" minlength="4" >'+
        									'<span class="input-group-append">'+
        									'</span>'+
        									'<input type="text" name="localite" class="form-control" placeholder="Localité" required autofocus="" pattern="[a-zA-ZÀ-ÿ]{1,15}" maxlength="15">'+
        								'</div>'+
        							'</div>'
    	nvFormulaire.innerHTML +='  <div class="text-center form-sm mt-2">'+
                        '<button class="btn btn-dark" type="submit" name="btnInscrireclient" >S\'inscrire</i></button>'+
                      '</div>'
                      document.getElementById('EmailConnexion').addEventListener("keyup",verificationEmail);

    }

    function AfficherEntreprise(x)
    {
    	var divinfoentreprise = document.getElementById('entreprise');

    if (x.checked) {
    		nvFormulaire.innerHTML = ''
    		divinfoentreprise.style.display = 'initial';
    		document.getElementById('radioentreprise').checked = true
    }
    }
    function AfficherClient(x)
    {
    var divinfoentreprise = document.getElementById('entreprise');
    if (x.checked) {
    		divinfoentreprise.style.display = 'none';
    		creerinscription()
    }
    }
    function validation(f) {
    		if (f.mdp1.value == '' || f.mdp2.value == '') {
    			alert('Tous les champs ne sont pas remplis');
    			f.mdp1.focus();
    			return false;
    			}
    		else if (f.mdp1.value != f.mdp2.value) {
    			alert('Ce ne sont pas les mêmes mots de passe!');
    			f.mdp1.focus();
    			return false;
    			}
    		else if (f.mdp1.value == f.mdp2.value) {
    			return true;
    			}
    		else {
    			f.mdp1.focus();
    			return false;
    			}
    		}

    </script>








    <!-- Footer Links -->
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
