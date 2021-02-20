<?php




function myConnection() {
    static $dbc = null;
    if ($dbc == null) {
        try {
            $dbc = new PDO('mysql:host=127.0.0.1;dbname=hhva_team20_2_v2', 'root', '');

            $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            header("Location:error.php?message=".$e->getMessage());
            exit();
        }
    }
    return $dbc;
}


function debug($mode, $data) {
    if ($mode == "verbose")
        echo "<center><small><font color='#CCCCCC'>" . $data . "</font></small></center><br>";
}




function createUser($nom, $prenom, $email, $password, $datenaissance, $telephone, $codepostal, $localite, $adresse) {
    $email = strtolower($email);
    try {
        $request = myConnection()->prepare("INSERT INTO personnephysique (PER_NOM,PER_PRENOM,PER_EMAIL,PER_MOTDEPASSE,PER_DATEDENAISSANCE,PER_TELEPHONE,PER_CODEPOSTAL,PER_LOCALITE,PER_ADRESSE) VALUES( :nom, :prenom, :email, :password, :datenaissance, :telephone, :codepostal, :localite, :adresse)");
        $request->bindParam(':nom', $nom, PDO::PARAM_STR);
        $request->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $request->bindParam(':email', $email, PDO::PARAM_STR);
        $request->bindParam(':password', $password, PDO::PARAM_STR);
        $request->bindParam(':datenaissance', $datenaissance, PDO::PARAM_STR);
        $request->bindParam(':telephone', $telephone, PDO::PARAM_STR);
        $request->bindParam(':codepostal', $codepostal, PDO::PARAM_STR);
        $request->bindParam(':localite', $localite, PDO::PARAM_STR);
        $request->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $request->execute();
    } catch (PDOException $e) {
        header("Location:error.php?message=".$e->getMessage());
        exit();
    }





}

function createUserMorale($nom, $email, $password, $telephone, $codepostal, $localite, $adresse, $domaine) {
    $email = strtolower($email);
    try {
        $request = myConnection()->prepare("INSERT INTO personnemorale (PERM_NOM,PERM_EMAIL,PERM_MOTDEPASSE,PERM_TELEPHONE,PERM_CODEPOSTAL,PERM_LOCALITE,PERM_ADRESSE,PERM_DOMAINE) VALUES( :nom, :email, :password, :telephone, :codepostal, :localite, :adresse, :domaine)");
        $request->bindParam(':nom', $nom, PDO::PARAM_STR);
        $request->bindParam(':email', $email, PDO::PARAM_STR);
        $request->bindParam(':password', $password, PDO::PARAM_STR);
        $request->bindParam(':telephone', $telephone, PDO::PARAM_STR);
        $request->bindParam(':codepostal', $codepostal, PDO::PARAM_STR);
        $request->bindParam(':localite', $localite, PDO::PARAM_STR);
        $request->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $request->bindParam(':domaine', $domaine, PDO::PARAM_STR);
        $request->execute();
    } catch (PDOException $e) {
        header("Location:error.php?message=".$e->getMessage());
          exit();
    }



}

function getOneUser($email) {
    $email = strtolower($email);
    try {
        $request = myConnection()->prepare("SELECT * FROM personnephysique WHERE PER_EMAIL = :email");
        $request->bindParam(':email', $email, PDO::PARAM_STR);
        $request->execute();
    } catch (PDOException $e) {
        header("Location:error.php?message=".$e->getMessage());
        exit();
    }
    return $request->fetch(PDO::FETCH_ASSOC);
}

function getOneUseradmin($email) {
    $email = strtolower($email);
    try {
        $request = myConnection()->prepare("SELECT * FROM admin WHERE ADM_EMAIL = :email");
        $request->bindParam(':email', $email, PDO::PARAM_STR);
        $request->execute();
    } catch (PDOException $e) {
        header("Location:error.php?message=".$e->getMessage());
        exit();
    }
    return $request->fetch(PDO::FETCH_ASSOC);
}

function getOneUsermorale($email) {
    $email = strtolower($email);
    try {
        $request = myConnection()->prepare("SELECT * FROM personnemorale WHERE PERM_EMAIL = :email");
        $request->bindParam(':email', $email, PDO::PARAM_STR);
        $request->execute();
    } catch (PDOException $e) {
        header("Location:error.php?message=".$e->getMessage());
        exit();
    }
    return $request->fetch(PDO::FETCH_ASSOC);
}

function creatCodeValidation($email,$code) {
    $email = strtolower($email);
    try {
        $request = myConnection()->prepare("UPDATE personnephysique SET PER_CODENVMDP = :code WHERE PER_EMAIL = :email");
        $request->bindParam(':email', $email, PDO::PARAM_STR);
        $request->bindParam(':code', $code, PDO::PARAM_STR);

        $request->execute();
    } catch (PDOException $e) {
        header("Location:error.php?message=".$e->getMessage());
        exit();
    }
}

    function creatCodeValidationmorale($email,$code) {
        $email = strtolower($email);
        try {
            $request = myConnection()->prepare("UPDATE personnemorale SET PERM_CODENVMDP = :code WHERE PERM_EMAIL = :email");
            $request->bindParam(':email', $email, PDO::PARAM_STR);
            $request->bindParam(':code', $code, PDO::PARAM_STR);

            $request->execute();
        } catch (PDOException $e) {
            header("Location:error.php?message=".$e->getMessage());
            exit();
        }




}

function deleteCodeValidation($email) {
    $email = strtolower($email);
    try {
        $request = myConnection()->prepare("UPDATE personnephysique SET PER_CODENVMDP = NULL WHERE PER_EMAIL = :email");
        $request->bindParam(':email', $email, PDO::PARAM_STR);


        $request->execute();
    } catch (PDOException $e) {
        header("Location:error.php?message=".$e->getMessage());
        exit();
    }

}

function deleteCodeValidationmorale($email) {
    $email = strtolower($email);
    try {
        $request = myConnection()->prepare("UPDATE personnemorale SET PERM_CODENVMDP = NULL WHERE PERM_EMAIL = :email");
        $request->bindParam(':email', $email, PDO::PARAM_STR);


        $request->execute();
    } catch (PDOException $e) {
        header("Location:error.php?message=".$e->getMessage());
        exit();
    }

}

function passgen1($nbChar) {
    $chaine ="mnoTUzS5678kVvwxy9WXYZRNCDEFrslq41GtuaHIJKpOPQA23LcdefghiBMbj0";
    srand((double)microtime()*1000000);
    $pass = '';
    for($i=0; $i<$nbChar; $i++){
        $pass .= $chaine[rand()%strlen($chaine)];
        }
    return $pass;
    }

    function getOneUserCodeVerif($code) {

        try {
            $request = myConnection()->prepare("SELECT * FROM personnephysique WHERE PER_CODENVMDP = :code");
            $request->bindParam(':code', $code, PDO::PARAM_STR);
            $request->execute();
        } catch (PDOException $e) {
            header("Location:error.php?message=".$e->getMessage());
            exit();
        }
        return $request->fetch(PDO::FETCH_ASSOC);
    }


    function getOneUserCodeVerifmorale($code) {

        try {
            $request = myConnection()->prepare("SELECT * FROM personnemorale WHERE PERM_CODENVMDP = :code");
            $request->bindParam(':code', $code, PDO::PARAM_STR);
            $request->execute();
        } catch (PDOException $e) {
            header("Location:error.php?message=".$e->getMessage());
            exit();
        }
        return $request->fetch(PDO::FETCH_ASSOC);
    }


    function changeMDP($email,$mdp) {
        $email = strtolower($email);
        try {
            $request = myConnection()->prepare("UPDATE personnephysique SET PER_MOTDEPASSE = :mdp WHERE PER_EMAIL = :email");
            $request->bindParam(':email', $email, PDO::PARAM_STR);
            $request->bindParam(':mdp', $mdp, PDO::PARAM_STR);

            $request->execute();
        } catch (PDOException $e) {
            header("Location:error.php?message=".$e->getMessage());
            exit();
        }

    }

    function changeMDPmorale($email,$mdp) {
        $email = strtolower($email);
        try {
            $request = myConnection()->prepare("UPDATE personnemorale SET PERM_MOTDEPASSE = :mdp WHERE PERM_EMAIL = :email");
            $request->bindParam(':email', $email, PDO::PARAM_STR);
            $request->bindParam(':mdp', $mdp, PDO::PARAM_STR);

            $request->execute();
        } catch (PDOException $e) {
            header("Location:error.php?message=".$e->getMessage());
            exit();
        }

    }


    function updateespaceclientC ($idclient, $nom, $prenom, $email, $datenaissance, $telephone, $codepostal, $localite, $adresse){

      $email = strtolower($email);
      try {
        $request = myConnection()->prepare("UPDATE personnephysique SET PER_NOM = :nom,PER_PRENOM = :prenom,PER_EMAIL = :email,PER_DATEDENAISSANCE = :datenaissance,PER_TELEPHONE = :telephone,PER_CODEPOSTAL = :codepostal ,PER_LOCALITE = :localite,PER_ADRESSE = :adresse WHERE ID_PERSONNEP = :idclient");
        $request->bindParam(':idclient', $idclient, PDO::PARAM_STR);
        $request->bindParam(':nom', $nom, PDO::PARAM_STR);
        $request->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $request->bindParam(':email', $email, PDO::PARAM_STR);
        $request->bindParam(':datenaissance', $datenaissance, PDO::PARAM_STR);
        $request->bindParam(':telephone', $telephone, PDO::PARAM_STR);
        $request->bindParam(':codepostal', $codepostal, PDO::PARAM_STR);
        $request->bindParam(':localite', $localite, PDO::PARAM_STR);
        $request->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $request->execute();
      } catch (PDOException $e) {
          header("Location:error.php?message=".$e->getMessage());
          exit();
      }
    }


    function updateespaceclientE ($identreprise, $nom, $email, $telephone, $codepostal, $localite, $adresse){

      $email = strtolower($email);
      try {
        $request = myConnection()->prepare("UPDATE personnemorale SET PERM_NOM = :nom,PERM_EMAIL = :email,PERM_TELEPHONE = :telephone,PERM_CODEPOSTAL = :codepostal ,PERM_LOCALITE = :localite,PERM_ADRESSE = :adresse WHERE ID_PERSONNEMORALE = :identreprise");
        $request->bindParam(':identreprise', $identreprise, PDO::PARAM_STR);
        $request->bindParam(':nom', $nom, PDO::PARAM_STR);
        $request->bindParam(':email', $email, PDO::PARAM_STR);
        $request->bindParam(':telephone', $telephone, PDO::PARAM_STR);
        $request->bindParam(':codepostal', $codepostal, PDO::PARAM_STR);
        $request->bindParam(':localite', $localite, PDO::PARAM_STR);
        $request->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $request->execute();
      } catch (PDOException $e) {
          header("Location:error.php?message=".$e->getMessage());
          exit();
      }
    }

    function getAllUser() {
        try {
            $request = myConnection()->prepare("SELECT * FROM personnephysique");
            $request->execute();


        } catch (PDOException $e) {
            header("Location:error.php?message=".$e->getMessage());
            exit();
        }
            return $request->fetchall(PDO::FETCH_ASSOC);
}
    function getAllUserMorale() {
        try {
            $request = myConnection()->prepare("SELECT * FROM personnemorale");
            $request->execute();
        } catch (PDOException $e) {
            header("Location:error.php?message=".$e->getMessage());
            exit();
        }
        return $request->fetchall(PDO::FETCH_ASSOC);
    }
    function getOneUserid($id) {

        try {
            $request = myConnection()->prepare("SELECT * FROM personnephysique WHERE ID_PERSONNEP = :id");
            $request->bindParam(':id', $id, PDO::PARAM_STR);
            $request->execute();
        } catch (PDOException $e) {
            header("Location:error.php?message=".$e->getMessage());
            exit();
        }
        return $request->fetch(PDO::FETCH_ASSOC);
    }

    function getOneUseridmorale($id) {

        try {
            $request = myConnection()->prepare("SELECT * FROM personnemorale WHERE ID_PERSONNEMORALE = :id");
            $request->bindParam(':id', $id, PDO::PARAM_STR);
            $request->execute();
        } catch (PDOException $e) {
            header("Location:error.php?message=".$e->getMessage());
            exit();
        }
        return $request->fetch(PDO::FETCH_ASSOC);
    }

    function getReservation($id) {

        try {
            $request = myConnection()->prepare("SELECT * FROM reservation WHERE RES_STATUT = 1 AND ID_PERSONNEP = :id");
            $request->bindParam(':id', $id, PDO::PARAM_STR);
            $request->execute();
        } catch (PDOException $e) {
            header("Location:error.php?message=".$e->getMessage());
            exit();
        }
        return $request->fetch(PDO::FETCH_ASSOC);
    }
    function getReservationE($id) {

        try {
            $request = myConnection()->prepare("SELECT * FROM reservation WHERE RES_STATUT = 1 AND ID_PERSONNEMORALE = :id");
            $request->bindParam(':id', $id, PDO::PARAM_STR);
            $request->execute();
        } catch (PDOException $e) {
            header("Location:error.php?message=".$e->getMessage());
            exit();
        }
        return $request->fetch(PDO::FETCH_ASSOC);
    }
    function delReservation($id) {

        try {
            $request = myConnection()->prepare("DELETE FROM reservation WHERE RES_STATUT = 1 AND ID_PERSONNEP = :id");
            $request->bindParam(':id', $id, PDO::PARAM_STR);
            $request->execute();
        } catch (PDOException $e) {
            header("Location:error.php?message=".$e->getMessage());
            exit();
        }
    }

function delReservationE($id) {

    try {
        $request = myConnection()->prepare("DELETE FROM reservation WHERE RES_STATUT = 1 AND ID_PERSONNEMORALE = :id");
        $request->bindParam(':id', $id, PDO::PARAM_STR);
        $request->execute();
    } catch (PDOException $e) {
        header("Location:error.php?message=".$e->getMessage());
        exit();
    }
}
