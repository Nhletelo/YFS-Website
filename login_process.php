<?php
session_start();
require_once 'db_conn.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize user input
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Check if inputs are not empty
    if (empty($username) || empty($password)) {
        echo "Both fields are required.";
        exit;
    }

    // Prepare SQL query
    $stmt = $conn->prepare("SELECT * FROM app_users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit;
        } else {
            echo "Invalid username/email or password.";
        }
    } else {
        echo "Invalid username/email or password.";
    }

    $stmt->close();
} else {
    header("Location: Login.php");
    exit;
}
?>
