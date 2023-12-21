<?php
require_once 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            $hashedPassword = $admin['password'];
            
            if (password_verify($password, $hashedPassword)) {
                // Authentication successful
                $_SESSION['admin_id'] = $admin['id'];
                header("Location: admin_dashboard.php");
            } else {
                echo "Authentication failed. Invalid username or password.";
            }
        } else {
            echo "Authentication failed. Invalid username or password.";
        }
    } else {
        echo "Error authenticating admin user.";
    }
}
?>
