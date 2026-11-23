<?php

require_once "connection.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_name = trim($_POST["user_name"]);
    $phone = trim($_POST["phone"]);
    $location = trim($_POST["location"]);
    $accident_type = trim($_POST["accident_type"]);
    $details = trim($_POST["details"]);

    if (
        empty($user_name) ||
        empty($location) ||
        empty($accident_type)
    ) {

        $message = "Please complete all required fields.";

    } else {

        $stmt = $conn->prepare(
            "INSERT INTO emergency_reports
            (user_name, phone, location, accident_type, details)
            VALUES (?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "sssss",
            $user_name,
            $phone,
            $location,
            $accident_type,
            $details
        );

        if ($stmt->execute()) {

            $message = "Emergency report submitted successfully. If this is a life-threatening emergency, contact professional emergency services immediately.";

        } else {

            $message = "Unable to submit the emergency report. Please try again.";

        }

        $stmt->close();
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Emergency Response | First Aid Response</title>

    <link rel="stylesheet" href="css/style.css">

    <style>

        .emergency-header {
            background: #fff1f1;
            padding: 60px 7%;
            text-align: center;
        }

        .emergency-header h1 {
            font-size: 42px;
            color: #b42318;
            margin-bottom: 10px;
        }

        .emergency-header p {
            max-width: 700px;
            margin: auto;
            color: #68757d;
        }

        .emergency-container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .emergency-warning {
            background: #fff4f4;
            border-left: 5px solid #d62828;
            padding: 20px;
            margin-bottom: 35px;
            border-radius: 7px;
        }

        .emergency-warning h2 {
            color: #b42318;
            margin-bottom: 8px;
        }

        .emergency-layout {
            display: grid;
            grid-template-columns: 1fr 1.4fr;
            gap: 30px;
        }

        .emergency-info,
        .emergency-form {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.07);
        }

        .emergency-info h2,
        .emergency-form h2 {
            margin-bottom: 20px;
            color: #20313c;
        }

        .emergency-info ul {
            padding-left: 20px;
        }

        .emergency-info li {
            margin-bottom: 15px;
            color: #596871;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #34495e;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d6dfe3;
            border-radius: 7px;
            font-size: 15px;
            font-family: Arial, Helvetica, sans-serif;
            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #0b7285;
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }
 .required {
            color: #d62828;
        }

        .submit-emergency {
            width: 100%;
            padding: 14px;
            background: #d62828;
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .submit-emergency:hover {
            opacity: 0.9;
        }

        .success-message {
            background: #eaf8ee;
            color: #176b35;
            padding: 15px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .info-message {
            background: #eef7fb;
            color: #14566b;
            padding: 15px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        @media (max-width: 800px) {

            .emergency-layout {
                grid-template-columns: 1fr;
            }

            .emergency-header h1 {
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

<section class="emergency-header">

    <h1>🚨 Emergency Response</h1>

    <p>

        Use this page to record an emergency request
        and provide information about the situation.

    </p>

</section>


<!-- Main Content -->

<div class="emergency-container">


    <div class="emergency-warning">

        <h2>⚠️ Important</h2>

        <p>

            If someone is seriously injured, unconscious,
            having difficulty breathing, or experiencing
            another life-threatening emergency, contact
            professional emergency services immediately.

        </p>

    </div>


    <div class="emergency-layout">


        <!-- Emergency Information -->

        <div class="emergency-info">

            <h2>What To Do First</h2>

            <ul>

                <li>
                    Stay calm and assess the situation
                    without putting yourself in danger.
                </li>

                <li>
                    Move away from immediate hazards
                    where it is safe to do so.
                </li>

                <li>
                    Check whether the person is responsive
                    and breathing normally.
                </li>

                <li>
                    Use the First Aid Guide for appropriate
                    basic first-aid information.
                </li>

                <li>
                    Contact professional emergency services
                    for serious or life-threatening situations.
                </li>
                   <li>
                    Provide clear information about the
                    location and type of emergency.
                </li>

            </ul>

        </div>


        <!-- Emergency Form -->

        <div class="emergency-form">

            <h2>Submit Emergency Report</h2>


            <?php if (!empty($message)): ?>

                <div class="success-message">

                    <?php echo htmlspecialchars($message); ?>

                </div>

            <?php endif; ?>


            <form method="POST"
                  action="emergency.php"
                  onsubmit="return validateEmergencyForm();">


                <!-- Name -->

                <div class="form-group">

                    <label>

                        Your Name
                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        name="user_name"
                        id="user_name"
                        placeholder="Enter your name"
                        required
                    >

                </div>


                <!-- Phone -->

                <div class="form-group">

                    <label>

                        Phone Number

                    </label>

                    <input
                        type="tel"
                        name="phone"
                        placeholder="Enter your phone number"
                    >

                </div>


                <!-- Location -->

                <div class="form-group">

                    <label>

                        Location
                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        name="location"
                        id="location"
                        placeholder="Example: Gulu, Uganda"
                        required
                    >

                </div>


                <!-- Accident -->

                <div class="form-group">

                    <label>

                        Accident Type
                        <span class="required">*</span>

                    </label>

                    <select
                        name="accident_type"
                        id="accident_type"
                        required
                    >

                        <option value="">
                            -- Select Accident Type --
                        </option>

                        <option value="Burns">
                            Burns
                        </option>

                        <option value="Cuts and Bleeding">
                            Cuts and Bleeding
                        </option>

                        <option value="Choking">
                            Choking
                        </option>

                        <option value="Electric Shock">
                            Electric Shock
                        </option>
                          <option value="Falls">
                            Falls
                        </option>

                        <option value="Poisoning">
                            Poisoning
                        </option>

                        <option value="Other">
                            Other
                        </option>

                    </select>

                </div>


                <!-- Details -->

                <div class="form-group">

                    <label>

                        What Happened?

                    </label>

                    <textarea
                        name="details"
                        placeholder="Briefly describe the emergency..."
                    ></textarea>

                </div>


                <!-- Submit -->

                <button
                    type="submit"
                    class="submit-emergency"
                >

                    🚨 Submit Emergency Report

                </button>


            </form>

        </div>

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

<script>

function validateEmergencyForm() {

    let name =
        document.getElementById("user_name").value.trim();

    let location =
        document.getElementById("location").value.trim();

    let accident =
        document.getElementById("accident_type").value;


    if (name === "") {

        alert("Please enter your name.");

        return false;

    }


    if (location === "") {

        alert("Please enter the emergency location.");

        return false;

    }


    if (accident === "") {

        alert("Please select the accident type.");

        return false;

    }


    return true;

}

</script>


</body>

</html>
