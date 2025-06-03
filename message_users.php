<?php
include "db_conn.php";

// Handle form submission
if (isset($_POST['send_message'])) {
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO messages (sender_id, receiver_id, message) 
            VALUES ('$sender_id', '$receiver_id', '$message')";
    mysqli_query($conn, $sql);
    header("Location: message_users.php?success=Message sent");
}

// Fetch users for dropdown
$users = mysqli_query($conn, "SELECT user_id, username FROM app_users");

// Fetch messages
$messages = mysqli_query($conn, "SELECT m.*, s.username AS sender_name, r.username AS receiver_name
                                 FROM messages m
                                 JOIN app_users s ON m.sender_id = s.user_id
                                 JOIN app_users r ON m.receiver_id = r.user_id
                                 ORDER BY m.sent_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Send Message to User</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        form { margin-bottom: 30px; }
        textarea { width: 100%; height: 80px; }
        select, button, textarea { margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
    </style>
</head>
<body>

<h2>Send a Message</h2>

<?php if (isset($_GET['success'])): ?>
    <p style="color: green;"><?php echo $_GET['success']; ?></p>
<?php endif; ?>

<form method="POST" action="message_users.php">
    <label>Sender:</label><br>
    <select name="sender_id" required>
        <option value="">-- Select Sender --</option>
        <?php while ($user = mysqli_fetch_assoc($users)): ?>
            <option value="<?= $user['user_id'] ?>"><?= htmlspecialchars($user['username']) ?></option>
        <?php endwhile; ?>
    </select><br>

    <?php mysqli_data_seek($users, 0); // Reset pointer to reuse the same result ?>

    <label>Receiver:</label><br>
    <select name="receiver_id" required>
        <option value="">-- Select Receiver --</option>
        <?php while ($user = mysqli_fetch_assoc($users)): ?>
            <option value="<?= $user['user_id'] ?>"><?= htmlspecialchars($user['username']) ?></option>
        <?php endwhile; ?>
    </select><br>

    <label>Message:</label><br>
    <textarea name="message" required></textarea><br>

    <button type="submit" name="send_message">Send Message</button>
</form>

<h2>All Messages</h2>

<table>
    <thead>
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Message</th>
            <th>Sent At</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($msg = mysqli_fetch_assoc($messages)): ?>
            <tr>
                <td><?= htmlspecialchars($msg['sender_name']) ?></td>
                <td><?= htmlspecialchars($msg['receiver_name']) ?></td>
                <td><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
                <td><?= $msg['sent_at'] ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
