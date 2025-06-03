<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'youth_for_survival');

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Add Cause
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_cause'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Insert new cause into the database
    $stmt = $conn->prepare("INSERT INTO causes (title, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $description);
    $stmt->execute();
    $stmt->close();
    echo "<p>New cause added successfully!</p>";
}

// Handle Edit Cause
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM causes WHERE id = $id");
    $cause = $result->fetch_assoc();
}

// Handle Update Cause
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_cause'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Update cause in the database
    $stmt = $conn->prepare("UPDATE causes SET title = ?, description = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $description, $id);
    $stmt->execute();
    $stmt->close();
    echo "<p>Cause updated successfully!</p>";
}

// Handle Delete Cause
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM causes WHERE id = $id");
    echo "<p>Cause deleted successfully!</p>";
}

// Fetch all causes from the database
$causes = $conn->query("SELECT * FROM causes ORDER BY created_at DESC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Causes - Youth For Survival</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; }
        .btn { padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px; }
        .btn-edit { background-color: #ff9800; }
        .btn-delete { background-color: #f44336; }
        .form-container { margin: 20px 0; }
        textarea { width: 100%; height: 100px; }
    </style>
</head>
<body>

<div class="container">
    <h1>Manage Causes</h1>

    <!-- Add New Cause Form -->
    <div class="form-container">
        <h2>Add New Cause</h2>
        <form method="POST">
            <input type="text" name="title" placeholder="Cause Title" required>
            <textarea name="description" placeholder="Cause Description" required></textarea>
            <button type="submit" name="add_cause" class="btn">Add Cause</button>
        </form>
    </div>

    <!-- Edit Cause Form -->
    <?php if (isset($cause)): ?>
    <div class="form-container">
        <h2>Edit Cause</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $cause['id']; ?>">
            <input type="text" name="title" value="<?php echo $cause['title']; ?>" required>
            <textarea name="description" required><?php echo $cause['description']; ?></textarea>
            <button type="submit" name="update_cause" class="btn">Update Cause</button>
        </form>
    </div>
    <?php endif; ?>

    <!-- Causes Table -->
    <h2>All Causes</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $causes->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td>
                    <a href="?edit=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                    <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this cause?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
