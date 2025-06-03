<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'youth_for_survival');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch news
$news = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Latest News - Youth For Survival</title>
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
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            color: #333;
        }

        .news-item {
            background: white;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }

        .news-item h2 {
            color: #ff5722;
            margin-bottom: 10px;
        }

        .news-item p {
            color: #333;
        }

        .news-item small {
            display: block;
            margin-top: 10px;
            color: gray;
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
            <li><a href="news.php" class="active">News</a></li>
            <li><a href="contact.php">Contact</a></li>
             <li><a href="Register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
                      </ul>
    </nav>
</header>

<!-- News Section -->
<div class="container">
    <h1>Latest News</h1>

    <?php if ($news->num_rows > 0): ?>
        <?php while ($row = $news->fetch_assoc()) : ?>
            <div class="news-item">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
                <small>Posted on: <?php echo date('F j, Y', strtotime($row['created_at'])); ?></small>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align:center;">No news posted yet. Please check back later!</p>
    <?php endif; ?>
</div>

<!-- Footer -->
<?php include('footer.php'); ?>

</body>
</html>
