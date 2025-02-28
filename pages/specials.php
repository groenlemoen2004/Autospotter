<?php
// Start the session at the beginning
session_start();

// Check if a theme is passed in the URL (e.g., ?theme=dark) and store it in the session
if (isset($_GET['theme'])) {
    $_SESSION['theme'] = $_GET['theme'];
}

// Default to "light" if no theme is set in the session
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light';
?>
<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $theme; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoSpotters - Specials</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/root.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/specials.css">
    <script defer src="../js/sidebar.js"></script>
    <script defer src="../js/specials.js"></script>
</head>
<body id="specials">
    <?php include '../php/header.php'; ?>
    <?php include '../php/sidebar.php'; ?>

    <main>
        <section id="specials-content">
            <h1>Special Offers</h1>
            <div class="special-grid">
                <div class="special-offer" onclick="redirectToContact()">
                    <img src="../img/Specials/Hilux.jpg" alt="Toyota Hilux Special">
                </div>
                <div class="special-offer" onclick="redirectToContact()">
                    <img src="../img/Specials/Rio.jpg" alt="Kia Rio Special">
                </div>
                <div class="special-offer" onclick="redirectToContact()">
                    <img src="../img/Specials/Sportage.jpg" alt="Kia Sportage Special">
                </div>
                <div class="special-offer" onclick="redirectToContact()">
                    <img src="../img/Specials/Suzuki.jpg" alt="Suzuki Special">
                </div>
                <div class="special-offer" onclick="redirectToContact()">
                    <img src="../img/Specials/Ranger.jpg" alt="Ford Ranger Special">
                </div>
                <div class="special-offer" onclick="redirectToContact()">
                    <img src="../img/Specials/Vito.jpg" alt="Mercedes Vito Special">
                </div>
                <div class="special-offer" onclick="redirectToContact()">
                    <img src="../img/Specials/C200.jpg" alt="Mercedes C200 Special">
                </div> 
                <div class="special-offer" onclick="redirectToContact()">
                    <img src="../img/Specials/Rav4.jpg" alt="Toyota Rav4 Special">
                </div>    
                <div class="special-offer" onclick="redirectToContact()">
                    <img src="../img/Specials/Tcross.jpg" alt="Volkswagen Tcross Special">
                </div>    
                <div class="special-offer" onclick="redirectToContact()">
                    <img src="../img/Specials/i30.jpg" alt="Hyunday I30 Special">
                </div>    
                <div class="special-offer" onclick="redirectToContact()">
                    <img src="../img/Specials/magnite.jpg" alt="Nissan Magnite Special">
                </div>             
            </div>
        </section>
    </main>
</body>
</html>
