<?php
session_start();
include 'connect.php';

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Crops</title>
    <style>
        /* Base styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9fafb;
            color: #333;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }
        .container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            max-width: 700px;
            width: 100%;
            box-shadow: 0 8px 16px rgb(0 0 0 / 0.1);
            text-align: center;
        }
        h2 {
            color: #2e7d32;
            margin-bottom: 24px;
            font-weight: 700;
        }
        form {
            margin-bottom: 30px;
        }
        input[type="text"] {
            padding: 10px 14px;
            border-radius: 6px;
            border: 1.8px solid #ccc;
            font-size: 16px;
            width: 60%;
            max-width: 400px;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus {
            outline: none;
            border-color: #2e7d32;
        }
        button.btn {
            padding: 10px 20px;
            border-radius: 10px;
            background-color: #2e7d32;
            color: white;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-left: 12px;
        }
        button.btn:hover {
            background-color: #1b4d22;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.05);
        }
        table th, table td {
            padding: 14px 18px;
            border-bottom: 1px solid #ddd;
            font-size: 15px;
            text-align: left;
        }
        table thead {
            background-color: #2e7d32;
            color: white;
            font-weight: 600;
        }
        table tbody tr:hover {
            background-color: #e6f4ea;
        }
        p.no-results {
            font-style: italic;
            color: #777;
            margin-top: 20px;
        }
        a.back-link {
            display: inline-block;
            margin-top: 30px;
            font-weight: 600;
            color: #2e7d32;
            text-decoration: none;
            border: 2px solid #2e7d32;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        a.back-link:hover {
            background-color: #2e7d32;
            color: white;
        }

        /* Responsive */
        @media (max-width: 600px) {
            input[type="text"] {
                width: 100%;
                margin-bottom: 12px;
                margin-left: 0;
            }
            button.btn {
                width: 100%;
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Search Crops</h2>

    <form method="GET" action="">
        <input type="text" name="search" placeholder="Enter crop name" required value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit" class="btn">Search</button>
    </form>

    <?php
    if (isset($_GET['search'])) {
        $search = $_GET['search'];

        // Also ensure user only sees their own crops (by joining user id)
        $username = $_SESSION['username'];
        $stmtUser = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmtUser->bind_param("s", $username);
        $stmtUser->execute();
        $user = $stmtUser->get_result()->fetch_assoc();

        if ($user) {
            $user_id = $user['id'];
            $sql = "SELECT crop_name, planting_date, harvesting_date, notes 
                    FROM crops_detailsuser 
                    WHERE user_id = ? AND crop_name LIKE ?";
            $stmt = $conn->prepare($sql);
            $param = "%$search%";
            $stmt->bind_param("is", $user_id, $param);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<table>
                        <thead>
                            <tr>
                                <th>Crop Name</th>
                                <th>Planting Date</th>
                                <th>Harvesting Date</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['crop_name']) . "</td>
                            <td>" . htmlspecialchars($row['planting_date']) . "</td>
                            <td>" . htmlspecialchars($row['harvesting_date']) . "</td>
                            <td>" . htmlspecialchars($row['notes']) . "</td>
                          </tr>";
                }

                echo "</tbody></table>";
            } else {
                echo "<p class='no-results'>No crops found.</p>";
            }
        } else {
            echo "<p class='no-results'>User not found.</p>";
        }
    }
    ?>

    <a href="dashboard.php" class="back-link">⬅ Back to Dashboard</a>
</div>
</body>
</html>
