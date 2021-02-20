<?php
class Personnemorale{
    // Connexion
    private $connexion;
    private $table = "personnemorale";

    // object properties
    public $ID_PERSONNEMORALE;
    public $PERM_NOM;
    public $PERM_EMAIL;
    public $PERM_MOTDEPASSE;
    public $PERM_TELEPHONE;
    public $PERM_CODEPOSTAL;
    public $PERM_LOCALITE;
    public $PERM_ADRESSE;
    public $PERM_CODENVMDP;
    public $PERM_DOMAINE;

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
        $sql = "INSERT INTO " . $this->table . " SET PERM_NOM=:nom,PERM_EMAIL=:email,PERM_MOTDEPASSE=:mdp,PERM_TELEPHONE=:tel,PERM_CODEPOSTAL=:cp,PERM_LOCALITE=:localite,PERM_ADRESSE=:adresse,PERM_CODENVMDP=:codenvmdp,PERM_DOMAINE=:domaine";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);

        // Protection contre les injections
        $this->PERM_NOM=htmlspecialchars(strip_tags($this->PERM_NOM));
        $this->PERM_EMAIL=htmlspecialchars(strip_tags($this->PERM_EMAIL));
        $this->PERM_MOTDEPASSE=htmlspecialchars(strip_tags($this->PERM_MOTDEPASSE));
        $this->PERM_TELEPHONE=htmlspecialchars(strip_tags($this->PERM_TELEPHONE));
        $this->PERM_CODEPOSTAL=htmlspecialchars(strip_tags($this->PERM_CODEPOSTAL));
        $this->PERM_LOCALITE=htmlspecialchars(strip_tags($this->PERM_LOCALITE));
        $this->PERM_ADRESSE=htmlspecialchars(strip_tags($this->PERM_ADRESSE));
        $this->PERM_CODENVMDP=htmlspecialchars(strip_tags($this->PERM_CODENVMDP));
        $this->PERM_DOMAINE=htmlspecialchars(strip_tags($this->PERM_DOMAINE));


        // Ajout des données protégées
        $query->bindParam(":nom", $this->PERM_NOM);
        $query->bindParam(":email", $this->PERM_EMAIL);
        $query->bindParam(":mdp", $this->PERM_MOTDEPASSE);
        $query->bindParam(":tel", $this->PERM_TELEPHONE);
        $query->bindParam(":cp", $this->PERM_CODEPOSTAL);
        $query->bindParam(":localite", $this->PERM_LOCALITE);
        $query->bindParam(":adresse", $this->PERM_ADRESSE);
        $query->bindParam(":codenvmdp", $this->PERM_CODENVMDP);
        $query->bindParam(":domaine", $this->PERM_DOMAINE);

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
        $sql = "SELECT * FROM ". $this->table . " WHERE ID_PERSONNEMORALE = :id ";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On attache l'id
        $query->bindParam(":id", $this->ID_PERSONNEMORALE);

        // On exécute la requête
        $query->execute();

        // on récupère la ligne
        $row = $query->fetch(PDO::FETCH_ASSOC);

        // On hydrate l'objet
        $this->PERM_NOM = $row['PERM_NOM'];
        $this->PERM_EMAIL = $row['PERM_EMAIL'];
        $this->PERM_MOTDEPASSE = $row['PERM_MOTDEPASSE'];
        $this->PERM_TELEPHONE = $row['PERM_TELEPHONE'];
        $this->PERM_CODEPOSTAL = $row['PERM_CODEPOSTAL'];
        $this->PERM_LOCALITE = $row['PERM_LOCALITE'];
        $this->PERM_ADRESSE = $row['PERM_ADRESSE'];
        $this->PERM_CODENVMDP = $row['PERM_CODENVMDP'];
        $this->PERM_DOMAINE = $row['PERM_DOMAINE'];
    }

    /**
     * Supprimer un produit
     *
     * @return void
     */
    public function supprimer(){
        // On écrit la requête
        $sql = "DELETE FROM " . $this->table . " WHERE ID_PERSONNEMORALE = ?";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On sécurise les données
        $this->ID_PERSONNEMORALE=htmlspecialchars(strip_tags($this->ID_PERSONNEMORALE));

        // On attache l'id
        $query->bindParam(1, $this->ID_PERSONNEMORALE);

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
        $sql = "UPDATE " . $this->table . " SET PERM_NOM=:nom,PERM_EMAIL=:email,PERM_MOTDEPASSE=:mdp,PERM_TELEPHONE=:tel,PERM_CODEPOSTAL=:cp,PERM_LOCALITE=:localite,PERM_ADRESSE=:adresse,PERM_CODENVMDP=:codenvmdp,PERM_DOMAINE=:domaine WHERE ID_PERSONNEMORALE = :idpersonnemorale";

        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // On sécurise les données
        $this->PERM_NOM=htmlspecialchars(strip_tags($this->PERM_NOM));
        $this->PERM_EMAIL=htmlspecialchars(strip_tags($this->PERM_EMAIL));
        $this->PERM_MOTDEPASSE=htmlspecialchars(strip_tags($this->PERM_MOTDEPASSE));
        $this->PERM_TELEPHONE=htmlspecialchars(strip_tags($this->PERM_TELEPHONE));
        $this->PERM_CODEPOSTAL=htmlspecialchars(strip_tags($this->PERM_CODEPOSTAL));
        $this->PERM_LOCALITE=htmlspecialchars(strip_tags($this->PERM_LOCALITE));
        $this->PERM_ADRESSE=htmlspecialchars(strip_tags($this->PERM_ADRESSE));
        $this->PERM_CODENVMDP=htmlspecialchars(strip_tags($this->PERM_CODENVMDP));
        $this->PERM_DOMAINE=htmlspecialchars(strip_tags($this->PERM_DOMAINE));
        $this->ID_PERSONNEMORALE=htmlspecialchars(strip_tags($this->ID_PERSONNEMORALE));

        // On attache les variables
        $query->bindParam(":nom", $this->PERM_NOM);
        $query->bindParam(":email", $this->PERM_EMAIL);
        $query->bindParam(":mdp", $this->PERM_MOTDEPASSE);
        $query->bindParam(":tel", $this->PERM_TELEPHONE);
        $query->bindParam(":cp", $this->PERM_CODEPOSTAL);
        $query->bindParam(":localite", $this->PERM_LOCALITE);
        $query->bindParam(":adresse", $this->PERM_ADRESSE);
        $query->bindParam(":codenvmdp", $this->PERM_CODENVMDP);
        $query->bindParam(":domaine", $this->PERM_DOMAINE);
        $query->bindParam(":idpersonnemorale", $this->ID_PERSONNEMORALE);










        // On exécute
        if($query->execute()){
            return true;
        }

        return false;
    }

}
