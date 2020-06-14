<?php

require_once("userInterface.php");

class UserModel implements userInterface {

    private $connection;

    public function __construct(Database $database) {
        $this->conn = $database->getConnection(); 

    public function findAll() : Array {
        $query = $this->connection->prepare('SELECT u.id, u.pseudo FROM user u ORDER BY u.pseudo'); // On prend tous les users
        $query->execute(); // Exécution de la requête
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function search($searchString) {
        $query = $this->connection->prepare('SELECT u.pseudo FROM user c WHERE c.pseudo like :search ORDER BY u.pseudo'); // Recherche avec une chaine de caractere
        $query->execute([':search' => '%' . $searchString .  '%']); // Exécution de la requête
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findOneById($id) {
        $query = $this->connection->prepare('SELECT u.pseudo FROM user u WHERE u.id = :id'); // Recherche d'user par ID
        $query->execute([':id' => $id]); // Exécution de la requête
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function save(Array $user) : Bool {
        $query = $this->connection->prepare('INSERT INTO user (pseudo, motdepasse) VALUES (:pseudo, :motdepasse)'); // Ajout d'un nouvel utilisateur
        return $query->execute([
            ':pseudo' => $user['pseudo'],
            ':motdepasse'=> $user['motdepasse']
        ]);
    }
}

?>