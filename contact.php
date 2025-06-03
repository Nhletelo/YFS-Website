<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Youth For Survival - Contact Us</title>
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

        .contact-section {
            padding: 50px 20px;
            max-width: 800px;
            margin: auto;
        }

        .contact-section h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
        }

        .contact-info p {
            margin: 10px 0;
            font-size: 16px;
        }

        .contact-info a {
            color: #ff5722;
            text-decoration: none;
        }

        form {
            margin-top: 30px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin-top: 15px;
            padding: 12px 25px;
            background-color: #ff5722;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #e64a19;
        }

        .hero {
            background: url('assets/images/hero.jpg') center center/cover no-repeat;
            height: 90vh;
            color: white;
            position: relative;
            display: flex;
            align-items: center;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            width: 100%;
            padding: 50px 20px;
        }

        .hero-content {
            max-width: 700px;
            margin: auto;
            text-align: center;
        }

        .hero-content h1 {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .hero-content span {
            color: orange;
        }

        .hero-content p {
            margin: 15px 0;
            font-size: 18px;
        }

        .hero-content img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }

        .btn {
            padding: 12px 24px;
            display: inline-block;
            margin: 10px 5px 0;
            border-radius: 5px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn.primary {
            background: orange;
            color: white;
        }

        .btn.primary:hover {
            background: darkorange;
        }

        .btn.secondary {
            border: 2px solid white;
            color: white;
        }

        .btn.secondary:hover {
            background: white;
            color: orange;
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

            .hero {
                height: auto;
                padding: 50px 0;
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

            .hero-content h1 {
                font-size: 32px;
            }

            .hero-content p {
                font-size: 16px;
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
            <li><a href="contact.php" class="active">Contact</a></li>
            <li><a href="Register.php">Register</a></li> 
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
</header>

<!-- Contact Section -->
<section class="contact-section">
    <h2>Contact Youth For Survival</h2>
    
    <div class="contact-info">
        <p><strong>Email:</strong> <a href="mailto:youthforsurvival2007@gmail.com">youthforsurvival2007@gmail.com</a></p>
        <p><strong>LinkedIn:</strong> <a href="https://www.linkedin.com/company/youth-for-survival-south-africa" target="_blank">Youth for Survival on LinkedIn</a></p>
        <p><strong>Address:</strong> Pretoria, Gauteng, South Africa</p>
    </div>

    <form action="#" method="post">
        <input type="text" name="name" placeholder="Your Full Name" required>
        <input type="email" name="email" placeholder="Your Email Address" required>
        <textarea name="message" rows="5" placeholder="Your Message..." required></textarea>
        <button type="submit">Send Message</button>
    </form>
</section>

<!-- Footer -->
<?php include('footer.php'); ?>

</body>
</html>
