<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// On vérifie la méthode
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    include_once '../models/personnephysique.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les produits
    $personephysique = new Personnephysique($db);

    // On récupère les informations envoyées
    $donnees = json_decode(file_get_contents("php://input"));

        // Ici on a reçu les données
        // On hydrate notre objet
        $personephysique->PER_NOM = $donnees->PER_NOM;
        $personephysique->PER_PRENOM = $donnees->PER_PRENOM;
        $personephysique->PER_EMAIL = $donnees->PER_EMAIL;
        $personephysique->PER_MOTDEPASSE = $donnees->PER_MOTDEPASSE;
        $personephysique->PER_DATEDENAISSANCE = $donnees->PER_DATEDENAISSANCE;
        $personephysique->PER_TELEPHONE = $donnees->PER_TELEPHONE;
        $personephysique->PER_CODEPOSTAL = $donnees->PER_CODEPOSTAL;
        $personephysique->PER_LOCALITE = $donnees->PER_LOCALITE;
        $personephysique->PER_ADRESSE = $donnees->PER_ADRESSE;
        $personephysique->PER_CODENVMDP = $donnees->PER_CODENVMDP;

        if($personephysique->creer()){
            // Ici la création a fonctionné
            // On envoie un code 201
            http_response_code(201);
            echo json_encode(["message" => "L'ajout a été effectué"]);
        }else{
            // Ici la création n'a pas fonctionné
            // On envoie un code 503
            http_response_code(503);
            echo json_encode(["message" => "L'ajout n'a pas été effectué"]);
        }

}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
