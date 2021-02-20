<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// On vérifie que la méthode utilisée est correcte
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    include_once '../models/personnephysique.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les produits
    $personnephysique = new Personnephysique($db);

    $donnees = $_GET['id'];

    if(!empty($donnees)){
        $personnephysique->ID_PERSONNEP = $donnees;

        // On récupère le produit
        $personnephysique->lireUn();

        // On vérifie si le produit existe
        if($personnephysique->PER_NOM != null){

            $personnep = [
                "ID_PERSONNEP" => $personnephysique->ID_PERSONNEP,
                "PER_NOM" => $personnephysique->PER_NOM,
                "PER_PRENOM" => $personnephysique->PER_PRENOM,
                "PER_EMAIL" => $personnephysique->PER_EMAIL,
                "PER_MOTDEPASSE" => $personnephysique->PER_MOTDEPASSE,
                "PER_DATEDENAISSANCE" => $personnephysique->PER_DATEDENAISSANCE,
                "PER_TELEPHONE" => $personnephysique->PER_TELEPHONE,
                "PER_CODEPOSTAL" => $personnephysique->PER_CODEPOSTAL,
                "PER_LOCALITE" => $personnephysique->PER_LOCALITE,
                "PER_ADRESSE" => $personnephysique->PER_ADRESSE,
                "PER_CODENVMDP" => $personnephysique->PER_CODENVMDP,
            ];
            // On envoie le code réponse 200 OK
            http_response_code(200);

            // On encode en json et on envoie
            echo json_encode($personnep);
        }else{
            // 404 Not found
            http_response_code(404);

            echo json_encode(array("message" => "Le produit n'existe pas."));
        }

    }else {
      echo json_encode(array("message" => "marche PAS"));
    }
}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
