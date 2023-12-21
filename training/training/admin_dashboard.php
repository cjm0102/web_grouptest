<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em;
        }

        h1 {
            margin-top: 0;
        }

        nav {
            background-color: #444;
            color: white;
            padding: 1em;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        li {
            margin: 0 1em;
        }

        a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        a:hover {
            color: #ffcc00;
        }

        .container {
            margin: 2em;
        }
    </style>
</head>
<body>
<header>
    <h1>Welcome, Admin</h1>
</header>

<nav>
    <ul>
        <li><a href="list_participants.php">List Participants</a></li>
        <li><a href="add_user_form.php">Add Participants</a></li>
        <li><a href="index.html">Log out</a></li>
    </ul>
</nav>

<div class="container">
    <!-- Your dashboard content goes here -->
</div>

<?php include 'footer.php'; ?>
</body>
</html>
