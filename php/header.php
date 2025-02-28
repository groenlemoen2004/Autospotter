<?php
// Assumes session has already been started in index.php
$currentTheme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light';
$newTheme = ($currentTheme === 'light') ? 'dark' : 'light';
?>
<header>
    <div class="header-container">
        <div class="logo">
            <h1>AutoSpotter</h1>
        </div>
        <div class="logo-container">
            <img src="/autospotter2/img/pages/Logo.jpg" alt="AutoSpotter Logo">
        </div>
        <nav>
            <ul>
                <li><a href="/autospotter2/index.php">Home</a></li>
                <li><a href="/autospotter2/pages/vehicles.php">Inventory</a></li>
                <li><a href="/autospotter2/pages/about.php">About Us</a></li>
                <li><a href="/autospotter2/pages/contact.php">Contact</a></li>
            </ul>
        </nav>
        <!-- Theme toggle link -->
        <div class="theme-toggle">
            <a href="?theme=<?php echo $newTheme; ?>" id="themeToggleButton">
                Switch to <?php echo ucfirst($newTheme); ?> Mode
            </a>
        </div>
    </div>
</header>
<?php ?>
