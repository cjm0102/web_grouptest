<?php
global $pdo;
session_start();
if (!isset($_SESSION['register_id'])) {
    header("Location: user_autheticate.php");
    exit;
}

require_once 'db.php';

// Check if the user ID is provided in the URL
if (isset($_GET['register_id'])) {
    $registerId = $_GET['register_id'];

    // Retrieve user information based on the ID
    $stmt = $pdo->prepare("SELECT * FROM register WHERE id = ?");
    $stmt->execute([$registerId]);
    $register= $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$register) {
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

    $updateStmt = $pdo->prepare("UPDATE register SET first_name = ?, last_name = ?, email = ?, phone = ? WHERE register_id = ?");
    $updateStmt->execute([$updatedFirstName, $updatedLastName, $updatedEmail, $updatedPhone, $registerId]);

    // Redirect back to the list of participants after updating
    header("Location: list_participants.php");
    exit;
}
?>