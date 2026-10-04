<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Username not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login | Farming Management System</title>

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

/* Card */
.login-box {
    width: 360px;
    background: #ffffff;
    padding: 40px;
    border-radius: 14px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
}

/* Title */
.login-box h2 {
    text-align: center;
    margin-bottom: 30px;
    font-weight: 600;
    color: #333;
}

/* Labels */
.login-box label {
    font-size: 14px;
    color: #555;
    margin-bottom: 6px;
    display: block;
}

/* Inputs */
.login-box input {
    width: 100%;
    padding: 11px 12px;
    border-radius: 8px;
    border: 1px solid #dcdcdc;
    font-size: 14px;
    margin-bottom: 20px;
    background: #fff;
}

.login-box input:focus {
    outline: none;
    border-color: #7aa95c;
    box-shadow: 0 0 0 2px rgba(122, 169, 92, 0.15);
}

/* Button */
.login-box button {
    width: 100%;
    padding: 11px;
    background: #254cccff;
    border: none;
    border-radius: 8px;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
}

.login-box button:hover {
    background: #53be14ff;
}

/* Error */
.error {
    background: #fdecea;
    color: #b83c2f;
    padding: 10px;
    border-radius: 8px;
    font-size: 14px;
    margin-bottom: 20px;
    text-align: center;
}
</style>
</head>

<body>

<div class="login-box">
    <h2>Login</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

   <form method="POST" action="" autocomplete="off">
    <label>Username</label>
    <input type="text" name="username" placeholder="Enter username" autocomplete="off" required>

    <label>Password</label>
    <input type="password" name="password" placeholder="Enter password" autocomplete="new-password" required>

    <button type="submit" name="submit">Login</button>
</form>

</div>

</body>
</html>
