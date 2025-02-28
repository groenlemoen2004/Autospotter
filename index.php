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
    <title>AutoSpotters - Home</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/header.css">
    <script defer src="js/sidebar.js"></script>
    <script defer src="js/slider.js"></script>
</head>
<body id="home">
    <?php include 'php/header.php'; ?>
    <?php include 'php/sidebar.php'; ?>
    <main>
        <section id="hero">
            <div class="hero-content">
                <h1>Welcome to AutoSpotter</h1>
                <p>Your ultimate destination for quality vehicles and top-notch services.</p>
                <button onclick="location.href='pages/vehicles.php'">Explore Vehicles</button>
            </div>
        </section>
        <section id="slider">
            <div class="slider-container">
            <div class="slide active">
                <img src="img/pages/luxury.avif" alt="Luxury Collection">
                <div class="image-overlay"><h2>Luxury Collection</h2>
                <p>Discover our exclusive range of luxury vehicles.</p>
            </div>
            </div>
            <div class="slide">
                <img src="img/pages/family.jpg" alt="Family Vehicles">
                <div class="image-overlay"><h2>Family Vehicles</h2>
                <p>Safe, spacious, and perfect for family adventures.</p>
            </div>
            </div>
            <div class="slide">
                <img src="img/pages/eco-friendly.avif" alt="Eco-Friendly Models">
                <div class="image-overlay"><h2>Eco-Friendly Models</h2>
                <p>Experience innovation with our eco-friendly options.</p>
                </div>
            </div>
            </div>
            <button id="prevSlide">Previous</button>
            <button id="nextSlide">Next</button>
        </section>

        <section id="about">
            <h2>About AutoSpotter</h2>
            <p>
                At AutoSpotter, we offer a comprehensive marketplace experience. 
                Whether you're in the market for a new car, financing options, or service solutions, 
                our platform is designed to guide you every step of the way.
            </p>
        </section>
        <section id="testimonials">
            <h2>What Our Customers Say</h2>
            <div class="testimonial">
                <p>"AutoSpotter made buying my car a breeze. Excellent service!" - Alex</p>
            </div>
            <div class="testimonial">
                <p>"I found the perfect family car and great financing options." - Taylor</p>
            </div>
        </section>
    </main>

</body>
</html>
