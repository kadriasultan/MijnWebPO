<!--contactController pagina -->
<?php

class ContactController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function store($data) {
        $stmt = $this->db->prepare("INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)");
        $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':message' => $data['message']
        ]);
    }
}
