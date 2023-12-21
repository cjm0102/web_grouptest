<?php
// Include necessary files and establish a database connection
global $pdo;
require_once 'db.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: user_authenticate.php");
    exit;
}

// Fetch user information from the database
$email = $_SESSION['email'];
$sql = "SELECT * FROM register WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$register = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            overflow-y: scroll; /* Always show vertical scrollbar */
        }

        .custom-container {
            margin-top: 5rem; /* Adjust the top margin as needed */
            padding-bottom: 2rem; /* Add some padding to the bottom */
        }
    </style>
</head>
<body>
<div class="container mt-5 custom-container">
    <h1 class="mb-4">Update Profile</h1>

    <form action="process_user_update.php" method="POST">
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" name="first_name" value="<?php echo $register['first_name']; ?>" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" name="last_name" value="<?php echo $register['last_name']; ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo $register['email']; ?>" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" name="phone" value="<?php echo $register['phone']; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
    <br>
    <a href="list_participants.php" class="btn btn-secondary">List Participants</a>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
