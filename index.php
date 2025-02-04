<?php
session_start();
include 'php/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Spotter</title>
    <link rel="stylesheet" href="css/title.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/hometrans.css">
</head>
<body>
    <header class="header">
        <img src="img/Logo.jpg" alt="Logo" class="logo"> <!-- Logo image -->
        <h1 class="title">Auto Spotter</h1> <!-- Title -->
    </header>
    <?php include 'php/sidebar.php';?>
    <!-- Main Content -->
    <div class="main-content">
        <div class="content-header">
            <h1>Welcome to Auto Spotter</h1>
            <p class="intro-text">Your ultimate destination for discovering the latest and greatest in the automotive world. Explore our curated selection of top vehicles, read expert reviews, and stay updated with the latest industry news.</p>
        </div>
        <div class="slider-container">
            <div class="slider">
                <img src="img/slider.avif" alt="Featured Car 1" class="slide active">
                <img src="img/slider2.avif" alt="Featured Car 2" class="slide">
                <img src="img/slider3.avif" alt="Featured Car 3" class="slide">
            </div>
            <button class="nav-btn prev-btn">&#10094;</button>
            <button class="nav-btn next-btn">&#10095;</button>
            <div class="indicators"></div>
        </div>
        <hr class="divider">
        <h1 class="section-title">All Types of Vehicles</h1>
        <hr class="divider">
        <ul class="vehicle-list">
            <li>Nissan</li>
            <li>Toyota</li>
            <li>BMW</li>
            <li>Mercedes-Benz</li>
            <li>Volkswagen</li>
            <li>Ford</li>
            <li>Hyundai</li>
            <li>Renault</li>
            <li>Peugeot</li>
            <li>Opel</li>
            <li>Isuzu</li>
            <li>Land Rover</li>
            <li>Jeep</li>
            <li>Volvo</li>
        </ul>
        <hr class="divider">
        <h1>Where we put the customer first</h1>
        <hr class="divider">
        <div class="image-gallery">
            <div class="image-item">
                <img src="img/gallery.jpeg" alt="Gallery Image 1" class="gallery-image">
                <p class="image-text">With customer service that will leave you smiling</p>
            </div>
            <div class="image-item">
                <img src="img/gallery2.jpg" alt="Gallery Image 2" class="gallery-image">
                <p class="image-text">We ensure you get the car that your heart desires</p>
            </div>
            <div class="image-item">
                <img src="img/gallery3.jpeg" alt="Gallery Image 3" class="gallery-image">
                <p class="image-text">We have over 30 years of experience in the automotive industry</p>
            </div>
        </div>
        <a href="pages/vehicles.php" class="grab-dreams-btn">Grab Your Dreams!</a>
    </div>
    <script src="js/sidebar.js"></script>
    <script src="js/slider.js"></script>
</body>
</html>