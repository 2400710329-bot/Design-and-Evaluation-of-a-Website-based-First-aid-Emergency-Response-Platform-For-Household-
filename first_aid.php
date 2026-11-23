<?php
require_once "connection.php";
// Read the selected category from the URL.
$category = strtolower(trim($_GET['category'] ?? ''));
// Match each category to words stored in the database.
$categoryKeywords = [
    'burns' => 'burn',
    'cuts-bleeding' => 'cut',
    'choking' => 'chok',
    'electric-shock' => 'electric'
];
if ($category !== '' && isset($categoryKeywords[$category])) {
    $keyword = '%' . $categoryKeywords[$category] . '%';
    $stmt = $conn->prepare(
        "SELECT id, title, category, symptoms,
                immediate_steps, dont_do,
                when_to_seek_help, created_at
         FROM accidents
         WHERE category LIKE ? OR title LIKE ?
         ORDER BY title"
    );
    $stmt->bind_param("ss", $keyword, $keyword);
    $stmt->execute();
    $result = $stmt->get_result();
    $pageTitle = [
        'burns' => 'Burns First Aid Guide',
        'cuts-bleeding' => 'Cuts and Bleeding First Aid Guide',
        'choking' => 'Choking First Aid Guide',
        'electric-shock' => 'Electric Shock First Aid Guide'
    ][$category];
} else {
    // If no category is selected, show all accidents.
    $result = $conn->query(
        "SELECT id, title, category, symptoms,
                immediate_steps, dont_do,
                when_to_seek_help, created_at
         FROM accidents
         ORDER BY title"
    );
    $pageTitle = 'All First Aid Guides';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>First Aid Guide | First Aid Response</title>

    <link rel="stylesheet" href="css/style.css">

    <style>

        .guide-header {
            background: #e9f7f9;
            padding: 60px 7%;
            text-align: center;
        }

        .guide-header h1 {
            font-size: 40px;
            color: #20313c;
            margin-bottom: 10px;
        }

        .guide-header p {
            color: #68757d;
            max-width: 700px;
            margin: auto;
        }

        .guide-container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .search-box {
            margin-bottom: 35px;
            text-align: center;
        }

        .search-box input {
            width: 100%;
            max-width: 600px;
            padding: 15px 18px;
            border: 1px solid #d6dfe3;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
        }

        .search-box input:focus {
            border-color: #0b7285;
        }

        .accident-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.07);
        }

        .accident-card h2 {
            color: #0b7285;
            margin-bottom: 8px;
        }

        .category-label {
            display: inline-block;
            background: #e9f7f9;
            color: #0b7285;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .guide-section {
            margin-top: 20px;
        }

        .guide-section h3 {
            margin-bottom: 8px;
            color: #20313c;
        }

        .guide-section p {
            color: #596871;
            white-space: pre-line;
        }

        .steps-box {
            background: #f0f8f9;
            padding: 18px;
            border-left: 4px solid #0b7285;
            border-radius: 5px;
        }

        .danger-box {
            background: #fff4f4;
            padding: 18px;
            border-left: 4px solid #d62828;
            border-radius: 5px;
        }

        .help-box {
            background: #fff9e8;
            padding: 18px;
            border-left: 4px solid #e0a100;
            border-radius: 5px;
        }

        .no-results {
            text-align: center;
            padding: 40px;
            color: #68757d;
        }

           .navbar {
    width: 100%;
    min-height: 82px;
    padding: 16px 7%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
    background: var(--white);
    border-bottom: 1px solid #edf0f4;
    position: relative;
    z-index: 10;}

    .nav-links a{
text-decoration: underline;
color: #333;
font-weight: 500;
padding: 6px 10px;
border-bottom: 2px solid transparent;
transition: 0.2s;
}

     footer {
    background: #0a1931;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
    color: #ffffff;
    padding: 40px 30px 20px 30px;
    font-family: Arial, sans-serif;
}

.footer-content {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: flex-start;
    gap: 50px;
    margin-left: 30px;
    margin-right: 30px;
}

.footer-about {
    flex: 1;
}
.footer-about h3 {
    font-size: 20px;
    margin-bottom: 12px;
    font-weight: bold;
}
.footer-about p {
    color: #cbd5e1;
    line-height: 1.6;
    font-size: 15px;
}

.footer-links {
    display: flex; 
    flex-direction: column; 
    gap: 12px;
    min-width: 200px;
    margin-left: 20px;
}
.footer-links h3 {
    font-size: 20px;
    margin-bottom: 12px;
    font-weight: bold;
}
.footer-links a {
    color: #ffffff;
    text-decoration: none;
    font-size: 15px;
    transition: 0.2s;
}
.footer-links a:hover {
    color: #60a5fa;
    text-decoration: underline;
    transform: translateX(5px);
}

.copyright {
    margin-top: 40px;
    padding-top: 20px;
    border-top: 1px solid rgba(255,255,255,0.1);
    text-align: center;
    margin-left: 30px;
    margin-right: 30px;
}
.copyright p {
    color: #94a3b8;
    font-size: 13px;
}
/* phone responsive */
@media (max-width: 700px) {
    .footer-content {
        flex-direction: column; /* stack on phone */
        margin-left: 15px;
    }
}

.navbar {
    width: 100%;
    min-height: 82px;
    padding: 16px 7%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
    background: var(--white);
    border-bottom: 1px solid #edf0f4;
    position: relative;
    z-index: 10;
}
.logo {
    display: inline-flex;
    align-items: center;
    gap: 11px;
    color: var(--navy);
    font-size: 19px;
    font-weight: 700;
    white-space: nowrap;
}
.logo strong {
    color: var(--red);
}
.logo-icon {
    width: 39px;
    height: 39px;
    border-radius: 12px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    color: white;
    background: var(--red);
    font-size: 27px;
    line-height: 1;
}
.nav-links {
    display: flex;
    align-items: center;
    gap: 27px;
}
.nav-links > a {
    font-size: 13px;
    font-weight: 600;
    color: #526175;
    transition: color 0.25s ease;
}
.nav-links > a:hover,
.nav-links > a.active {
    color: var(--red);
}
.nav-links .login-btn {
    padding: 10px 18px;
    background: var(--navy);
    color: white;
    border-radius: 9px;
    transition: background 0.25s ease, transform 0.25s ease;
}
.login-btn span {
    margin-left: 7px;
}
.nav-links .login-btn:hover {
    background: var(--red);
    color: white;
    transform: translateY(-2px);
}

    </style>

</head>

<body>
    

<!-- Navigation -->

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


<!-- Page Header -->

<section class="guide-header">

    <h1>🩹 First Aid Guide</h1>

    <p>
        Find basic first-aid information for common
        domestic household accidents.
    </p>

</section>


<!-- Guide Content -->

<div class="guide-container">


    <!-- Search -->

    <div class="search-box">

        <input
            type="text"
            id="searchInput"
            placeholder="🔎 Search for an accident, e.g. burns, choking..."
            onkeyup="searchGuides()"
        >

    </div>


    <?php
 if ($result && $result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

    ?>

        <div class="accident-card">

            <span class="category-label">

                <?php echo htmlspecialchars($row['category']); ?>

            </span>


            <h2>
                <?php echo htmlspecialchars($row['title']); ?>
            </h2>


            <!-- Symptoms -->

            <div class="guide-section">

                <h3>⚠️ Signs and Symptoms</h3>

                <p>
                    <?php echo htmlspecialchars($row['symptoms']); ?>
                </p>

            </div>


            <!-- Immediate Steps -->

            <div class="guide-section">

                <h3>✅ What To Do</h3>

                <div class="steps-box">

                    <p>
                        <?php echo htmlspecialchars($row['immediate_steps']); ?>
                    </p>

                </div>

            </div>


            <!-- Don't Do -->

            <div class="guide-section">

                <h3>❌ What NOT To Do</h3>

                <div class="danger-box">

                    <p>
                        <?php echo htmlspecialchars($row['dont_do']); ?>
                    </p>

                </div>

            </div>


            <!-- When To Seek Help -->

            <div class="guide-section">

                <h3>🚨 When To Seek Professional Help</h3>

                <div class="help-box">

                    <p>
                        <?php echo htmlspecialchars($row['when_to_seek_help']); ?>
                    </p>

                </div>

            </div>

        </div>

    <?php

        }

    } else {

    ?>

        <div class="no-results">

            <h2>No first-aid information available yet.</h2>

            <p>
                The administrator needs to add accident information.
            </p>

        </div>

    <?php

    }

    ?>

</div>


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

<script>

function searchGuides() {

    let input = document
        .getElementById("searchInput")
        .value
        .toLowerCase();

    let cards = document
        .getElementsByClassName("accident-card");


    for (let i = 0; i < cards.length; i++) {

        let text = cards[i].innerText.toLowerCase();

        if (text.includes(input)) {

            cards[i].style.display = "block";

        } else {

            cards[i].style.display = "none";

        }

    }

}

</script>

</body>

</html>