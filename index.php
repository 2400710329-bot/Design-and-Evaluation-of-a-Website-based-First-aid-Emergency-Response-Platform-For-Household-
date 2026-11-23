<?php
require_once "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>First Aid & Emergency Response Platform</title>
   <link rel="stylesheet" href="styles.css">
</head>

<body>

<!-- Navigation Bar -->
<header class="navbar">

    <div class="logo">
        <span>🚑</span>
       </a>First Aid Response
    </div>

    <nav class="nav-links">
        <a href="index.php">Home</a>
        <a href="first_aid.php">First Aid Guide</a>
        <a href="emergency.php">Emergency</a>
        <a href="contacts.php">Contacts</a>
        <a href="login.php" class="login-btn">Login</a>
    </nav>

</header>


<!-- Hero Section -->
<section class="hero">

    <div class="hero-content">

        <div class="hero-text">

            <h1>
                First Aid & Emergency
                <span>Response Platform</span>
            </h1>

            <p>
                Get quick access to reliable first-aid information
                and emergency response guidance for common
                domestic household accidents.
            </p>

            <div class="hero-buttons">

                <a href="first_aid.php" class="btn primary-btn">
                    View First Aid Guide
                </a>

                <a href="emergency.php" class="btn emergency-btn">
                    🚨 Emergency Help
                </a>

            </div>

        </div>

        <div class="hero-card">

            <div class="medical-icon">
                🩹
            </div>

            <h2>Need First Aid?</h2>

            <p>
                Find simple step-by-step guidance
                for common household accidents.
            </p>

            <a href="first_aid.php" class="card-link">
                Get Help →
            </a>

        </div>

    </div>

</section>


<!-- Accident Categories -->
<section class="categories">

    <div class="section-heading">

        <h2>Common Household Emergencies</h2>

        <p>
            Learn what to do when an accident happens at home.
        </p>

    </div>


    <div class="category-grid">

        <div class="category-card">

            <div class="category-icon">🔥</div>

            <h3>Burns</h3>

            <p>
                Basic first-aid guidance for minor burns
                and thermal injuries.
            </p>

           <a href="first_aid.php?category=Burns" class="learn-link">
    Learn More →
</a>

        </div>


        <div class="category-card">

            <div class="category-icon">🩸</div>

            <h3>Cuts & Bleeding</h3>

            <p>
                Learn how to respond to wounds
                and bleeding safely.
            </p>

           <!-- Cuts and Bleeding card -->
<a href="first_aid.php?category=Cuts-Bleeding" class="learn-link">
    Learn More →
</a>

        </div>


        <div class="category-card">

            <div class="category-icon">🫁</div>

            <h3>Choking</h3>

            <p>
                Learn the appropriate immediate
                response to choking.
            </p>

          <a href="first_aid.php?category=Choking" class="learn-link">
    Learn More →
</a>

        </div>


        <div class="category-card">

            <div class="category-icon">⚡</div>

            <h3>Electric Shock</h3>

            <p>
                Important safety steps when responding
                to electrical accidents.
            </p>

        <a href="first_aid.php?category=Electric-Shock" class="learn-link">
    Learn More →
</a>

        </div>

    </div>

</section>


<!-- How It Works -->
<section class="how-it-works">
    <div class="section-heading">
        <h2>How the Platform Works</h2>
        <p>Access emergency information in a few simple steps.</p>
    </div>

    <div class="steps">
        <div class="step">
            <div class="step-number">1</div>
            <h3>Select Emergency Type</h3>
            <p>Choose the type of emergency you need help with.</p>
        </div>

        <div class="step">
            <div class="step-number">2</div>
            <h3>Read First Aid Steps</h3>
            <p>Follow the displayed first-aid instructions carefully.</p>
        </div>

        <div class="step">
            <div class="step-number">3</div>
            <h3>Get Emergency Help</h3>
            <p>Contact appropriate emergency services when professional help is needed.</p>
        </div>
    </div>
</section>
              

<!-- Emergency Banner -->
<section class="emergency-banner">
    <div class="emergency-text">
        <h2>🚨 Serious Emergency?</h2>
        <p>For life-threatening situations, contact professional emergency services immediately.</p>
    </div>
    <a href="emergency.php" class="btn emergency-btn">
        Emergency Response
    </a>
</section>


<!-- Footer -->
<footer>
    <div class="footer-content">
        <div class="footer-about">
            <h3>First Aid Response</h3>
            <p>A web-based platform designed to provide first-aid information and emergency response guidance for domestic accidents.</p>
        </div>
        <div class="footer-links">
            <h3>Quick Links</h3>
            <a href="index.php">Home</a>
            <a href="first_aid.php">First Aid Guide</a>
            <a href="emergency.php">Emergency</a>
            <a href="contacts.php">Emergency Contacts</a>
        </div>
    </div>
    <div class="copyright">
        <p>© 2026 First Aid & Emergency Response Platform</p>
    </div>
</footer>

</body>
</html>