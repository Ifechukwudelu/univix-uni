<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . '/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fullName = trim($_POST['fullName']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $messag = trim($_POST['message']);

    if (empty($fullName) || empty($email) || empty($subject) || empty($messag)) {
        $_SESSION['connect_message'] = "Please fill out all fields.";
        header("Location: ../connect.php");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['connect_message'] = "Invalid email format.";
        header("Location: ../connect.php");
        exit;
    }

    $connectQuery = "INSERT INTO `connect`(`name`, `email`, `subject`, `message`)
                     VALUES (?, ?, ?, ?)
                     ON DUPLICATE KEY UPDATE
                        name=VALUES(name),
                        email=VALUES(email),
                        subject=VALUES(subject),
                        message=VALUES(message)";

    $stmt = $conn->prepare($connectQuery);
    $stmt->bind_param("ssss", $fullName, $email, $subject, $messag);

    if ($stmt->execute()) {
        $_SESSION['connect_message'] = "Thank you, we received your information.";
        header("Location: ../connect.php");
        exit;
    } else {
        $_SESSION['connect_message'] = "Error submitting form. Please retry.";
        header("Location: ../connect.php");
        exit;
    }
}
?>
