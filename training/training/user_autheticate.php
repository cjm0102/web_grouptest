<?php
global $pdo;
session_start();

// Include necessary files and establish a database connection
require_once 'db.php';

// Check if the form is submitted for user authentication
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user credentials against the database
    $stmt = $pdo->prepare("SELECT * FROM register WHERE email = ?");
    $stmt->execute([$username]);
    $register = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists and the password is correct
    if ($register && password_verify($password, $register['password'])) {
        // Start a session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Store user email in the session
        $_SESSION['email'] = $register['email'];
        header("Location: user_dashboard.php");
        exit;
    } else {
        // Invalid credentials, show an error message
        $error_message = "Invalid email or password";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1>User Login</h1>

    <?php if (isset($error_message)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <!-- User Login Form -->
    <form action="user_autheticate.php" method="POST">
        <div class="form-group">
            <label for="username">Email:</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <!-- Registration Link -->
    <br>
    <a href="registration_form.php">Don't have an account? Register here</a>
</div>

<!-- Add Bootstrap JS and Popper.js CDN links (optional, for Bootstrap components that require them) -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZwT" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
