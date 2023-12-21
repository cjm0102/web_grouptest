<?php
// Include necessary files and establish a database connection
global $pdo;
require_once 'db.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: privacy.php");
    exit;
}

// Fetch user information from the database
$email = $_SESSION['email'];
$sql = "SELECT * FROM register WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email, PDO::PARAM_STR); // Change to PDO::PARAM_STR for email
$stmt->execute();
$register = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>User Dashboard</h1>

    <p><strong>First Name:</strong> <?php echo $register['first_name']; ?></p>
    <p><strong>Last Name:</strong> <?php echo $register['last_name']; ?></p>
    <p><strong>Email:</strong> <?php echo $register['email']; ?></p>
    <p><strong>Phone:</strong> <?php echo $register['phone']; ?></p>

    <a href="user_update.php" class="btn btn-primary">Update Profile</a>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
