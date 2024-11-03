<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <img src="Afbeelding%20van%20WhatsApp%20op%202024-10-31%20om%2015.09.47_295d9e16.jpg" alt="Logo van Kadria" class="logo">
    <div class="navbar__toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>
    <nav class="nav">
        <a href="index.php?page=about">Over Mij</a>
        <a href="index.php?page=projects">Projecten</a>
        <a href="index.php?page=contact">Contact</a>
    </nav>

</header>




<main class="font">
    <h1>Welkom in mijn portfolio</h1>
    <img class="img1" src="pexels-jonathan-aman-234110-756861.jpg" alt="Over mij afbeelding">
</main>

<div class="content">
    <?php
    //databaseverbinding
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once 'db.php';
    $db = new Database();
    $pdo = $db->getConnection();
//ProjectController
    require_once 'controllers/ProjectController.php';
    $projectController = new ProjectController($pdo);

    // Functie om de juiste pagina te routeren
    function route($page, $projectController, $pdo) {
        switch ($page) {
            case 'projects':
                $projectController->index();
                break;
            case 'about':
                include 'views/about.view.php';
                break;
            case 'contact':
                include 'views/contact.view.php';
                break;
            default:
                include 'views/home.view.php';
                break;
        }
    }

    // het bepalen van welke pagina moet worden weergegeven
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    route($page, $projectController, $pdo);
    ?>
</div>

<!-- Contactverwerkingscode -->
<?php
if ($page === 'contact' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $phone = $_POST['phone'];

    // Voorbereiden en binden van de SQL-instructie
    $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, message, phone) VALUES (:name, :email, :message, :phone)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':phone', $phone);

    // Uitvoeren van de query
    if ($stmt->execute()) {
        echo "<div class='message success'>Bericht succesvol verzonden!</div>";
    } else {
        echo "<div class='message error'>Er was een fout bij het verzenden van het bericht: " . implode(", ", $stmt->errorInfo()) . "</div>";
    }
}
?>

<script>
    // JavaScript om het navigatiemenu te toggelen
    const toggle = document.getElementById('mobile-menu');
    const nav = document.querySelector('.nav');

    toggle.onclick = function() {
        nav.classList.toggle('active');
    };

</script>
<footer class="fot">
    &copy; Kadria Sultan 2024
</footer>
</body>
</html>
