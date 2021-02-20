<?php
require 'fonction.php';
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



$idclient = $_SESSION['ID_PERSONNEP'];
$user = getOneUserid($idclient);





$tab = [
"id" => "client",
"title" => $user['ID_PERSONNEP'],
"start" => "2000-01-01 08:00:00",
"end" => "2000-01-01 09:00:00",
"url" => "docsClient.php?id=".$user['ID_PERSONNEP']."&c=1",




];

http_response_code(200);
echo json_encode($tab);

?>
