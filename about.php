<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - Youth For Survival</title>
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

    header, .topbar {
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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
        z-index: 20;
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
        position: sticky;
        top: 0;
        z-index: 15;
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
    }

    nav ul li a.active {
        color: orange;
        font-weight: bold;
    }

    .about-section {
        padding: 50px 20px;
        max-width: 1000px;
        margin: auto;
    }

    .about-section h2 {
        font-size: 32px;
        margin-bottom: 20px;
        color: #ff5722;
    }

    .about-section p {
        line-height: 1.8;
        margin-bottom: 15px;
    }

    .about-section ul {
        padding-left: 20px;
        margin-bottom: 20px;
    }

    .about-section ul li {
        margin-bottom: 8px;
    }

    .about-details {
        background: #f9f9f9;
        padding: 20px;
        border-left: 5px solid orange;
        margin-top: 30px;
    }

    .about-details strong {
        display: inline-block;
        width: 140px;
    }

    .map-section {
        margin-top: 40px;
        text-align: center;
    }

    .map-section h3 {
        color: #ff5722;
        margin-bottom: 15px;
    }

    iframe {
        max-width: 100%;
        border: 0;
        border-radius: 10px;
    }

    /* Responsive header */
    @media (max-width: 768px) {
        header {
            flex-direction: column;
            align-items: flex-start;
        }

        nav ul {
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
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
            <li><a href="index.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : '' ?>">Home</a></li>
            <li><a href="about.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : '' ?>">About Us</a></li>
            <li><a href="causes.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'causes.php') ? 'active' : '' ?>">Causes</a></li>
            <li><a href="gallery.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'gallery.php') ? 'active' : '' ?>">Gallery</a></li>
            <li><a href="news.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'news.php') ? 'active' : '' ?>">News</a></li>
            <li><a href="contact.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : '' ?>">Contact</a></li> 
              <li><a href="Register.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'news.php') ? 'active' : '' ?>">Register</a></li>
            <li><a href="login.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : '' ?>">Login</a></li>    
        </nav>
</header>

<!-- About Section -->
<section class="about-section">
    <h2>About Youth For Survival (YFS)</h2>
    <p>Youth for Survival (YFS) is a registered Not-For-Profit Organization founded in 2004 and registered in 2007, with a robust national presence across South Africa. Our head office is based in Pretoria, Gauteng, and we extend our reach through branch satellites in:</p>
    <ul>
        <li>Moloto North, Mpumalanga</li>
        <li>Maboloka, North West</li>
        <li>Nongoma, KwaZulu-Natal</li>
        <li>Port St. Johns, Eastern Cape</li>
    </ul>
    <p>YFS is committed to addressing the urgent challenges of GBV, social inequality, and economic hardship disadvantaged communities face. Our focus is on empowering women, children, and youth by providing comprehensive support systems that foster sustainable change.</p>

    <h3>Our Core Initiatives:</h3>
    <ul>
        <li><strong>Safe Houses:</strong> Secure shelters and holistic care for GBV survivors.</li>
        <li><strong>Nutritional Support:</strong> Daily soup kitchens and food distribution.</li>
        <li><strong>Skills Training:</strong> Capacity-building workshops for unemployed youth.</li>
        <li><strong>Community Development:</strong> Resources and social support for households in need.</li>
    </ul>

    <p>At our Advice Centre, we offer counseling and guidance to help individuals overcome personal and social challenges. Through these programs, YFS is committed to uplifting marginalized communities and improving their quality of life holistically.</p>

    <div class="about-details">
        <p><strong>Phone:</strong> 012 304 0001</p>
        <p><strong>Industry:</strong> Non-Profit Organizations</p>
        <p><strong>Company Size:</strong> 11–50 employees</p>
        <p><strong>Headquarters:</strong> City of Tshwane, Gauteng</p>
        <p><strong>Founded:</strong> 2005</p>
    </div>

    <div class="map-section">
        <h3>Our Location</h3>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3593.7833450713233!2d28.170881874358656!3d-25.74467737736258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e956273cb23062b%3A0x1637a7a3751ce844!2syouth%20for%20survival!5e0!3m2!1sen!2sza!4v1745588204500!5m2!1sen!2sza" width="600" height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<?php include('footer.php'); ?>

</body>
</html>
