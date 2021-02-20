<?php
class Personnephysique{
    // Connexion
    private $connexion;
    private $table = "personnephysique";

    // object properties
    public $ID_PERSONNEP;
    public $PER_NOM;
    public $PER_PRENOM;
    public $PER_EMAIL;
    public $PER_MOTDEPASSE;
    public $PER_DATEDENAISSANCE;
    public $PER_TELEPHONE;
    public $PER_CODEPOSTAL;
    public $PER_LOCALITE;
    public $PER_ADRESSE;
    public $PER_CODENVMDP;

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
        $sql = "SELECT * FROM ".$this->table ;

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
    public function creer(){

        // Ecriture de la requête SQL en y insérant le nom de la table
        $sql = "INSERT INTO " . $this->table . " SET PER_NOM=:nom,PER_PRENOM=:prenom,PER_EMAIL=:email,PER_MOTDEPASSE=:mdp,PER_DATEDENAISSANCE=:datenaissance,PER_TELEPHONE=:tel,PER_CODEPOSTAL=:cp,PER_LOCALITE=:localite,PER_ADRESSE=:adresse,PER_CODENVMDP=:codenvmdp";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);

        // Protection contre les injections
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


        // Ajout des données protégées
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
        $sql = "DELETE FROM " . $this->table . " WHERE ID_PERSONNEP = ?";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On sécurise les données
        $this->ID_PERSONNEP=htmlspecialchars(strip_tags($this->ID_PERSONNEP));

        // On attache l'id
        $query->bindParam(1, $this->ID_PERSONNEP);

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
