<?php
session_start();
require_once('config.php');

// Validate request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    exit('Method Not Allowed');
}

// Validate presence of expected POST fields
if (!isset($_POST['username'], $_POST['password'], $_POST['csrf_token'])) {
    http_response_code(400); // Bad Request
    exit('Missing required fields');
}

// CSRF token check
if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    http_response_code(403); // Forbidden
    exit('Invalid CSRF token');
}

// Sanitize inputs
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
$password = $_POST['password']; // Don't sanitize password - use as-is for hashing

// Basic empty check
if (empty($username) || empty($password)) {
    http_response_code(400); // Bad Request
    exit('Username and password are required.');
}

try {
    // Prepare and execute query
    $sql = "SELECT id, email, password FROM users WHERE email = ? LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->execute([$username]);

    // Check user record
    if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if (password_verify($password, $user['password'])) {
            // Regenerate session ID to prevent fixation
            session_regenerate_id(true);

            // Store only essential data in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];

            http_response_code(200); // OK
            echo '1';
        } else {
            http_response_code(401); // Unauthorized
            echo 'Incorrect username or password.';
        }
    } else {
        http_response_code(401); // Unauthorized
        echo 'Incorrect username or password.';
    }

} catch (PDOException $e) {
    // Log actual error internally but return generic message
    error_log('Login Error: ' . $e->getMessage());
    http_response_code(500); // Internal Server Error
    echo 'An internal error occurred. Please try again later.';
}