<?php
require_once 'db.php';

class Project {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Halen alle projecten op
    public function getAllProjects() {
        $stmt = $this->pdo->prepare("SELECT * FROM projects");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourneeeren van array van projecten
    }

    //nieuw project toevoegen
    public function addProject($name, $description, $url) {
        $stmt = $this->pdo->prepare("INSERT INTO projects (name, description, url) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $description, $url]); //  de query Voeren uit met de gegeven parameters
    }
}
?>
