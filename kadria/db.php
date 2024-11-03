<!--database pagina -->
<?php
class Database {
    private $host = 'localhost';
    private $dbname = 'portfolio';
    private $username = 'root';
    private $password = 'root';
    private $pdo; // PDO object

    // Constructor om de databaseverbinding te maken
    public function __construct() {
        try {
            // nieuwe PDO-verbinding
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            // Stel de PDO-foutmodus in op uitzondering
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Foutmelding als de verbinding niet lukt
            echo "Verbinding mislukt: " . $e->getMessage();
        }
    }

    // Functie om de verbinding terug te geven
    public function getConnection() {
        return $this->pdo; // Retourneert het PDO-object
    }

    // Functie om contactberichten op te slaan
    public function saveContactMessage($name, $email, $message, $phone = null) {
        $sql = "INSERT INTO contact_messages (name, email, message, phone) VALUES (:name, :email, :message, :phone)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':phone', $phone);

        // Voer de query uit
        $stmt->execute();
    }
}
?>

