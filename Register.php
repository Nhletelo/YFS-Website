<?php
// Start a session (if needed)
session_start();
require_once 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Youth For Survival</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
        }
        /* Topbar */
        .topbar {
            background: #ff5722;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            height: 50px;
            display: flex;
            align-items: center;
            position: relative;
        }
        .donate-btn {
            background: #000;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 25px;
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-weight: bold;
            transition: background 0.3s ease, transform 0.3s ease;
        }
        .donate-btn:hover {
            background: #333;
            transform: translateY(-50%) scale(1.05);
        }
        /* Header & Navigation */
        header {
            background: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: relative;
            z-index: 10;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: bold;
        }
        .logo img {
            height: 50px;
            width: auto;
        }
        .logo span {
            color: black;
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }
        nav ul li a {
            text-decoration: none;
            color: black;
            transition: color 0.3s;
        }
        nav ul li a.active,
        nav ul li a:hover {
            color: orange;
            font-weight: bold;
        }
        /* Registration Form Section */
        .form-section {
            padding: 60px 20px;
            background-color: #f9f9f9;
        }
        .form-container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #ff5722;
        }
        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #ff5722;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #e65100;
        }
        .form-container p {
            text-align: center;
            margin-top: 15px;
        }
                /* Responsive Navigation */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
            }
            .logo {
                margin-bottom: 10px;
            }
            nav ul {
                flex-direction: column;
                gap: 10px;
            }
            nav ul li a {
                display: block;
                width: 100%;
                padding: 10px 0;
            }
        }
        /* Extra Small Devices */
        @media (max-width: 480px) {
            .logo img {
                height: 40px;
            }
            .logo {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

<!-- Topbar -->
<div class="topbar">
    
    <a href="donate.php" class="donate-btn">Donate Now</a>
</div>

<!-- Navigation -->
<header>
    <div class="logo">
        <img src="images/logo_large.webp" alt="Youth For Survival Logo">
        Youth<span>For Survival</span>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About us</a></li>
            <li><a href="causes.php">Causes</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="news.php">News</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="Register.php" class="active">Register</a></li>
            <li><a href="Login.php">Login</a></li>    
        </ul>
    </nav>
</header>

<!-- Registration Form Section -->
<section class="form-section">
    <div class="form-container">
        <h2>Register</h2>
        <form action="register_process.php" method="POST">
    <input type="text" name="fullname" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email Address" required>
    <input type="text" name="username" placeholder="Username" required>
    
    <select name="role" required style="width: 100%; padding: 12px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc;">
        <option value="">Select Role</option>
        <option value="user">User</option>
        <option value="volunteer">Volunteer</option>
        <option value="admin">Admin</option>
    </select>

    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
    <p>Already have an account? <a href="Login.php">Login here</a></p>
</form>

    </div>
</section>


<!-- Footer -->
<footer>
  
  <?php include('footer.php'); ?>
</footer>

</body>
</html>
