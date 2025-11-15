<?php
session_start();
include_once __DIR__ . '/auth_check.php';
include_once __DIR__ . '/db_config.php';
$message = "";
$redirectAfter = "";

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_type = $_POST['form_type'] ?? '';

    if ($form_type === 'blog_post') {
        $topic = $_POST['topic'];
        $description = $_POST['description'];
        $date_posted = $_POST['date_posted'];
        $posted_by = $_POST['posted_by'];

        $imagePath = null;
        if (!empty($_FILES['image']['name'])) {
            $targetDir = "uploads/";
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            $imagePath = $targetDir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
        }

        $sql = "INSERT INTO blog_posts (image, topic, description, date_posted, posted_by, status)
        VALUES (?, ?, ?, ?, ?, 'pending')
        ON DUPLICATE KEY UPDATE 
            image = VALUES(image),
            topic = VALUES(topic),
            description = VALUES(description),
            date_posted = VALUES(date_posted),
            posted_by = VALUES(posted_by),
            status = VALUES(status)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $imagePath, $topic, $description, $date_posted, $posted_by);
        if ($stmt->execute()) {
        $message = "Blog successfully sent for admin's approval.";
        } else {
        $message = "There was an error while uploading your blog, please retry.";
        }
        $stmt->close();  
    }

    if ($form_type === 'staff_verify') {
        $staff_name = $_POST['staff_name'];
        $staff_position = $_POST['staff_position'];
        $staff_quote = $_POST['staff_quote'];
        $staff_type = $_POST['staff_type'];

        $staff_imagePath = null;
        if (!empty($_FILES['staff_file']['name'])) {
            $targetDir = "uploads/";
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            $staff_imagePath = $targetDir . basename($_FILES["staff_file"]["name"]);
            move_uploaded_file($_FILES["staff_file"]["tmp_name"], $staff_imagePath);
        }
        
        $sql = "INSERT INTO staff_verification (staff_image, staff_name, staff_post, staff_quote, staff_category, status)
        VALUES (?, ?, ?, ?, ?, 'pending')
        ON DUPLICATE KEY UPDATE 
            staff_image = VALUES(staff_image),
            staff_name = VALUES(staff_name),
            staff_post = VALUES(staff_post),
            staff_quote = VALUES(staff_quote),
            staff_category = VALUES(staff_category),
            status = VALUES(status)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $staff_imagePath, $staff_name, $staff_position, $staff_quote, $staff_type);
        if ($stmt->execute()) {
        $message = "You have sucessfully verified, please wait for admin's approval.";
        } else {
        $message = "There was an error while verifying, please retry.";
        }
        $stmt->close();
    }

    if ($form_type === 'profile_picture') {
        $profile_imagePath = null;
        if (!empty($_FILES['user_image']['name'])) {
            $targetDir = "uploads/";
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            
            $profile_imagePath = $targetDir . basename($_FILES["user_image"]["name"]);
            move_uploaded_file($_FILES["user_image"]["tmp_name"], $profile_imagePath);
        }
        
        $sql = "INSERT INTO user_image (user_id, user_image)
                VALUES (?, ?)
                ON DUPLICATE KEY UPDATE user_image = VALUES(user_image)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $user_id, $profile_imagePath);
        $stmt->execute();
        $stmt->close();

        $user_image = null;
        $stmt = $conn->prepare("
            SELECT user_image 
            FROM user_image 
            WHERE user_id = ? 
            ORDER BY id DESC 
            LIMIT 1
            ");
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            
        $message = "Image successfully inserted.";
        $result = $stmt->get_result();
        $image = $result->fetch_assoc()['user_image'];

        } else {
        $message = "There was an error while uploading your image, please retry.";
        }
    }

    if ($form_type === 'update_details') {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $program = $_POST['program'];
        $category = $_POST['category'];

        $stmt = $conn->prepare("UPDATE apply_now SET fullname=?, email=?, phone=?, program=?, category=? WHERE id=?");
        $stmt->bind_param("sssssi", $fullname, $email, $phone, $program, $category, $user_id);
        if ($stmt->execute()) {
        $message = "Hello, $fullname, you have successfully updated you profile data.";
        } else {
        $message = "There was an error while updating your profile details, please retry.";
        }
        $stmt->close();
    }
    }

?>