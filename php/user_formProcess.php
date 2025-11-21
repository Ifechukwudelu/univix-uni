<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/auth_check.php';
include_once __DIR__ . '/db_config.php';

$message = "";
$redirectAfter = "";

$user_id = $_SESSION['user_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $form_type = $_POST['form_type'] ?? '';

        // 1. BLOG POST

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

        $sql = "INSERT INTO blog_posts (user_id, image, topic, description, date_posted, posted_by, status)
                VALUES (?, ?, ?, ?, ?, ?, 'pending')
                ON DUPLICATE KEY UPDATE 
                    user_id = VALUES(user_id),
                    image = VALUES(image),
                    topic = VALUES(topic),
                    description = VALUES(description),
                    date_posted = VALUES(date_posted),
                    posted_by = VALUES(posted_by),
                    status = VALUES(status)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssss", $user_id, $imagePath, $topic, $description, $date_posted, $posted_by);

        if ($stmt->execute()) {
            $message = "Blog successfully sent for admin's approval.";
        } else {
            $message = "There was an error, please retry.";
        }
        $stmt->close();

        echo "<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname + '#postBlog');
            }
        </script>";

        return;
    }

        // 2. STAFF VERIFICATION

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

        $sql = "INSERT INTO staff_verification (user_id, staff_image, staff_name, staff_post, staff_quote, staff_category, status)
                VALUES (?, ?, ?, ?, ?, ?, 'pending')
                ON DUPLICATE KEY UPDATE 
                    user_id = VALUES(user_id),
                    staff_image = VALUES(staff_image),
                    staff_name = VALUES(staff_name),
                    staff_post = VALUES(staff_post),
                    staff_quote = VALUES(staff_quote),
                    staff_category = VALUES(staff_category),
                    status = VALUES(status)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssss", $user_id, $staff_imagePath, $staff_name, $staff_position, $staff_quote, $staff_type);

        if ($stmt->execute()) {
            $message = "You have successfully verified, await admin approval.";
        } else {
            $message = "There was an error, please retry.";
        }
        $stmt->close();

        echo "<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname + '#staffVerify');
            }
        </script>";

        return;
    }

        // 3. PROFILE PICTURE UPDATE

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

        $stmt = $conn->prepare("SELECT user_image FROM user_image WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            $message = "Image successfully updated.";
        } else {
            $message = "There was an error while uploading your image.";
        }
        $stmt->close();

        echo "<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname + '#profilePic');
            }
        </script>";

        return;
    }

        // 4. UPDATE PERSONAL DETAILS

    if ($form_type === 'update_details') {

        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $program = $_POST['program'];
        $category = $_POST['category'];

        $stmt = $conn->prepare("UPDATE users SET fullname=?, email=?, phone=?, program=?, category=? WHERE id=?");
        $stmt->bind_param("sssssi", $fullname, $email, $phone, $program, $category, $user_id);

        if ($stmt->execute()) {
            $message = "Hello $fullname, your profile has been updated.";
        } else {
            $message = "There was an error updating your profile.";
        }
        $stmt->close();

        echo "<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname + '#personalDetails');
            }
        </script>";

        return;
    }
    
}
?>