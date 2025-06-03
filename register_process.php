<?php
session_start();
require_once 'db_conn.php'; // Make sure db_conn.php is included correctly

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect and sanitize user input
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validate inputs
    if (empty($fullname) || empty($email) || empty($username) || empty($password) || empty($role)) {
        die("All fields are required.");
    }

    // Check if email or username already exists
    $stmt = $conn->prepare("SELECT * FROM app_users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "Email or Username already taken. Please use another.";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $stmt = $conn->prepare("INSERT INTO app_users (fullname, email, username, password, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fullname, $email, $username, $hashedPassword, $role);

    if ($stmt->execute()) {
        // Success: Redirect to login page after registration
        echo "<script>alert('Registration successful! Welcome to Youth For Survival. Redirecting to login...'); window.location.href='Login.php';</script>";
    } else {
        echo "Error occurred: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    header("Location: Register.php");
    exit;
}
?>
