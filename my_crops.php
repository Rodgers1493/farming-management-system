<?php
session_start();
include 'connect.php';  // Make sure this sets up $conn as your MySQLi connection

// Protect page — only logged-in users allowed
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Get user id from username
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) {
    echo "User not found.";
    exit();
}

$user_id = $user['id'];

// Get crops for this user
$stmt = $conn->prepare("SELECT crop_id, crop_name, planting_date, harvesting_date, notes FROM crops_detailsuser WHERE user_id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Database query error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Crops</title>
    <style>
        /* Reset & base */
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9fafb;
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px 20px;
        }
        .container {
            background: #fff;
            max-width: 900px;
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgb(0 0 0 / 0.1);
            padding: 30px 40px;
            text-align: center;
        }
        h2 {
            margin-bottom: 24px;
            color: #2e7d32;
            font-weight: 700;
            letter-spacing: 1px;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px; /* vertical spacing between rows */
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.05);
        }
        thead tr {
            background-color: #2e7d32;
            color: white;
            text-align: left;
            font-weight: 600;
            border-radius: 8px;
        }
        thead tr th {
            padding: 14px 18px;
            font-size: 16px;
        }
        tbody tr {
            background-color: #fdfdfd;
            box-shadow: 0 2px 6px rgb(0 0 0 / 0.03);
            transition: background-color 0.3s ease;
            border-radius: 8px;
        }
        tbody tr:hover {
            background-color: #e6f4ea;
        }
        tbody tr td {
            padding: 14px 18px;
            font-size: 15px;
            vertical-align: middle;
        }
        a.link {
            display: inline-block;
            margin-top: 30px;
            font-weight: 600;
            color: #2e7d32;
            text-decoration: none;
            font-size: 16px;
            border: 2px solid #2e7d32;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        a.link:hover {
            background-color: #2e7d32;
            color: white;
        }

        /* Responsive */
        @media (max-width: 700px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead tr {
                display: none;
            }
            tbody tr {
                margin-bottom: 18px;
                box-shadow: none;
                background: #fff;
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 14px;
            }
            tbody tr td {
                padding: 10px 14px;
                text-align: right;
                position: relative;
                font-size: 14px;
                border-bottom: 1px solid #eee;
            }
            tbody tr td:last-child {
                border-bottom: 0;
            }
            tbody tr td::before {
                content: attr(data-label);
                position: absolute;
                left: 14px;
                top: 10px;
                font-weight: 600;
                text-transform: uppercase;
                font-size: 12px;
                color: #555;
                text-align: left;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>My Crops</h2>

    <table>
        <thead>
            <tr>
                <th>Crop Name</th>
                <th>Planting Date</th>
                <th>Harvesting Date</th>
                <th>Notes</th>
                <!-- Action column removed -->
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td data-label="Crop Name"><?= htmlspecialchars($row['crop_name']) ?></td>
                        <td data-label="Planting Date"><?= htmlspecialchars($row['planting_date']) ?></td>
                        <td data-label="Harvesting Date"><?= htmlspecialchars($row['harvesting_date']) ?></td>
                        <td data-label="Notes"><?= htmlspecialchars($row['notes']) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4" style="padding: 20px; font-style: italic;">No crops found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="link">Back To Dashboard</a>
</div>
</body>
</html>
