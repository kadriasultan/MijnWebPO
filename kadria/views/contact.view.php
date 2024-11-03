<!--contact pagina-->
<?php
require_once 'db.php';

$message = '';
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // formuliergegevens
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $messageContent = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';

    // Validatie van het e-mailadres
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "<div class='message error'>Oeps! Voer een geldig e-mailadres in.</div>";
    } elseif (!empty($name) && !empty($email) && !empty($messageContent)) {
        try {
            // Sla het contactbericht op
            $db->saveContactMessage($name, $email, $messageContent, $phone);
            $message = "<div class='message success'>Bedankt, " . $name . "! Je bericht is succesvol ontvangen. We nemen spoedig contact met je op.</div>";
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

<h1 class="contact">Contact</h1>
<div class="container">
    <h1>Neem Contact Op</h1>

    <!-- Toon het bericht als het er is -->
    <?php if ($message): ?>
        <?php echo $message; ?>
    <?php endif; ?>

    <form action="index.php?page=contact" method="POST">
        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" required placeholder="Vul je naam in">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required placeholder="Vul je e-mailadres in">

        <label for="message">Bericht:</label>
        <textarea id="message" name="message" required placeholder="Schrijf je bericht hier..."></textarea>

        <label for="phone">Telefoon (optioneel):</label>
        <input type="text" id="phone" name="phone" placeholder="Vul je telefoonnummer in (optioneel)">

        <input type="submit" value="Verstuur">
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
