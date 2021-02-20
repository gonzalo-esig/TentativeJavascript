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

    // On récupère les données
    $stmt = $personnemorale->lire();

    // On vérifie si on a au moins 1 personne
    if($stmt->rowCount() > 0){
        // On initialise un tableau associatif
        $tableauPersonnesM = [];
        $tableauPersonnesM['personnemorale'] = [];

        // On parcourt les produits
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $personnem = [
                "ID_PERSONNEMORALE" => $ID_PERSONNEMORALE,
                "PERM_NOM" => $PERM_NOM,
                "PERM_EMAIL" => $PERM_EMAIL,
                "PERM_MOTDEPASSE" => $PERM_MOTDEPASSE,
                "PERM_TELEPHONE" => $PERM_TELEPHONE,
                "PERM_CODEPOSTAL" => $PERM_CODEPOSTAL,
                "PERM_LOCALITE" => $PERM_LOCALITE,
                "PERM_ADRESSE" => $PERM_ADRESSE,
                "PERM_CODENVMDP" => $PERM_CODENVMDP,
                "PERM_DOMAINE" => $PERM_DOMAINE,

            ];

            $tableauPersonnesM['personnemorale'][] = $personnem;
        }

        // On envoie le code réponse 200 OK
        http_response_code(200);

        // On encode en json et on envoie
        echo json_encode($tableauPersonnesM);
    }else {


    echo json_encode(["message" => "Cette table est vide"]);
}
}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
