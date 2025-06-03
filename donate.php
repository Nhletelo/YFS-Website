<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Youth For Survival - Donate</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            line-height: 1.6;
        }

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

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .container h2 {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        select,
        button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            background-color: orange;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #e65100;
        }

        .message {
            margin-top: 10px;
            padding: 10px;
            color: green;
        }

        .error {
            color: red;
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
        <span>Youth For Survival</span>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About us</a></li>
            <li><a href="causes.php">Causes</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="news.php">News</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<!-- Donation Form -->
<div class="container">
    <h2>Make a Donation</h2>
    <?php if (!empty($message)) echo '<div class="message">' . htmlspecialchars($message) . '</div>'; ?>

    <form action="donate.php" method="post">
        <label>Your Name:</label>
        <input type="text" name="name" required>

        <label>Your Email:</label>
        <input type="email" name="email" required>

        <label>Donation Amount (in ZAR):</label>
        <input type="number" name="amount" required min="1" step="0.01">

        <label>Payment Method:</label>
        <select name="payment_method" required>
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
            <option value="bank_transfer">Bank Transfer</option>
        </select>

        <button type="submit">Donate</button>
    </form>
</div>

<?php include('footer.php'); ?>

</body>
</html>
