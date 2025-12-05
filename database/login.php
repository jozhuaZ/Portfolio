<?php
session_start(); // Start the session at the very beginning

// Establish a connection
include('./connect.php');
$conn = connect();

// Set variables from Sign In form
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if (!$email || !$password) {
    // Redirect to index.php
    $_SESSION['flash_error'] = 'Please fill in all credential fields to proceed.';
    header('Location: ../page/login');
    exit;
}

try {
    // Check if connection is established
    if (is_null($conn)) {
        // Redirect to page/login/index.php
        $_SESSION['flash_error'] = 'Server Error. Please try again later.';
        header('Location: ../page/login');
        exit;
    }

    // Prepare statement to prevent SQL injection
    $query = "SELECT * FROM admin WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    // Bind parameters (s = string)
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Close statement
    $stmt->close();

    // No existing user with the input email
    if (!$user) {
        // Redirect to index.php
        $_SESSION['flash_error'] = 'User not found. Please try again.';
        header('Location: ../page/login');
        exit;
    }

    // Verify if password is matched to stored hash
    if (!password_verify($password, $user['password'])) {
        // Redirect to index.php
        $_SESSION['flash_error'] = 'Incorrect Password.';
        header('Location: ../page/login');
        exit;
    }

    // Set user info on session
    session_regenerate_id(true);
    $_SESSION['email'] = $user['email'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['bio'] = $user['bio'];
    $_SESSION['contact_no'] = $user['contact_no'];
    $_SESSION['first_image'] = $user['first_image'];
    $_SESSION['second_image'] = $user['second_image'];
    $_SESSION['facebook_link'] = $user['facebook_link'];
    $_SESSION['github_link'] = $user['github_link'];
    $_SESSION['is_logged_in'] = true;

    // Close connection
    $conn->close();

    header('Location: ../');
    exit; // Ensure the script stops executing immediately after the header

} catch (Exception $e) {
    // Handle Exception, log the error if necessary
    error_log($e->getMessage());
    $_SESSION['flash_error'] = 'Server Error. Please try again later.';

    // Close connection if it exists
    if ($conn) {
        $conn->close();
    }

    header('Location: ../'); // ERROR 500
    exit;
}
