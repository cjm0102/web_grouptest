<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

require_once 'db.php';

// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Retrieve user information based on the ID
    $stmt = $pdo->prepare("SELECT * FROM register WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "User not found.";
        exit;
    }
} else {
    echo "User ID not provided.";
    exit;
}

// Check if the form is submitted for updating user details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form data and update the user details in the database
    $updatedFirstName = $_POST['first_name'];
    $updatedLastName = $_POST['last_name'];
    $updatedEmail = $_POST['email'];
    $updatedPhone = $_POST['phone'];

    $updateStmt = $pdo->prepare("UPDATE register SET first_name = ?, last_name = ?, email = ?, phone = ? WHERE id = ?");
    $updateStmt->execute([$updatedFirstName, $updatedLastName, $updatedEmail, $updatedPhone, $userId]);

    // Redirect back to the list of participants after updating
    header("Location: list_participants.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Participant</title>
    <!-- Add Bootstrap CDN link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1 class="text-center">Edit Participant</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" name="first_name" value="<?php echo $user['first_name']; ?>" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" name="last_name" value="<?php echo $user['last_name']; ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" name="phone" value="<?php echo $user['phone']; ?>" required>
        </div>

        <div class="form-group text-center">
            <input type="submit" class="btn btn-primary" value="Update">
        </div>
    </form>

    <div class="text-center mt-3">
        <a href="list_participants.php" class="btn btn-secondary">Back to List of Participants</a>
    </div>
</div>

<!-- Add Bootstrap JS and Popper.js if needed -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>