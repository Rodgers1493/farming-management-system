<?php
include 'connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Get logged-in user's id
$username = $_SESSION['username'];
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found.";
    exit();
}

$user_id = $user['id'];

$message = "";
$message_class = "";

// Handle form submission
if (isset($_POST['add_crop'])) {
    $crop_name = $_POST['crop_name'];
    $planting_date = $_POST['planting_date'];
    $harvesting_date = $_POST['harvesting_date'];
    $notes = $_POST['notes'];

    // Prepare and bind to prevent SQL injection
    $sql = "INSERT INTO crops_detailsuser (user_id, crop_name, planting_date, harvesting_date, notes) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $user_id, $crop_name, $planting_date, $harvesting_date, $notes);

    if ($stmt->execute()) {
        $message = "Crop added successfully!";
        $message_class = "success";
    } else {
        $message = "Error: " . $stmt->error;
        $message_class = "error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Crop</title>
    <style>
      /* General page styling */
body {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
    background: linear-gradient(
        rgba(0,0,0,0.5),
        rgba(0,0,0,0.5)
    ),
    url("farm.jpg"); /* your background image */
    background-size: cover;
    background-position: center;
    min-height: 100vh;
}

/* Form container */
.container {
   width: 500px;
    background: #ffffff;
    margin: 90px auto;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}

/* Heading */
.container h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #2e7d32;
}

/* Form labels */
label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

/* Inputs and textarea */
input[type="text"],
input[type="date"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

/* Textarea resizing */
textarea {
    resize: none;
    height: 80px;
}

/* Button */
button {
    width: 100%;
    padding: 12px;
    background: #2e7d32;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background: violet;
}

/* Back link */
.back-link {
    display: block;
    text-align: right;
    margin-top: 15px;
    text-decoration: none;
    color: #2e7d32;
    font-weight: bold;
}

/* Message styling */
.success {
    color: green;
    text-align: center;
    margin-bottom: 20px;
    font-weight: bold;
}

.error {
    color: red;
    text-align: center;
    margin-bottom: 20px;
    font-weight: bold;
}

    </style>
</head>
<body>
    

<div class="container">
    <h2>Add New Crop</h2>

    <?php if ($message): ?>
        <div class="<?php echo $message_class; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Crop Name</label>
        <input type="text" name="crop_name" placeholder="e.g maize" required>

        <label>Planting Date</label>
        <input type="date" name="planting_date" required>

        <label>Harvesting Date</label>
        <input type="date" name="harvesting_date" required>

        <label>Notes</label>
        <textarea name="notes" placeholder="Optional notes"></textarea>

        <button type="submit" name="add_crop">Add Crop</button>
    </form>

    <a href="dashboard.php" class="back-link">⬅ Back to Dashboard</a>
</div>

</body>
</html>
