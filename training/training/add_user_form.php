<!DOCTYPE html>
<html>
<head>
    <title>Training Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        nav {
            background-color: #444;
            color: white;
            padding: 1em;
        }

        body {
            overflow-y: scroll; /* Always show vertical scrollbar */
        }

        .custom-container {
            margin-top: 5rem; /* Adjust the top margin as needed */
            padding-bottom: 2rem; /* Add some padding to the bottom */
        }
    </style>
</head>
<?php include 'header.php';?>

<body>
<div class="container mt-5 custom-container">
    <h1 class="mb-4">Training Registration Form</h1>
    <form action="process_adduser.php" method="POST">
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" name="first_name" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" name="last_name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" name="phone" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <br>
    <a href="list_participants.php" class="btn btn-secondary">List Participants</a>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<?php include 'footer.php';?>

</body>
</html>
<?php
