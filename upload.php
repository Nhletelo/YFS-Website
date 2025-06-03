<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'youth_for_survival');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to display upload form again
function showUploadForm() {
    echo '
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label>Select image to upload:</label><br>
            <input type="file" name="image" required><br><br>
            <input type="text" name="caption" placeholder="Enter caption"><br><br>
            <input type="submit" name="submit" value="Upload">
        </form>
    ';
}

// Handle form submission
if (isset($_POST['submit'])) {
    $caption = $conn->real_escape_string($_POST['caption']);

    $targetDir = "uploads/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . uniqid() . "_" . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif', 'webp');

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $sql = "INSERT INTO gallery (image_path, caption) VALUES ('$targetFilePath', '$caption')";
            if ($conn->query($sql) === TRUE) {
                // Show success message with Yes/No option
                echo "<p>Image uploaded successfully.</p>";
                echo '
                    <form method="post">
                        <p>Do you want to upload another image?</p>
                        <button type="submit" name="again" value="yes">Yes</button>
                        <button type="submit" name="again" value="no">No</button>
                    </form>
                ';
                exit;
            } else {
                echo "Database error: " . $conn->error;
            }
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo "Invalid file type.";
    }
}

// Handle Yes/No option after upload
if (isset($_POST['again'])) {
    if ($_POST['again'] === 'yes') {
        showUploadForm(); // Show form again
    } else {
        header("Location: admin_dashboard.php"); // Redirect to dashboard
        exit;
    }
}

// If no form was submitted, show the initial form
if (!isset($_POST['submit']) && !isset($_POST['again'])) {
    showUploadForm();
}
?>
