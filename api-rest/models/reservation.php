<?php
class Reservation{
    // Connexion
    private $connexion;
    private $table = "reservation";

    // object properties
    public $ID_RESERVATION;
    public $ID_ADMIN ;
    public $ID_PERSONNEP;
    public $ID_PERSONNEMORALE;
    public $RES_DATEDEBUT;
    public $RES_DATEFIN;
    public $RES_MOTIF;
    public $RES_STATUT;
    public $RES_URL;




    /**
     * Constructeur avec $db pour la connexion à la base de données
     *
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }

    /**
     * Lecture des produits
     *
     * @return void
     */
    public function lire(){
        // On écrit la requête
        $sql = "SELECT * FROM reservation AS A LEFT JOIN personnephysique AS B ON A.ID_PERSONNEP = B.ID_PERSONNEP LEFT JOIN personnemorale AS C ON A.ID_PERSONNEMORALE = C.ID_PERSONNEMORALE WHERE A.RES_STATUT=1";

        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // On exécute la requête
        $query->execute();

        // On retourne le résultat
        return $query;
    }



    /**
     * Créer un produit
     *
     * @return void
     */
    public function creerA(){

        // Ecriture de la requête SQL en y insérant le nom de la table
        $sql = "INSERT INTO " . $this->table . " SET RES_DATEDEBUT=:datedebut,RES_DATEFIN=:datefin,RES_MOTIF=:motif,ID_ADMIN=:idadmin,RES_STATUT=1";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);

        // Protection contre les injections
        $this->RES_DATEDEBUT=htmlspecialchars(strip_tags($this->RES_DATEDEBUT));
        $this->RES_DATEFIN=htmlspecialchars(strip_tags($this->RES_DATEFIN));
        $this->RES_MOTIF=htmlspecialchars(strip_tags($this->RES_MOTIF));
        $this->ID_ADMIN=htmlspecialchars(strip_tags($this->ID_ADMIN));

        // Ajout des données protégées
        $query->bindParam(":datedebut", $this->RES_DATEDEBUT);
        $query->bindParam(":datefin", $this->RES_DATEFIN);
        $query->bindParam(":motif", $this->RES_MOTIF);
        $query->bindParam(":idadmin", $this->ID_ADMIN);


        // Exécution de la requête
        if($query->execute()){
            return true;
        }
        return false;
    }


    /**
     * Créer un produit
     *
     * @return void
     */
    public function creerC(){

        // Ecriture de la requête SQL en y insérant le nom de la table
        $sql = "INSERT INTO " . $this->table . " SET RES_DATEDEBUT=:datedebut,RES_DATEFIN=:datefin,RES_MOTIF=:motif,ID_PERSONNEP=:idpersonnep,RES_STATUT=:statut,RES_URL=:url";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);

        // Protection contre les injections
        $this->RES_DATEDEBUT=htmlspecialchars(strip_tags($this->RES_DATEDEBUT));
        $this->RES_DATEFIN=htmlspecialchars(strip_tags($this->RES_DATEFIN));
        $this->RES_MOTIF=htmlspecialchars(strip_tags($this->RES_MOTIF));
        $this->ID_PERSONNEP=htmlspecialchars(strip_tags($this->ID_PERSONNEP));
        $this->RES_URL=htmlspecialchars(strip_tags($this->RES_URL));
        $this->RES_STATUT=htmlspecialchars(strip_tags($this->RES_STATUT));


        // Ajout des données protégées
        $query->bindParam(":datedebut", $this->RES_DATEDEBUT);
        $query->bindParam(":datefin", $this->RES_DATEFIN);
        $query->bindParam(":motif", $this->RES_MOTIF);
        $query->bindParam(":idpersonnep", $this->ID_PERSONNEP);
        $query->bindParam(":url", $this->RES_URL);
        $query->bindParam(":statut",$this->RES_STATUT);

        // Exécution de la requête
        if($query->execute()){
            return true;
        }
        return false;
    }

    /**
     * Créer un produit
     *
     * @return void
     */
    public function creerE(){

        // Ecriture de la requête SQL en y insérant le nom de la table
        $sql = "INSERT INTO " . $this->table . " SET RES_DATEDEBUT=:datedebut,RES_DATEFIN=:datefin,RES_MOTIF=:motif,ID_PERSONNEMORALE=:idpersonnem,RES_STATUT=:statut,RES_URL=:url";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);

        // Protection contre les injections
        $this->RES_DATEDEBUT=htmlspecialchars(strip_tags($this->RES_DATEDEBUT));
        $this->RES_DATEFIN=htmlspecialchars(strip_tags($this->RES_DATEFIN));
        $this->RES_MOTIF=htmlspecialchars(strip_tags($this->RES_MOTIF));
        $this->ID_PERSONNEMORALE=htmlspecialchars(strip_tags($this->ID_PERSONNEMORALE));
        $this->RES_URL=htmlspecialchars(strip_tags($this->RES_URL));
        $this->RES_STATUT=htmlspecialchars(strip_tags($this->RES_STATUT));


        // Ajout des données protégées
        $query->bindParam(":datedebut", $this->RES_DATEDEBUT);
        $query->bindParam(":datefin", $this->RES_DATEFIN);
        $query->bindParam(":motif", $this->RES_MOTIF);
        $query->bindParam(":idpersonnem", $this->ID_PERSONNEMORALE);
        $query->bindParam(":url", $this->RES_URL);
        $query->bindParam(":statut",$this->RES_STATUT);

        // Exécution de la requête
        if($query->execute()){
            return true;
        }
        return false;
    }






















    /**
     * Lire un produit
     *
     * @return void
     */
    public function lireUn(){
        // On écrit la requête
        $sql = "SELECT * FROM ". $this->table . " WHERE ID_PERSONNEP = :id ";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On attache l'id
        $query->bindParam(":id", $this->ID_PERSONNEP);

        // On exécute la requête
        $query->execute();

        // on récupère la ligne
        $row = $query->fetch(PDO::FETCH_ASSOC);

        // On hydrate l'objet
        $this->PER_NOM = $row['PER_NOM'];
        $this->PER_PRENOM = $row['PER_PRENOM'];
        $this->PER_EMAIL = $row['PER_EMAIL'];
        $this->PER_MOTDEPASSE = $row['PER_MOTDEPASSE'];
        $this->PER_DATEDENAISSANCE = $row['PER_DATEDENAISSANCE'];
        $this->PER_TELEPHONE = $row['PER_TELEPHONE'];
        $this->PER_CODEPOSTAL = $row['PER_CODEPOSTAL'];
        $this->PER_LOCALITE = $row['PER_LOCALITE'];
        $this->PER_ADRESSE = $row['PER_ADRESSE'];
        $this->PER_CODENVMDP = $row['PER_CODENVMDP'];
    }

    /**
     * Supprimer un produit
     *
     * @return void
     */
    public function supprimer(){
        // On écrit la requête
        $sql = "DELETE FROM " . $this->table . " WHERE ID_RESERVATION = ?";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On sécurise les données
        $this->ID_RESERVATION=htmlspecialchars(strip_tags($this->ID_RESERVATION));

        // On attache l'id
        $query->bindParam(1, $this->ID_RESERVATION);

        // On exécute la requête
        if($query->execute()){
            return true;
        }

        return false;
    }

    /**
     * Mettre à jour un produit
     *
     * @return void
     */
    public function modifier(){
        // On écrit la requête
        $sql = "UPDATE " . $this->table . " SET PER_NOM=:nom,PER_PRENOM=:prenom,PER_EMAIL=:email,PER_MOTDEPASSE=:mdp,PER_DATEDENAISSANCE=:datenaissance,PER_TELEPHONE=:tel,PER_CODEPOSTAL=:cp,PER_LOCALITE=:localite,PER_ADRESSE=:adresse,PER_CODENVMDP=:codenvmdp WHERE ID_PERSONNEP = :idpersonnep";

        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // On sécurise les données
        $this->PER_NOM=htmlspecialchars(strip_tags($this->PER_NOM));
        $this->PER_PRENOM=htmlspecialchars(strip_tags($this->PER_PRENOM));
        $this->PER_EMAIL=htmlspecialchars(strip_tags($this->PER_EMAIL));
        $this->PER_MOTDEPASSE=htmlspecialchars(strip_tags($this->PER_MOTDEPASSE));
        $this->PER_DATEDENAISSANCE=htmlspecialchars(strip_tags($this->PER_DATEDENAISSANCE));
        $this->PER_TELEPHONE=htmlspecialchars(strip_tags($this->PER_TELEPHONE));
        $this->PER_CODEPOSTAL=htmlspecialchars(strip_tags($this->PER_CODEPOSTAL));
        $this->PER_LOCALITE=htmlspecialchars(strip_tags($this->PER_LOCALITE));
        $this->PER_ADRESSE=htmlspecialchars(strip_tags($this->PER_ADRESSE));
        $this->PER_CODENVMDP=htmlspecialchars(strip_tags($this->PER_CODENVMDP));
        $this->ID_PERSONNEP=htmlspecialchars(strip_tags($this->ID_PERSONNEP));

        // On attache les variables
        $query->bindParam(":nom", $this->PER_NOM);
        $query->bindParam(":prenom", $this->PER_PRENOM);
        $query->bindParam(":email", $this->PER_EMAIL);
        $query->bindParam(":mdp", $this->PER_MOTDEPASSE);
        $query->bindParam(":datenaissance", $this->PER_DATEDENAISSANCE);
        $query->bindParam(":tel", $this->PER_TELEPHONE);
        $query->bindParam(":cp", $this->PER_CODEPOSTAL);
        $query->bindParam(":localite", $this->PER_LOCALITE);
        $query->bindParam(":adresse", $this->PER_ADRESSE);
        $query->bindParam(":codenvmdp", $this->PER_CODENVMDP);
        $query->bindParam(":idpersonnep", $this->ID_PERSONNEP);










        // On exécute
        if($query->execute()){
            return true;
        }

        return false;
    }

}
