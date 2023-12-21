<?php
global $pdo;
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>

    <?php include 'header.php'; ?>
    <title>List Participants</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>List of Participants</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require_once 'db.php';

        $sql = "SELECT * FROM register";
        $stmt = $pdo->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";

            // Edit link
            echo "<td><a href='edit_user.php?id=" . $row['id'] . "' class='btn btn-primary'>Update</a></td>";

            // Delete link
            echo "<td><a href='delete_user.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a></td>";

            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <br>
    <a href="admin_dashboard.php" class="btn btn-secondary">Back to Admin Dashboard</a>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<?php include 'footer.php';?>
</body>
</html>