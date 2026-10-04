<?php
session_start();

// Redirect logged-in users to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Farming Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }
        body {
            background: #ffffff;
            color: #333;
        }
        header {
            padding: 40px 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
        }
        header h1 {
            color: #2e7d32;
            font-size: 28px;
        }
        nav a {
            margin-left: 20px;
            text-decoration: none;
            font-weight: 600;
            color: #333;
        }
        nav a.signup {
            background: #2e7d32;
            color: #fff;
            padding: 8px 18px;
            border-radius: 6px;
        }
        main {
            padding: 80px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }
        .text-section h2 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #222;
        }
        .text-section p {
            font-size: 17px;
            color: #555;
            margin-bottom: 35px;
            line-height: 1.6;
        }
        .actions a {
            text-decoration: none;
            margin-right: 15px;
            padding: 12px 28px;
            border-radius: 6px;
            font-weight: bold;
        }
        .login {
            background: #2e7d32;
            color: #fff;
        }
        .signup-btn {
            border: 2px solid #2e7d32;
            color: #2e7d32;
        }
        .image-section img {
            width: 100%;
            border-radius: 10px;
        }
        footer {
            text-align: center;
            padding: 30px;
            border-top: 1px solid #eee;
            color: #777;
            font-size: 14px;
        }
        @media (max-width: 900px) {
            main {
                grid-template-columns: 1fr;
                padding: 40px;
            }
        }
    </style>
</head>
<body>
<header>
    <h1>🌱 Farming System</h1>
    <nav>
        <a href="login.php">Log In</a>
        <a href="signup.php" class="signup">Sign Up</a>
    </nav>
</header>
<main>
    <div class="text-section">
        <h2>Smart Farming Starts Here</h2>
        <p>
            Manage your crops efficiently, track records, and make informed
            farming decisions using our simple and secure management system.
        </p>
        <div class="actions">
            <a href="login.php" class="login">Log In</a>
            <a href="signup.php" class="signup-btn">Create Account</a>
        </div>
    </div>
    <div class="image-section">
        <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6" alt="Farming" />
    </div>
</main>
<footer>
    © <?php echo date("Y"); ?> Farming Management System
</footer>
</body>
</html>
