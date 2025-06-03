<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'youth_for_survival');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all images from the gallery table
$images = $conn->query("SELECT * FROM gallery ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery - Youth For Survival</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
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

        /* Header */
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

        /* Gallery Section */
        .gallery {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .gallery img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s ease;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }

        .gallery img:hover {
            transform: scale(1.05);
        }

        .page-title {
            text-align: center;
            margin: 40px 0 20px;
            font-size: 32px;
            color: #333;
        }

        /* Responsive header */
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

            nav ul li {
                width: 100%;
            }

            nav ul li a {
                display: block;
                width: 100%;
                padding: 10px 0;
            }
        }
        
        /* Extra small devices */
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
            <li><a href="gallery.php" class="active">Gallery</a></li>
            <li><a href="news.php">News</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="Register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>            
        </ul>
    </nav>
</header>

<!-- Gallery Section -->
<h2 class="page-title">Our Gallery</h2>

<div class="gallery">
    <?php if ($images->num_rows > 0): ?>
        <?php while ($row = $images->fetch_assoc()) : ?>
            <img 
                src="<?php echo htmlspecialchars($row['image_path']); ?>" 
                alt="<?php echo htmlspecialchars(!empty($row['caption']) ? $row['caption'] : 'Gallery Image'); ?>"
            >
        <?php endwhile; ?>
    <?php else: ?>
        <p style="grid-column: 1 / -1; text-align: center;">No images uploaded yet. Please check back soon!</p>
    <?php endif; ?>
</div>

<!-- Footer -->
<?php include('footer.php'); ?>

</body>
</html>
