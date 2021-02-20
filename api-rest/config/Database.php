<?php
class Database{
    // Connexion à la base de données


    // getter pour la connexion
    public function getConnection(){

        $this->connexion = null;

        try{
            $this->connexion = new PDO('mysql:host=hhva.myd.infomaniak.com;dbname=hhva_team20_2_v2', 'hhva_team20_2_v', 'J9pmDKgZe7');
            $this->connexion->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Erreur de connexion : " . $exception->getMessage();
        }

        return $this->connexion;
    }
}
