<?php
require_once 'db.php';

$message = '';
$db = new Database(); //Database-klasse

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verkrijg formuliergegevens
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $messageContent = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';

    if (!empty($name) && !empty($email) && !empty($messageContent)) {
        try {
            // het opslaan van contactbericht op
            $db->saveContactMessage($name, $email, $messageContent, $phone);
            $message = "<div class='message success'>Bedankt, " . $name . "! Je bericht is succesvol ontvangen.</div>";
        } catch (Exception $e) {
            $message = "<div class='message error'>Er was een fout bij het verzenden van het bericht: " . $e->getMessage() . "</div>";
        }
    } else {
        $message = "<div class='message error'>Oeps! Alle velden zijn verplicht. Vul alsjeblieft het formulier volledig in.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">
    <h1>Neem Contact Op</h1>

    <!-- Toon het bericht als het er is -->
    <?php if ($message): ?>
        <?php echo $message; ?>
    <?php endif; ?>

    <form action="verwerk_contact.php" method="post">
        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" required>

        <label for="phone">Telefoon:</label>
        <input type="text" id="phone" name="phone">

        <label for="email">E-mailadres:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Bericht:</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit">Verzenden</button>
    </form>
</div>

<!-- Terug naar home -->
<div style="text-align: center; margin-top: 20px;">
    <a href="index.php" class="back-button">Terug naar Home</a>
</div>

<footer class="fot">
    &copy; Kadria Sultan 2024
</footer>

</body>
</html>
