<?php

session_start();

require_once "connection.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {

        $message = "Please enter your username and password.";

    } else {

        $stmt = $conn->prepare(
            "SELECT id, full_name, username, password, role
             FROM users
             WHERE username = ?"
        );

        $stmt->bind_param("s", $username);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {

            $user = $result->fetch_assoc();

            if (password_verify($password, $user["password"])) {

                $_SESSION["user_id"] = $user["id"];
                $_SESSION["full_name"] = $user["full_name"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["role"] = $user["role"];

                if ($user["role"] === "admin") {

                    header("Location: admin/dashboard.php");

                } else {

                    header("Location: dashboard.php");

                }

                exit;

            } else {

                $message = "Incorrect username or password.";

            }

        } else {

            $message = "Incorrect username or password.";

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

    <title>Login | First Aid Response</title>

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
            max-width: 450px;
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
            background: #fff0f0;
            color: #b42318;
            padding: 13px;
            border-radius: 7px;
            margin-bottom: 20px;
            text-align: center;
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

    </style>

</head>

<body>
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



<section class="auth-page">

    <div class="auth-box">

        <h1>🔐 Login</h1>

        <p class="auth-description">
            Login to the First Aid Response Platform.
        </p>


        <?php if (!empty($message)): ?>

            <div class="auth-message">

                <?php echo htmlspecialchars($message); ?>

            </div>

        <?php endif; ?>


        <form method="POST" action="login.php">


            <div class="form-group">

                <label>Username</label>

                <input
                    type="text"
                    name="username"
                    placeholder="Enter username"
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


            <button
                type="submit"
                class="auth-button"
            >

                Login

            </button>

        </form>


        <div class="auth-link">

            Don't have an account?

            <a href="register.php">
                Register here
            </a>

        </div>

    </div>

</section>


</body>

</html>
