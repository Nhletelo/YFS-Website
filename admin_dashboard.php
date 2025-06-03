<?php
// Start a session (if needed)
session_start();
require_once 'db_conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Youth For Survival</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: #fff;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
            position: fixed;
        }
        .sidebar h2 {
            margin-bottom: 30px;
            font-size: 24px;
            text-align: center;
        }
        .sidebar a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            margin-bottom: 10px;
            background: #34495e;
            border-radius: 4px;
        }
        .sidebar a:hover {
            background: #1abc9c;
        }
        .content {
            margin-left: 250px;
            padding: 30px;
            flex: 1;
        }
        .logout-btn {
            display: inline-block;
            margin-top: 20px;
            background: #e74c3c;
            padding: 10px 15px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .logout-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <p>Welcome, <strong><?php echo htmlspecialchars($_SESSION['admin_name']); ?></strong></p>

    <a href="admin_gallery.php">Manage Gallery</a>
    <a href="manage_news.php">Manage News</a>
    <a href="manage_causes.php">Manage Causes</a>
    <a href="manage_users.php">Manage Users</a>
    <a href="message_users.php">Sent a text</a>
        <a href="logout.php" class="logout-btn">Logout</a>
</div>

<div class="content">
    <h1>Dashboard</h1>
    <p>Use the sidebar to manage different sections of the website.</p>
</div>

</body>
</html>
