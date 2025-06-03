<?php
// edit_image.php
$conn = new mysqli("localhost", "root", "", "youth_for_survival");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['id'])) {
    echo "No image selected.";
    exit;
}

$id = $_GET['id'];
$message = "";

// Fetch existing data
$stmt = $conn->prepare("SELECT * FROM gallery WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Image not found.";
    exit;
}

$imageData = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $targetFile = $imageData['image_path'];

    // Image replacement
    if ($_FILES['image']['error'] == 0) {
        $targetDir = "uploads/";
        $newImageName = time() . "_" . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $newImageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
    }

    $update = $conn->prepare("UPDATE gallery SET title = ?, image_path = ? WHERE id = ?");
    $update->bind_param("ssi", $title, $targetFile, $id);

    if ($update->execute()) {
        $message = "Image updated successfully!";
        $imageData['title'] = $title;
        $imageData['image_path'] = $targetFile;
    } else {
        $message = "Update failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Image</title>
</head>
<body>
    <h2>Edit Image</h2>
    <?php if ($message) echo "<p>$message</p>"; ?>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($imageData['title']); ?>" required><br>

        <label>Current Image:</label><br>
        <img src="<?php echo $imageData['image_path']; ?>" alt="" width="200"><br>

        <label>New Image (optional):</label>
        <input type="file" name="image"><br>

        <button type="submit">Update</button>
    </form>
    <p><a href="manage_gallery.php">Back to Gallery</a></p>
</body>
</html>

<?php
// delete_image.php
if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit;
}

$id = $_GET['id'];

// Get image path first
$stmt = $conn->prepare("SELECT image_path FROM gallery WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imagePath = $row['image_path'];

    // Delete image from server
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    // Delete from DB
    $delete = $conn->prepare("DELETE FROM gallery WHERE id = ?");
    $delete->bind_param("i", $id);
    $delete->execute();
}

header("Location: manage_gallery.php");
exit;
?>
