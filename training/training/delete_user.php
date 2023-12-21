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

// Check if the user has confirmed the deletion
if (isset($_POST['confirm_delete'])) {
    // Delete the user from the database
    $deleteStmt = $pdo->prepare("DELETE FROM register WHERE id = ?");
    $deleteStmt->execute([$userId]);

    // Redirect back to the list of participants after deletion
    header("Location: list_participants.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Participant</title>
    <!-- Add Bootstrap CDN link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-top: 50px;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        p {
            text-align: center;
            color: #555;
        }

        .list-group-item {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            color: #495057;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: 1px solid #dc3545;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
            border: 1px solid #6c757d;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Delete Participant</h1>
    <p>Are you sure you want to delete the following participant?</p>

    <ul class="list-group">
        <li class="list-group-item"><b>ID:</b> <?php echo $user['id']; ?></li>
        <li class="list-group-item"><b>First Name:</b> <?php echo $user['first_name']; ?></li>
        <li class="list-group-item"><b>Last Name:</b> <?php echo $user['last_name']; ?></li>
        <li class="list-group-item"><b>Email:</b> <?php echo $user['email']; ?></li>
        <li class="list-group-item"><b>Phone:</b> <?php echo $user['phone']; ?></li>
    </ul>

    <form method="post" action="" class="mt-3 text-center">
        <input type="submit" class="btn btn-danger" name="confirm_delete" value="Yes, Delete">
        <a href="list_participants.php" class="btn btn-secondary">No, Cancel</a>
    </form>
</div>

<!-- Add Bootstrap JS and Popper.js if needed -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php include 'footer.php'; ?>
</body>
</html>