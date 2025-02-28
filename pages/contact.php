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
    <title>Contact Us</title>
    <link rel="stylesheet" href="../css/root.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/contact.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body id="contact" >
    <?php include '../php/header.php'; ?>
    <?php include '../php/sidebar.php'; ?>

    <main class="main-contact">
    <section class="contact-form">
            <h2>Send Us a Message</h2>
            <form method="POST" id="contactForm" class="contact-form">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" placeholder="Your Name" required>

    <input type="text" name="honeypot" style="display:none">

    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Your Email" required>

    <label for="message">Message</label>
    <textarea id="message" name="message" rows="5" placeholder="Your Message" required></textarea>

    <button type="submit">Submit</button>
    <a href="../index.php" class="home-button"> Back to Home</a>
</form>

        </section>

        <section class="meet-the-team">
            <h2>Meet the Team</h2>
            <div class="team-member">
                <h3>Estian Esterhuizen</h3>
                <p>Founder & Designer</p>
            </div>
            <div class="team-member">
                <h3>Marinda Esterhuizen</h3>
                <p>Sales</p>
            </div>
            <div class="team-member">
                <h3>Wiane Ludik</h3>
                <p>Marketing Specialist</p>
            </div>

            <!-- Add more team members as needed -->
        </section>
    </main>
    <script defer src="../js/sidebar.js"></script>
    <script src="../js/contact_form.js"></script>
</body>
</html></div></section>