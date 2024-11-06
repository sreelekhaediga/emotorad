<?php
session_start();

// Database credentials
$host = 'localhost';
$dbname = 'user_auth';
$username = 'root';  // Adjust as per your database settings
$password = '';      // Adjust as per your database settings

// Get form data
$email = $_POST['email'];
$passwordInput = $_POST['password'];

// Connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare SQL statement
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && hash("sha256", $passwordInput) == $user['password']) {
        // Password matches, login successful
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header("Location: dashboard.html");  // Redirect to dashboard
        exit;
    } else {
        // Invalid login
        header("Location: login.html?error=Invalid credentials");
        exit;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>