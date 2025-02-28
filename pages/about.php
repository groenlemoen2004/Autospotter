<?php
// Start the session at the beginning
session_start();

// Default to "light" if no theme is set in the session
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light';
?>
<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $theme; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - AutoSpotter</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/root.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/about.css">
    <script defer src="../js/sidebar.js"></script>
</head>
<body id="about">
    <?php include '../php/header.php'?>
    <?php include '../php/sidebar.php'?>
    <main class="main-about">
        <section id="about-content">
            <h1>About AutoSpotter</h1>
            <p>
                Welcome to AutoSpotter, your ultimate destination for quality vehicles and top-notch services. 
                Our mission is to provide a comprehensive marketplace experience that guides you every step of the way, 
                whether you're in the market for a new car, financing options, or service solutions.
            </p>
            <h2>Our Story</h2>
            <p>
                Founded with a passion for automobiles and a commitment to customer satisfaction, AutoSpotter has grown 
                into a trusted name in the automotive industry. Our team of experts is dedicated to helping you find 
                the perfect vehicle that meets your needs and budget.
            </p>
            <h2>Our Services</h2>
            <ul>
                <li>Wide selection of new and used vehicles</li>
                <li>Competitive financing options</li>
                <li>Comprehensive vehicle maintenance and repair services</li>
                <li>Personalized customer support</li>
            </ul>
            <h2>Contact Us</h2>
            <p>
                Have questions or need assistance? Our friendly team is here to help. 
                Contact us at <a href="mailto:support@autospotters.co.co.za">support@autospotters.co.za</a>
            </p>
        </section>
    </main>
</body>
</html>