<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ontvang de formuliergegevens
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : 'Naam niet ingevuld';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : 'Geen geldig e-mailadres';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : 'Geen bericht ingevuld';
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Voorbeeld van een eenvoudig bericht voor de gebruiker
        echo "Bedankt, " . $name . "! Je bericht is succesvol ontvangen. We nemen spoedig contact met je op.";

    } else {
        echo "Oeps! Alle velden zijn verplicht. Vul alsjeblieft het formulier volledig in.";
    }
} else {
    echo "Ongeldige verzoekmethode.";
}

//  db.php toevoegen voor toegang tot de Database-klasse
require 'db.php';

// Controleren of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verkrijg de gegevens uit het formulier
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // atabase-object maken en het opslaan van het bericht
    $database = new Database();
    $database->saveContactMessage($name, $email, $message);

    // de gebruiker sturen naar een bedankpagina of geef een succesbericht
    echo "Bericht verzonden! Bedankt voor je bericht.";
}


?>
