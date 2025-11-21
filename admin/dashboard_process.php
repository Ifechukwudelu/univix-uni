<?php
include_once __DIR__ . '/../php/db_config.php';

$message = "";
$redirectAfter = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //   1. BLOG POSTS

    if (isset($_POST['id']) && isset($_POST['action'])) {

        $id = intval($_POST['id']);
        $action = $_POST['action'];

        if ($action === 'approve') {
            $stmt = $conn->prepare("UPDATE blog_posts SET status='approved' WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $message = "Post has been successfully approved.";

        } elseif ($action === 'delete') {
            $stmt = $conn->prepare("DELETE FROM blog_posts WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $message = "Post has been deleted.";
        }

        echo "<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname + '#posts');
            }
        </script>";

        return;  
    }

    //   2. STAFF
     
    if (isset($_POST['staff_id']) && isset($_POST['staff_action'])) {

        $id = intval($_POST['staff_id']);
        $action = $_POST['staff_action'];

        if ($action === 'approve') {
            $stmt = $conn->prepare("UPDATE staff_verification SET status='approved' WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $message = "Staff has been approved.";

        } elseif ($action === 'delete') {
            $stmt = $conn->prepare("DELETE FROM staff_verification WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $message = "Staff record has been deleted.";
        }

        echo "<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname + '#staff');
            }
        </script>";

        return;
    }

    //  3. DELETE APPLICANT
    
    if (isset($_POST['applicants_id'])) {

        $id = intval($_POST['applicants_id']);

        $delete = $conn->prepare("DELETE FROM users WHERE id = ?");
        $delete->bind_param("i", $id);
        $delete->execute();

        $message = "Applicant record has been deleted.";

        echo "<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname + '#users');
            }
        </script>";

        return;
    }

    //  4. DELETE CONTACT
    
    if (isset($_POST['contact_id'])) {

        $id = intval($_POST['contact_id']);

        $delete = $conn->prepare("DELETE FROM `connect` WHERE id = ?");
        $delete->bind_param("i", $id);
        $delete->execute();

        $message = "Contact record has been deleted.";

        echo "<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname + '#contact');
            }
        </script>";

        return;
    }

    //  5. ADD PROGRAM
     
    if (isset($_POST['form_type']) && $_POST['form_type'] === 'add_program') {

        $title = $_POST['title'];
        $description = $_POST['description'];

        $imagePath = null;

        if (!empty($_FILES['image']['name'])) {

            $targetDir = __DIR__ . "/../uploads/";

            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

            $imagePath = $targetDir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
            $imagePath = 'uploads/' . basename($_FILES["image"]["name"]);
        }

        if (!empty($_FILES['image']['name'])) {

        $stmt = $conn->prepare("
            INSERT INTO programs (title, description, image_url)
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE
                title=VALUES(title),
                description=VALUES(description),
                image_url=VALUES(image_url)
        ");

        $stmt->bind_param("sss", $title, $description, $imagePath);

        if($stmt->execute()){
            $message = "Program added successfully!";
        } else {
            $message = "Error adding program.";
        }
        echo "<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname);
            }
        </script>";
        return;
    }

    //  6. DELETE PROGRAM
    if (isset($_POST['delete_program'])) {

        $id = intval($_POST['delete_program']);
        $conn->query("DELETE FROM programs WHERE id=$id");
        $message = "Program deleted successfully!";
        
        echo "<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname);
            }
        </script>";
        return;
    }
    }
}
?>