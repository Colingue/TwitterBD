<?php

class Database {

    private $dbb;

    public function __construct(String $host, String $name, String $user, String $pass)
    {
        try {
            $this->dbb = new PDO("mysql:host=$host;dbname=$name", $user, $pass);
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br>"; // Affichage du message d'erreur
            die(); // Arrêt du script
        }
    }

    public function getConnection() {
        return $this->dbb;
    }
}