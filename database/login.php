<?php
session_start();

// establish a connection
include('./connect.php');
$conn = connect();

// set variables from Sign In form
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if (!$email || !$password) {
    // redirect to index.php
    $_SESSION['flash_error'] = 'Please fill in all credential fields to proceed.';
    header('Location: index.php');
    exit;
}

try {
    // check if connection is established
    if (is_null($conn)) {
        // redirect to page/login/index.php
        $_SESSION['flash_error'] = 'Server Error. Please try again later.';
        header('Location: ../page/login');
        exit;
    }

    $query = "SELECT * FROM admin WHERE email = :email LIMIT 1";
    $stmt  = $conn->prepare($query);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // no existing user with the input email
    if (!$user) {
        //redirect to index.php
        $_SESSION['flash_error'] = 'User not found. Please try again.';
        header('Location: ../page/login');
        exit;
    }

    // verify if password is matched to stored hashed (hashed password on database)
    if (!password_verify($password, $user['password'])) {
        // redirect to index.php
        $_SESSION['flash_error'] = 'Incorrect Password.';
        header('Location: ../page/login');
        exit;
    }

    // set user info on session
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

    // redirect to home
    header('Location: ../../index.php');
} catch (PDOException $e) {
    // redirect to index.php
    $_SESSION['flash_error'] = 'Server Error. Please try again later.';
    header('Location: ../index.php'); // ERROR 500  
    exit;
}
