<?php
include "db_conn.php";

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM app_users WHERE user_id=$id");
    header("Location: manage_users.php");
}

// Handle insert
if (isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    mysqli_query($conn, "INSERT INTO app_users (username, email, role) VALUES ('$username', '$email', '$role')");
    header("Location: manage_users.php");
}

// Handle update
if (isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    mysqli_query($conn, "UPDATE app_users SET username='$username', email='$email', role='$role' WHERE user_id=$user_id");
    header("Location: manage_users.php");
}

// Get users
$users = mysqli_query($conn, "SELECT * FROM app_users ORDER BY created_at DESC");

// Editing
$edit = false;
if (isset($_GET['edit'])) {
    $edit = true;
    $user_id = $_GET['edit'];
    $edit_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM app_users WHERE user_id=$user_id"));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage App Users</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        form { margin-top: 20px; }
        input[type="text"], input[type="email"] { width: 200px; padding: 5px; margin-right: 10px; }
        .actions a { margin-right: 10px; }
    </style>
</head>
<body>

<h2>App Users Management</h2>

<form method="POST">
    <?php if ($edit): ?>
        <input type="hidden" name="user_id" value="<?php echo $edit_data['user_id']; ?>">
        <input type="text" name="username" value="<?php echo $edit_data['username']; ?>" required>
        <input type="email" name="email" value="<?php echo $edit_data['email']; ?>" required>
        <input type="text" name="role" value="<?php echo $edit_data['role']; ?>">
        <button type="submit" name="update_user">Update User</button>
    <?php else: ?>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="role" placeholder="Role">
        <button type="submit" name="add_user">Add User</button>
    <?php endif; ?>
</form>

<table>
    <thead>
        <tr>
            <th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Created At</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($users)): ?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['role']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td class="actions">
                    <a href="?edit=<?php echo $row['user_id']; ?>">Edit</a>
                    <a href="?delete=<?php echo $row['user_id']; ?>" onclick="return confirm('Delete this user?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
