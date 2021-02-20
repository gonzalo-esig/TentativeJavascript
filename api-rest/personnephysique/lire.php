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
    $personephysique = new Personnephysique($db);

    // On récupère les données
    $stmt = $personephysique->lire();

    // On vérifie si on a au moins 1 personne
    if($stmt->rowCount() > 0){
        // On initialise un tableau associatif
        $tableauPersonnesP = [];
        $tableauPersonnesP['personnephysique'] = [];

        // On parcourt les produits
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $personnep = [
                "ID_PERSONNEP" => $ID_PERSONNEP,
                "PER_NOM" => $PER_NOM,
                "PER_PRENOM" => $PER_PRENOM,
                "PER_EMAIL" => $PER_EMAIL,
                "PER_MOTDEPASSE" => $PER_MOTDEPASSE,
                "PER_DATEDENAISSANCE" => $PER_DATEDENAISSANCE,
                "PER_TELEPHONE" => $PER_TELEPHONE,
                "PER_CODEPOSTAL" => $PER_CODEPOSTAL,
                "PER_LOCALITE" => $PER_LOCALITE,
                "PER_ADRESSE" => $PER_ADRESSE,
                "PER_CODENVMDP" => $PER_CODENVMDP,

            ];

            $tableauPersonnesP['personnephysique'][] = $personnep;
        }

        // On envoie le code réponse 200 OK
        http_response_code(200);

        // On encode en json et on envoie
        echo json_encode($tableauPersonnesP);
    }else {


    echo json_encode(["message" => "Cette table est vide"]);
}
}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
