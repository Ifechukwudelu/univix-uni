
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Univix University | Profile</title>
<link rel="icon" type="image/png" href="img/univix_logo.png">
<script src="https://unpkg.com/lucide@latest"></script>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
<nav class="bg-white text-[#800000] shadow-md fixed w-full top-0 z-30">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="index.php" class="text-xl font-bold flex items-center gap-2">
            <img src="img/univix_logo.png" class="w-8 h-8" alt="logo">
            Univix University
        </a>

        <ul class="hidden md:flex space-x-6 text-gray-700">
            <li class="hover:text-[#660000]"><a href="index.php">Home</a></li>
            <li class="hover:text-[#660000]"><a href="about.php">About</a></li>
            <li class="hover:text-[#660000]"><a href="programs.php">Programs</a></li>
            <li class="hover:text-[#660000]"><a href="workers.php">Our Staffs</a></li>
            <li class="hover:text-[#660000]"><a href="blog.php">Blog</a></li>
            <li class="hover:text-[#660000]"><a href="connect.php">Contact</a></li>
        </ul>

        <!-- widescreen profile icon -->
        <div class="hidden md:flex items-center gap-3">
            <button id="sidebarToggleDesktop" class="p-1"><i data-lucide="user" class="w-6 h-6"></i></button>
        </div>

        <!-- smallscreen profile icon -->
        <div class="flex md:hidden items-center space-x-4">
            <button id="menuToggle" class="p-1"><i data-lucide="menu" class="w-6 h-6"></i></button>
            <button id="sidebarToggleMobile" class="p-1"><i data-lucide="user" class="w-6 h-6"></i></button>
        </div>
    </div>

    <div id="mobileMenu" class="max-h-0 overflow-hidden opacity-0 pointer-events-none transform transition-all duration-300 bg-[#660000] text-white md:hidden">
        <ul class="flex flex-col py-4 px-6 space-y-4">
            <li><a href="index.php" class="hover:text-gray-300">Home</a></li>
            <li><a href="about.php" class="hover:text-gray-300">About</a></li>
            <li><a href="programs.php" class="hover:text-gray-300">Programs</a></li>
            <li><a href="workers.php" class="hover:text-gray-300">Our Staffs</a></li>
            <li><a href="blog.php" class="hover:text-gray-300">Blog</a></li>
            <li><a href="connect.php" class="hover:text-gray-300">Contact</a></li>
        </ul>
    </div>
</nav>