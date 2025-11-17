<?php
session_start();
include_once __DIR__ . '/../else/if.php';

$message = "";
$redirectAfter = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email === $default_email && $password === $default_password) {
        $_SESSION['admin_logged_in'] = true;
        $message = "Login successful! Redirecting...";
        $redirectAfter = "dashboard.php";

    } else {
        $message = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="icon" type="image/png" href="../img/univix_logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold text-center text-[#800000] mb-6">Admin Login</h2>

        <form method="POST" class="space-y-5">
            <div>
                <label class="font-semibold">Email</label>
                <input type="email" name="email"
                    class="w-full px-4 py-3 border rounded focus:ring-2 focus:ring-[#800000]" required>
            </div>

            <div>
                <label class="font-semibold">Password</label>
                <input type="password" name="password"
                    class="w-full px-4 py-3 border rounded focus:ring-2 focus:ring-[#800000]" required>
            </div>

            <button class="w-full bg-[#800000] text-white py-3 rounded hover:bg-[#a12d2d] transition">
                Sign In
            </button>
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/../php/messageBox.php';?>
</body>
</html>