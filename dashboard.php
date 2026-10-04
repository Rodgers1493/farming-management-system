<?php
session_start();

/* Protect dashboard */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

/* Get username from session */
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Farming System</title>

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
            padding: 30px 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
        }

        header h1 {
            color: #2e7d32;
            font-size: 26px;
        }

        header a {
            text-decoration: none;
            color: #c62828;
            font-weight: 600;
        }

        main {
            padding: 60px 80px;
        }

        .welcome {
            margin-bottom: 40px;
        }

        .welcome h2 {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #555;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
        }

        .card {
            border: 1px solid #eee;
            padding: 30px;
            border-radius: 10px;
            text-decoration: none;
            color: #333;
            transition: 0.3s ease;
        }

        .card:hover {
            border-color: #2e7d32;
            transform: translateY(-3px);
        }

        .card h3 {
            color: #2e7d32;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 14px;
            color: #666;
        }

        footer {
            margin-top: 60px;
            text-align: center;
            padding: 25px;
            border-top: 1px solid #eee;
            color: #777;
            font-size: 14px;
        }

        @media (max-width: 700px) {
            header, main {
                padding: 30px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>🌱 Farming Dashboard</h1>
    <a href="logout.php">Logout</a>
</header>

<main>
    <div class="welcome">
       <h2 style="color:#2e7d32;">
    Welcome Back <?php echo ucfirst(htmlspecialchars($username)); ?> 👋
</h2>

        <p>Manage your crops and farming records from here.</p>
    </div>

    <div class="grid">
        <a href="add_crop.php" class="card">
            <h3>Add Crop</h3>
            <p>Register a new crop into the system.</p>
        </a>

        <a href="my_crops.php" class="card">
            <h3>My Crops</h3>
            <p>View all crops you have added.</p>
        </a>

        <a href="search_crop.php" class="card">
            <h3>Search Crops</h3>
            <p>Find crops quickly using keywords.</p>
        </a>

        <a href="delete_crop.php" class="card">
            <h3>Delete Crop</h3>
            <p>Remove crops you no longer need.</p>
        </a>
    </div>
</main>

<footer>
    © <?php echo date("Y"); ?> Farming Management System
</footer>

</body>
</html>
