<?php
session_start();  // Start session at the very top
include 'connect.php';

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Hash the password before saving
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Use prepared statements for security
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        // Get the inserted user's id
        $user_id = $stmt->insert_id;

        // Set session variables to log user in
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;

        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Signup | Farming Management System</title>
<style>
    * {
        box-sizing: border-box;
        font-family: "Segoe UI", Arial, sans-serif;
    }

    body {
        margin: 0;
        height: 100vh;
        background: #f4f6f8;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .signup-box {
        width: 380px;
        background: #ffffff;
        padding: 40px 35px;
        border-radius: 14px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        font-weight: 600;
        color: #333;
    }

    label {
        display: block;
        font-weight: 600;
        margin-bottom: 6px;
        color: #555;
        font-size: 14px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 11px 12px;
        border-radius: 8px;
        border: 1px solid #dcdcdc;
        font-size: 14px;
        margin-bottom: 20px;
        background: #fff;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        outline: none;
        border-color: #7aa95c;
        box-shadow: 0 0 0 2px rgba(122, 169, 92, 0.15);
    }

    button.btn {
        width: 100%;
        padding: 12px;
        background: green;
        border: none;
        border-radius: 8px;
        color: white;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
    }

    button.btn:hover {
        background: blue;
    }

    .message {
        text-align: center;
        font-size: 14px;
        margin-bottom: 20px;
        padding: 10px;
        border-radius: 8px;
    }

    .error {
        background: #fdecea;
        color: #b83c2f;
    }

    .success {
        background: #e6f4ea;
        color: #3c763d;
    }

    a {
        color: #67934d;
        text-decoration: none;
        font-weight: 600;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>
<div class="signup-box">
    <h2>Signup</h2>

    <?php if (!empty($error)): ?>
        <div class="message error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" action="" autocomplete="off">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" autocomplete="off" placeholder="eg rodgers" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="your email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" autocomplete="new-password" placeholder="eg r@123" required>

        <button type="submit" name="submit" class="btn">Signup</button>
    </form>
</div>
</body>
</html>
