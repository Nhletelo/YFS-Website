<?php
// DB connection
$conn = new mysqli("localhost", "root", "", "youth_for_survival");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $image = $_FILES['image'];

    if (!empty($title) && $image['error'] == 0) {
        $targetDir = "uploads/";

        // Create uploads folder if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $imageName = time() . "_" . basename($image['name']);
        $targetFile = $targetDir . $imageName;

        // Debugging: Print the uploaded file info
        echo '<pre>';
        print_r($image);
        echo '</pre>';

        // Check for file size and type
        if ($image['size'] > 5000000) { // 5MB limit
            $message = "File size exceeds 5MB limit.";
        }

        $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
        if (!in_array($image['type'], $allowedTypes)) {
            $message = "Only JPG, PNG, and GIF images are allowed.";
        }

        // If no issues, attempt to move the file
        if (empty($message)) {
            if (move_uploaded_file($image["tmp_name"], $targetFile)) {
                $stmt = $conn->prepare("INSERT INTO gallery (title, image_path) VALUES (?, ?)");
                $stmt->bind_param("ss", $title, $targetFile);
                if ($stmt->execute()) {
                    // Redirect to manage_gallery.php after successful upload
                    header("Location: manage_gallery.php");
                    exit();
                } else {
                    $message = "Database error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $message = "Failed to upload image to " . $targetFile;
            }
        }
    } else {
        // Check if there was an error with the file upload
        if ($image['error'] != 0) {
            $message = "Error code: " . $image['error'];
        } else {
            $message = "Please provide a title and a valid image.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Image - Youth For Survival</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background-color: #f9f9f9; }
        .topbar {
            background: #ff5722;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .donate-btn {
            background: black;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        header {
            background: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        .logo span {
            color: orange;
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
        input[type="file"],
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
    <div>MAIL: info@youthforsurvival.org</div>
    <div>PHONE: +27 12 345 6789</div>
    <a href="donate.php" class="donate-btn">Donate Now</a>
</div>

<!-- Navigation -->
<header>
    <div class="logo">Youth<span>ForSurvival</span></div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About us</a></li>
            <li><a href="causes.php">Causes</a></li>
            <li><a href="gallery.php" class="active">Gallery</a></li>
            <li><a href="news.php">News</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<!-- Add Image Form -->
<div class="container">
    <h2>Add New Image</h2>
    <?php if (!empty($message)) echo '<div class="message">' . htmlspecialchars($message) . '</div>'; ?>

    <form action="add_image.php" method="post" enctype="multipart/form-data">
        <label>Image Title:</label>
        <input type="text" name="title" required>

        <label>Upload Image:</label>
        <input type="file" name="image" accept="image/*" required>

        <button type="submit">Upload</button>
    </form>
</div>

<?php include('footer.php'); ?>
</body>
</html>
