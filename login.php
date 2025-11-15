<?php
session_start();
include_once __DIR__ . '/php/db_config.php';
$message = "";
$redirectAfter = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']) ?? '';
    $category = $_POST['category'] ?? '';
    
    $sql = "SELECT id, fullname FROM apply_now WHERE email = ? AND category = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $category);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $_SESSION['user_id'] = $user['id'];  
        $_SESSION['logged_in'] = true;

        $loginStmt = $conn->prepare("INSERT INTO login (user_id, email, category) VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE
            user_id = VALUES(user_id),
            email = VALUES(email),
            category = VALUES(category)");

        if ($loginStmt) {
            $loginStmt->bind_param("iss", $user['id'], $email, $category);
            $loginStmt->execute();
            $loginStmt->close();

            $message="Login successful!";
            $redirectAfter = "index.php";
        }
    } else {
        $message="Invalid email or password!";
    }

    $stmt->close();
    $conn->close();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Univix University</title>
    <link rel="icon" type="image/png" href="img/univix_logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">
</head>
<style>
    body {
        font-family: "DM Sans", sans-serif;
    }

    .formfonts {
        font-family: "Playfair Display", serif;
    }
</style>

<body class="font-sans text-gray-800">
    <div class="min-h-screen md:flex">
        <div class="md:w-1/2 h-64 md:h-auto">
            <img src="img/campus.jpeg" alt="Univix University Campus" class="w-full h-[773px] object-cover">
        </div>

        <div class="md:w-1/2 bg-[#800000] text-white flex items-center justify-center p-10">
            <div class="w-full max-w-md">
                <h2 id="form-title" class="text-3xl font-bold mb-6 text-center">Login to Univix</h2>

                <form id="login-form" method="POST" enctype="multipart/form-data" class="space-y-5">
                    <div>
                        <label for="email" class="block mb-2">Email Address</label>
                        <input type="email" id="email" name="email"
                            class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded focus:outline-none focus:ring-1 focus:ring-white"
                            placeholder="example@univix.edu" required>
                    </div>
                    <div>
                        <label for="category" class="block mb-2">Category</label>
                        <select name="category" id="category" name="category"
                            class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded focus:outline-none focus:ring-1 focus:ring-white" required>
                            <option value="" class="text-black">-- Select a Category --</option>
                            <option value="Staff" class="text-black">Staff</option>
                            <option value="Student" class="text-black">Student</option>
                        </select>
                    </div>
                    <button type="submit"
                        class="w-full bg-white text-[#800000] font-semibold py-3 rounded hover:bg-gray-200 transition">Login</button>
                </form>

                <p class="text-center mt-6 text-sm">
                    <span id="toggle-text">Don’t have an account?</span>
                    <a href="applyNow.php">
                        <button id="toggle-btn" class="underline font-semibold">Register</button>
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
    <?php include_once __DIR__ . '/php/messageBox.php';?>

</body>
</html>