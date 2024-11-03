
<!-- project pagina -->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Kadria Sultan | Portfolio</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<!--mijn projecten -->
<main>
    <h2>Projects</h2>
    <p>Hier vind je een verzameling van mijn recente werk, waarin ik diverse vaardigheden en technologieën heb toegepast om praktische oplossingen te ontwikkelen. <br> Van interactieve webapplicaties tot datagestuurde tools: elk project toont mijn passie voor programmeren en mijn aandacht voor detail.<br> Klik gerust op een project om meer te ontdekken en de code te bekijken!</p>

</main>

<div class="project-container" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; padding: 20px;">
    <?php if (isset($projects) && is_array($projects) && !empty($projects)): ?>
        <?php foreach ($projects as $project): ?>
            <div class="project" style="border: 1px solid #ccc; padding: 15px; width: 250px; text-align: center; border-radius: 5px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); transition: transform 0.3s ease, background-color 0.3s ease;">
                <h2 style="font-size: 18px; color: #333;"><?php echo isset($project['title']) ? htmlspecialchars($project['title']) : 'Geen naam beschikbaar'; ?></h2>
                <p style="font-size: 14px; color: #666;"><?php echo isset($project['description']) ? htmlspecialchars($project['description']) : 'Geen beschrijving beschikbaar'; ?></p>
                <a href="<?php echo isset($project['url']) ? htmlspecialchars($project['url']) : '#'; ?>" style="text-decoration: none; color: #007bff;" target="_blank" rel="noopener noreferrer">Bekijk op GitHub</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="font-size: 16px; color: #999;">Geen projecten beschikbaar om weer te geven.</p>
    <?php endif; ?>
</div>

<footer class="fot">
    &copy; Kadria Sultan 2024
</footer>

<div style="text-align: center; margin-top: 20px;">
    <a href="index.php" class="back-button">Terug naar Home</a>
</div>

<style>
    .project:hover {
        transform: translateY(-5px);
        background-color: #f0f8ff;
        box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    }
</style>

</body>
</html>
