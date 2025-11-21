<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user_id = $_SESSION['user_id'] ?? null;

include_once __DIR__ . '/db_config.php';

$userData = [];

     $stmt = $conn->prepare(
         "SELECT fullname, email, phone, program, category 
          FROM users 
          WHERE id = ? 
           "
     );

     $stmt->bind_param("i", $user_id);
     $stmt->execute();

     $userData = $stmt->get_result()->fetch_assoc();
     $stmt->close(); 
    

?>