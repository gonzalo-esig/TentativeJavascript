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
    include_once '../models/personnemorale.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les produits
    $personnemorale = new Personnemorale($db);

    $donnees = $_GET['id'];

    if(!empty($donnees)){
        $personnemorale->ID_PERSONNEMORALE = $donnees;

        // On récupère le produit
        $personnemorale->lireUn();

        // On vérifie si le produit existe
        if($personnemorale->PERM_NOM != null){

            $personnem = [
                "ID_PERSONNEMORALE" => $personnemorale->ID_PERSONNEMORALE,
                "PERM_NOM" => $personnemorale->PERM_NOM,
                "PERM_EMAIL" => $personnemorale->PERM_EMAIL,
                "PERM_MOTDEPASSE" => $personnemorale->PERM_MOTDEPASSE,
                "PERM_TELEPHONE" => $personnemorale->PERM_TELEPHONE,
                "PERM_CODEPOSTAL" => $personnemorale->PERM_CODEPOSTAL,
                "PERM_LOCALITE" => $personnemorale->PERM_LOCALITE,
                "PERM_ADRESSE" => $personnemorale->PERM_ADRESSE,
                "PERM_CODENVMDP" => $personnemorale->PERM_CODENVMDP,
                "PERM_DOMAINE" => $personnemorale->PERM_DOMAINE,
            ];
            // On envoie le code réponse 200 OK
            http_response_code(200);

            // On encode en json et on envoie
            echo json_encode($personnem);
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
