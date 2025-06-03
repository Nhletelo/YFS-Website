<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'youth_for_survival');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Add News
if (isset($_POST['add_news'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO news (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();
    header("Location: manage_news.php");
    exit;
}

// Handle Edit News
if (isset($_POST['edit_news'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE news SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();
    header("Location: manage_news.php");
    exit;
}

// Handle Delete News
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM news WHERE id = $id");
    header("Location: manage_news.php");
    exit;
}

// Fetch all news
$news = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage News - Admin</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f4f4; }
        .container { max-width: 1200px; margin: 40px auto; padding: 20px; }
        h1 { text-align: center; margin-bottom: 40px; }
        form { background: white; padding: 20px; margin-bottom: 40px; border-radius: 10px; box-shadow: 0 3px 6px rgba(0,0,0,0.1); }
        input[type="text"], textarea {
            width: 100%; padding: 10px; margin-bottom: 10px;
            border: 1px solid #ccc; border-radius: 5px;
        }
        button {
            background: #ff5722; color: white;
            padding: 10px 20px; border: none; border-radius: 5px;
            cursor: pointer;
        }
        .news-item {
            background: white;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
            position: relative;
        }
        .news-item a {
            position: absolute; top: 20px; right: 20px;
            background: red; color: white;
            padding: 5px 10px; border-radius: 5px;
            text-decoration: none;
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Manage News</h1>

    <!-- Add News Form -->
    <form action="manage_news.php" method="post">
        <h2>Add New News</h2>
        <input type="text" name="title" placeholder="News Title" required>
        <textarea name="content" rows="5" placeholder="News Content" required></textarea>
        <button type="submit" name="add_news">Post News</button>
    </form>

    <!-- News List -->
    <?php while ($row = $news->fetch_assoc()) : ?>
        <div class="news-item">
            <form action="manage_news.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>
                <textarea name="content" rows="4" required><?php echo htmlspecialchars($row['content']); ?></textarea>
                <button type="submit" name="edit_news">Update</button>
                <a href="manage_news.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this news?')">Delete</a>
            </form>
        </div>
    <?php endwhile; ?>

</div>

</body>
</html>
