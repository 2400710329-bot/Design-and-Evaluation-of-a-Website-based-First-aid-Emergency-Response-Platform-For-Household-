<?php

require_once "connection.php";

$sql = "SELECT * FROM emergency_contacts ORDER BY name ASC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Emergency Contacts | First Aid Response</title>

    <link rel="stylesheet" href="css/style.css">

    <style>

        .contacts-header {
            background: #e9f7f9;
            padding: 60px 7%;
            text-align: center;
        }

        .contacts-header h1 {
            font-size: 42px;
            color: #20313c;
            margin-bottom: 10px;
        }

        .contacts-header p {
            max-width: 700px;
            margin: auto;
            color: #68757d;
        }

        .contacts-container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .contact-warning {
            background: #fff4f4;
            border-left: 5px solid #d62828;
            padding: 20px;
            margin-bottom: 35px;
            border-radius: 7px;
        }

        .contact-warning h2 {
            color: #b42318;
            margin-bottom: 8px;
        }

        .contacts-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .contact-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.07);
            text-align: center;
        }

        .contact-icon {
            font-size: 45px;
            margin-bottom: 15px;
        }

        .contact-card h2 {
            color: #20313c;
            margin-bottom: 10px;
        }

        .contact-card p {
            color: #68757d;
            margin-bottom: 15px;
        }

        .phone-number {
            display: inline-block;
            background: #0b7285;
            color: white;
            text-decoration: none;
            padding: 11px 18px;
            border-radius: 7px;
            font-weight: bold;
        }

        .phone-number:hover {
            opacity: 0.88;
        }

        .no-contacts {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 12px;
        }

        @media (max-width: 850px) {

            .contacts-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 550px) {

            .contacts-grid {
                grid-template-columns: 1fr;
            }

            .contacts-header h1 {
                font-size: 34px;
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




<!-- Header -->

<section class="contacts-header">

    <h1>📞 Emergency Contacts</h1>

    <p>

        Emergency contact information available
        through the First Aid & Emergency Response Platform.

    </p>

</section>


<!-- Contacts -->

<div class="contacts-container">


    <div class="contact-warning">

        <h2>🚨 Serious Emergency?</h2>

        <p>
   If someone is seriously injured or in immediate
            danger, contact the appropriate professional
            emergency service immediately.

        </p>

    </div>


    <div class="contacts-grid">


        <?php

        if ($result && $result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

        ?>


            <div class="contact-card">

                <div class="contact-icon">
                    📞
                </div>


                <h2>

                    <?php
                    echo htmlspecialchars($row['name']);
                    ?>

                </h2>


                <p>

                    <?php
                    echo htmlspecialchars($row['description']);
                    ?>

                </p>


                <a
                    href="tel:<?php echo htmlspecialchars($row['phone']); ?>"
                    class="phone-number"
                >

                    Call
                    <?php
                    echo htmlspecialchars($row['phone']);
                    ?>

                </a>

            </div>


        <?php

            }

        } else {

        ?>


            <div class="no-contacts">

                <h2>
                    No emergency contacts available
                </h2>

                <p>
                    Emergency contacts will be added by the administrator.
                </p>

            </div>


        <?php

        }

        ?>

    </div>

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
</body>

</html>