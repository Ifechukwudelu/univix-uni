<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
      
    $message = "";
    $redirectAfter = "";
    $full_name = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $program = trim($_POST['program']);
    $category = $_POST['category'] ?? '';
    $messag = trim($_POST['message']);

    
    $query = "INSERT INTO users (fullname, email, phone, program, category) 
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $full_name, $email, $phone, $program, $category);
    
    if ($stmt->execute()) {

        $user_id = $conn->insert_id;

        $_SESSION['user_id'] = $user_id;

        $apply = "INSERT INTO apply_now (user_id, fullname, email, phone, program, category, message)
                  VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt2 = $conn->prepare($apply);
        $stmt2->bind_param("issssss", $user_id, $full_name, $email, $phone, $program, $category, $messag);
        $stmt2->execute();
        $stmt2->close();

        $_SESSION['register_message'] = "You have successfully registered.";
        header("Location: ../applyNow.php");
        exit;

    } else {
        $_SESSION['register_message'] = "Error submitting form. Please retry.";
        header("Location: ../applyNow.php");
        exit;
    }
      $stmt->close();
    $conn->close();
}
?>
