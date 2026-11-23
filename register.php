<?php

require_once "connection.php";

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = trim($_POST["full_name"]);
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if (
        empty($full_name) ||
        empty($username) ||
        empty($password) ||
        empty($confirm_password)
    ) {

        $message = "Please fill in all fields.";
        $message_type = "error";

    } elseif ($password !== $confirm_password) {

        $message = "Passwords do not match.";
        $message_type = "error";

    } elseif (strlen($password) < 6) {

        $message = "Password must contain at least 6 characters.";
        $message_type = "error";

    } else {

        $check = $conn->prepare(
            "SELECT id FROM users WHERE username = ?"
        );

        $check->bind_param("s", $username);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {

            $message = "That username is already registered.";
            $message_type = "error";

        } else {

            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $stmt = $conn->prepare(
                "INSERT INTO users
                (full_name, username, password, role)
                VALUES (?, ?, ?, 'user')"
            );

            $stmt->bind_param(
                "sss",
                $full_name,
                $username,
                $hashed_password
            );

            if ($stmt->execute()) {

                $message = "Registration successful. You can now log in.";
                $message_type = "success";

            } else {

                $message = "Registration failed. Please try again.";
                $message_type = "error";

            }

            $stmt->close();
        }

        $check->close();
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Register | First Aid Response</title>

    <link rel="stylesheet" href="css/style.css">

    <style>

        .auth-page {
            min-height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 20px;
            background: #f5f8fa;
        }

        .auth-box {
            width: 100%;
            max-width: 480px;
            background: white;
            padding: 40px;
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }

        .auth-box h1 {
            text-align: center;
            color: #20313c;
            margin-bottom: 8px;
        }

        .auth-description {
            text-align: center;
            color: #68757d;
            margin-bottom: 30px;
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

        .form-group input {
            width: 100%;
            padding: 13px;
            border: 1px solid #d6dfe3;
            border-radius: 7px;
            font-size: 15px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #0b7285;
        }

        .auth-button {
            width: 100%;
            padding: 14px;
            background: #0b7285;
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
  .auth-button:hover {
            opacity: 0.9;
        }

        .auth-message {
            padding: 13px;
            border-radius: 7px;
            margin-bottom: 20px;
            text-align: center;
        }

        .success {
            background: #eaf8ee;
            color: #176b35;
        }

        .error {
            background: #fff0f0;
            color: #b42318;
        }

        .auth-link {
            text-align: center;
            margin-top: 20px;
            color: #68757d;
        }

        .auth-link a {
            color: #0b7285;
            font-weight: bold;
            text-decoration: none;
        }

    </style>

</head>

<body>

<header class="navbar">

    <div class="logo">
        <span>🚑</span>
        First Aid Response
    </div>

    <nav>

        <a href="index.php">Home</a>

        <a href="first_aid.php">First Aid Guide</a>

        <a href="emergency.php">Emergency</a>

        <a href="contacts.php">Contacts</a>

        <a href="login.php" class="login-btn">Login</a>

    </nav>

</header>


<section class="auth-page">

    <div class="auth-box">

        <h1>📝 Create Account</h1>

        <p class="auth-description">
            Register to use the First Aid Response Platform.
        </p>


        <?php if (!empty($message)): ?>

            <div class="auth-message <?php echo $message_type; ?>">

                <?php echo htmlspecialchars($message); ?>

            </div>

        <?php endif; ?>


        <form method="POST" action="register.php">

            <div class="form-group">

                <label>Full Name</label>

                <input
                    type="text"
                    name="full_name"
                    placeholder="Enter your full name"
                    required
                >

            </div>


            <div class="form-group">

                <label>Username</label>

                <input
                    type="text"
                    name="username"
                    placeholder="Choose a username"
                    required
                >

            </div>


            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter password"
                    required
                >

            </div>


            <div class="form-group">

                <label>Confirm Password</label>

                <input
                    type="password"
                    name="confirm_password"
                    placeholder="Confirm password"
                    required
                >

            </div>


            <button
                type="submit"
                class="auth-button"
            >
                Create Account
            </button>

        </form>


        <div class="auth-link">

            Already have an account?

            <a href="login.php">
                Login here
            </a>

        </div>

    </div>

</section>


</body>

</html>