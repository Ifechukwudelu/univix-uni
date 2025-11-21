<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
?>
<?php
include_once __DIR__ . '/dashboard_process.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard | Univix University</title>
    <link rel="icon" type="image/png" href="../img/univix_logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gray-100 font-sans">

    <nav class="bg-white shadow-md fixed w-full top-0 z-30 border-b">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-[#800000]">Univix <span class="text-gray-800">Admin Panel</span></h1>
            <button id="sidebarToggle" class="md:hidden text-gray-700">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </nav>

    <aside id="sidebar"
        class="bg-[#800000] text-white w-64 h-screen fixed top-0 left-0 pt-20 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-20 shadow-lg">
        <div class="p-6 space-y-4">
            <h2 class="text-lg font-semibold mb-4 border-b border-white/30 pb-2">Dashboard</h2>
            <ul class="space-y-3">
                <li><button onclick="showSection('overview')" class="w-full text-left hover:text-yellow-300">Overview</button></li>
                <li><button onclick="showSection('posts')" class="w-full text-left hover:text-yellow-300">Posts</button></li>
                <li><button onclick="showSection('programs')" class="w-full text-left hover:text-yellow-300">Programs</button></li>
                <li><button onclick="showSection('staff')" class="w-full text-left hover:text-yellow-300">Staff</button></li>
                <li><button onclick="showSection('users')" class="w-full text-left hover:text-yellow-300">Users</button></li>
                <li><button onclick="showSection('contact')" class="w-full text-left hover:text-yellow-300">Contact</button></li>
                <li><a href="logout.php" class="text-blue-300 font-semibold">Logout</a></li>
            </ul>
        </div>
    </aside>

    <div id="overlay" class="hidden fixed inset-0 bg-black bg-opacity-40 z-10 md:hidden"></div>

    <main class="pt-24 md:pl-64 p-6 transition-all">
        <div class="max-w-6xl mx-auto bg-white rounded-lg p-8 shadow-md">

            <h1 class="text-3xl font-bold text-[#800000] mb-5">Welcome, Ife 👋</h1>
            <hr class="border-1 border-gray-200 mb-2">
            
            <?php include_once __DIR__ . '/overview.php';?>
            <?php include_once __DIR__ . '/posts.php';?>
            <?php include_once __DIR__ . '/programs.php';?>
            <?php include_once __DIR__ . '/staff.php';?>
            <?php include_once __DIR__ . '/users.php';?>
            <?php include_once __DIR__ . '/contactList.php';?>

        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
           
            lucide.createIcons();

        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('overlay');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        

        window.showSection = function (id) {
            document.querySelectorAll('.admin-section').forEach(sec => sec.classList.add('hidden'));
            document.getElementById(id).classList.remove('hidden');
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        };

        window.logout = function () {
            alert('Logging out...');
        };
        })
    </script>
    <?php include_once __DIR__ . '/../php/messageBox.php';?>

</body>
</html>
