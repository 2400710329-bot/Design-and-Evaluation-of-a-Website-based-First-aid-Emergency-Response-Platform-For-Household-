<?php

session_start();

require_once "connection.php";


// Check if user is logged in

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit;

}


// Get logged-in user's information

$user_id = $_SESSION["user_id"];

$full_name = $_SESSION["full_name"];

$username = $_SESSION["username"];

$role = $_SESSION["role"];


// Count user's emergency reports

$stmt = $conn->prepare(
    "SELECT COUNT(*) AS total
     FROM emergency_reports
     WHERE user_name = ?"
);

$stmt->bind_param("s", $full_name);

$stmt->execute();

$result = $stmt->get_result();

$data = $result->fetch_assoc();

$total_reports = $data["total"];

$stmt->close();

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>User Dashboard | First Aid Response</title>

    <link rel="stylesheet" href="css/style.css">


    <style>

        .dashboard-header {

            background: #e9f7f9;

            padding: 50px 7%;

        }


        .dashboard-header h1 {

            color: #20313c;

            margin-bottom: 8px;

        }


        .dashboard-header p {

            color: #68757d;

        }


        .dashboard-container {

            max-width: 1100px;

            margin: 40px auto;

            padding: 0 20px;

        }


        .welcome-box {

            background: white;

            padding: 25px;

            border-radius: 12px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.07);

            margin-bottom: 30px;

        }


        .welcome-box h2 {

            color: #0b7285;

            margin-bottom: 8px;

        }


        .stats-grid {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 20px;

            margin-bottom: 35px;

        }


        .stat-card {

            background: white;

            padding: 25px;

            border-radius: 12px;

            text-align: center;

            box-shadow: 0 5px 20px rgba(0,0,0,0.07);

        }


        .stat-card .icon {

            font-size: 35px;

            margin-bottom: 10px;

        }


        .stat-card h3 {

            color: #20313c;

            margin-bottom: 5px;

        }


        .stat-card p {

            color: #68757d;

        }


        .dashboard-actions {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 20px;

        }


        .action-card {

            background: white;

            padding: 30px;

            border-radius: 12px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.07);

            text-align: center;

        }


        .action-card h2 {

            color: #20313c;

            margin-bottom: 10px;

        }


        .action-card p {

            color: #68757d;

            margin-bottom: 20px;

        }


        .action-button {

            display: inline-block;

            padding: 11px 20px;

            background: #0b7285;

            color: white;

            text-decoration: none;

            border-radius: 7px;

            font-weight: bold;

        }


        .emergency-button {

            background: #d62828;

        }


        .logout-button {

            background: #596871;

        }


        @media (max-width: 800px) {

            .stats-grid,

            .dashboard-actions {

                grid-template-columns: 1fr;

            }

        }

    </style>

</head>


<body>


<!-- Navigation -->

<header class="navbar">

    <div class="logo">

        <span>🚑</span>

        First Aid Response

    </div>


    <nav>

        <a href="index.php">
            Home
        </a>

        <a href="first_aid.php">
            First Aid Guide
        </a>

        <a href="emergency.php">
            Emergency
        </a>

        <a href="contacts.php">
            Contacts
        </a>

        <a href="dashboard.php">
            Dashboard
        </a>

    </nav>

</header>


<!-- Dashboard Header -->

<section class="dashboard-header">

    <h1>
        👋 Welcome, <?php echo htmlspecialchars($full_name); ?>
    </h1>

    <p>
        Welcome to your First Aid Response dashboard.
    </p>

</section>


<!-- Dashboard Content -->

<div class="dashboard-container">


    <!-- Welcome -->

    <div class="welcome-box">

        <h2>
            Your Account
        </h2>

        <p>

            Username:
            <strong>
                <?php echo htmlspecialchars($username); ?>
            </strong>

        </p>

        <p>

            Account Type:
            <strong>
                <?php echo htmlspecialchars($role); ?>
            </strong>

        </p>

    </div>


    <!-- Statistics -->

    <div class="stats-grid">


        <div class="stat-card">

            <div class="icon">
                🩹
            </div>

            <h3>
                First Aid Guide
            </h3>

            <p>
                Access first-aid information
                for household accidents.
            </p>

        </div>


        <div class="stat-card">

            <div class="icon">
                🚨
            </div>

            <h3>
                <?php echo $total_reports; ?>
            </h3>

            <p>
                Emergency reports
            </p>

        </div>


        <div class="stat-card">

            <div class="icon">
                📞
            </div>

            <h3>
                Emergency Contacts
            </h3>

            <p>
                Access emergency contact information.
            </p>

        </div>


    </div>


    <!-- Actions -->

    <div class="dashboard-actions">


        <!-- First Aid -->

        <div class="action-card">

            <h2>
                🩹 First Aid Guide
            </h2>

            <p>

                Learn what to do when common
                household accidents occur.

            </p>

            <a
                href="first_aid.php"
                class="action-button"
            >

                View Guide

            </a>

        </div>


        <!-- Emergency -->

        <div class="action-card">

            <h2>
                🚨 Emergency
            </h2>

            <p>

                Submit information about
                an emergency situation.

            </p>

            <a
                href="emergency.php"
                class="action-button emergency-button"
            >

                Report Emergency

            </a>

        </div>


        <!-- Contacts -->

        <div class="action-card">

            <h2>
                📞 Contacts
            </h2>

            <p>

                View available emergency
                contact information.

            </p>
 <a
                href="contacts.php"
                class="action-button"
            >

                View Contacts

            </a>

        </div>


    </div>


    <!-- Logout -->

    <div style="text-align:center; margin-top:35px;">

        <a
            href="logout.php"
            class="action-button logout-button"
        >

            🚪 Logout

        </a>

    </div>


</div>


</body>

</html>