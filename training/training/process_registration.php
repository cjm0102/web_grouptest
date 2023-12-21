<?php
global $pdo;
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $sql = "INSERT INTO register (first_name, last_name, email, phone, password)
            VALUES (:first_name, :last_name, :email, :phone, :password)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);

    try {
        $stmt->execute();
        echo "Registration successful! Redirecting to home page in 3 seconds...";
        echo "<script>setTimeout(function(){ window.location.href = 'user_autheticate.php'; }, 3000);</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

