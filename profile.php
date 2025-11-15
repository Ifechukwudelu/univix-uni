<?php
include_once __DIR__ . '/php/user_formProcess.php';
include_once __DIR__ . '/php/user_profileDetails.php';


?>

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
        <a href="index.php" class="text-xl font-bold">Univix University</a>

        <ul class="hidden md:flex space-x-8">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="programs.php">Programs</a></li>
            <li><a href="workers.php">Our Staffs</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="connect.php">Contact</a></li>
        </ul>

        <div class="hidden md:flex items-center">
            <button id="sidebarToggleDesktop"><i data-lucide="circle-user-round" class="w-6 h-6"></i></button>
        </div>

        <div class="flex md:hidden items-center space-x-4">
            <button id="menuToggle"><i data-lucide="menu" class="w-6 h-6"></i></button>
            <button id="sidebarToggleMobile"><i data-lucide="circle-user-round" class="w-6 h-6"></i></button>
        </div>
    </div>

    <div id="mobileMenu" class="hidden bg-[#660000] text-white md:hidden">
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

<div id="overlay" class="hidden fixed inset-0 bg-black bg-opacity-60 z-40"></div>

<section class="pt-24 max-w-7xl mx-auto px-6 flex flex-col md:flex-row gap-8 relative">

    <aside id="sidebar" class="bg-[#800000] text-white w-64 md:w-1/4 p-6 space-y-6 shadow-lg fixed md:static top-20 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-500 z-50 rounded-lg">
        <h2 class="text-xl font-semibold mb-4">My Dashboard</h2>
        <ul class="space-y-4">
            <li><button onclick="showSection('profilePic')" class="w-full text-left hover:text-yellow-300">Profile Picture</button></li>
            <li><button onclick="showSection('personalDetails')" class="w-full text-left hover:text-yellow-300">Personal Details</button></li>
            <li><button onclick="showSection('postBlog')" class="w-full text-left hover:text-yellow-300">Post on Blog</button></li>
            <li><button onclick="showSection('staffVerify')" class="w-full text-left hover:text-yellow-300">If staff, verify</button></li>
            <li>            
               <form action="logout.php" method="POST">
                   <button type="submit" class="px-3 py-2 bg-red-600 text-white rounded">Log out</button>
               </form>
            </li>
        </ul>
    </aside>

    <div class="bg-white w-full md:w-3/4 rounded-lg p-8 shadow-lg md:ml-auto">

        <div class="mb-8 border-b pb-4">
            <h1 class="text-3xl font-bold text-[#800000]">Welcome back, <span class="text-gray-800"><?= htmlspecialchars($result['fullname'] ?? '')?> 👋</span></h1>
            <p class="text-gray-600 mt-2">Manage your profile, share your thoughts, or verify your staff status below.</p>
        </div>

        <div id="profilePic" class="profile-section">
            <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="form_type" value="profile_picture">
            <h2 class="text-2xl font-semibold text-[#800000] mb-6">Profile Picture</h2>
            <div class="flex flex-col items-center gap-4">
                <?php if (!empty($image)): ?>
                    <img src="<?= htmlspecialchars($image)?>" alt="Profile" class="w-32 h-32 rounded-full border-4 border-[#800000] object-cover">
                <?php else: ?>
                    <img src="img/default.jpeg" alt="Profile" class="w-32 h-32 rounded-full border-4 border-[#800000] object-cover">
                <?php endif; ?>
                <input type="file" name="user_image" class="border p-2 w-full md:w-64">
                <button type="submit" class="bg-[#800000] text-white px-6 py-2 rounded hover:bg-[#a30000]">Upload</button>
            </div>
            </form>
        </div>

        <div id="personalDetails" class="profile-section hidden">
            <h2 class="text-2xl font-semibold text-[#800000] mb-6 flex justify-between items-center">
                Personal Details
                <button id="editDetailsBtn" class="bg-yellow-500 text-white px-4 py-1 rounded hover:bg-yellow-600">Update</button>
            </h2>
            <div class="grid grid-cols-1 gap-4 md:w-3/4">
                <input type="text" value="<?= htmlspecialchars($result['fullname'] ?? '')?>" class="border p-2 rounded w-full bg-gray-100" readonly>
                <input type="email" value="<?= htmlspecialchars($result['email'] ?? '')?>" class="border p-2 rounded w-full bg-gray-100" readonly>
                <input type="text" value="<?= htmlspecialchars($result['phone'] ?? '')?>" class="border p-2 rounded w-full bg-gray-100" readonly>
                <input type="text" value="<?= htmlspecialchars($result['program'] ?? '')?>" class="border p-2 rounded w-full bg-gray-100" readonly>
                <input type="text" value="<?= htmlspecialchars($result['category'] ?? '')?>" class="border p-2 rounded w-full bg-gray-100" readonly>
            </div>
        </div>

        <div id="postBlog" class="profile-section hidden">
            <h2 class="text-2xl font-semibold text-[#800000] mb-4">Post on Blog</h2>
            <form method="POST" enctype="multipart/form-data" class="space-y-4">
                <input type="hidden" name="form_type" value="blog_post">
                <input type="file" name="image" class="border p-2 w-full" required>
                <input type="text" name="topic" placeholder="Topic" class="border p-2 w-full" required>
                <textarea name="description" placeholder="Description" class="border p-2 w-full" required></textarea>
                <input type="date" name="date_posted" class="border p-2 w-full" required>
                <input type="text" name="posted_by" placeholder="Posted by" class="border p-2 w-full" required>
                <button type="submit" class="bg-[#800000] text-white px-6 py-2 rounded hover:bg-[#a30000]">Post</button>
            </form>
        </div>

        <div id="staffVerify" class="profile-section hidden">
            <h2 class="text-2xl font-semibold text-[#800000] mb-4">Staff Verification</h2>
            <form method="POST" enctype="multipart/form-data" class="space-y-4">
                <input type="hidden" name="form_type" value="staff_verify">
                <input type="file" class="border p-2 w-full" name="staff_file" required>
                <input type="text" placeholder="Full Name" class="border p-2 w-full" name="staff_name" required>
                <input type="text" placeholder="Position" class="border p-2 w-full" name="staff_position" required>
                <textarea placeholder="Quote" class="border p-2 w-full" name="staff_quote" required></textarea>
                <select class="border p-2 w-full" name="staff_type" required>
                    <option value="">Select Staff Type</option>
                    <option value="University Leadership">University Leadership</option>
                    <option value="Academic Staff">Academic Staff</option>
                    <option value="Non-Academic Staff">Non-Academic Staff</option>
                </select>
                <button type="submit" class="bg-[#800000] text-white px-6 py-2 rounded hover:bg-[#a30000]">Verify</button>
            </form>
        </div>

    </div>
</section>

<div id="updateModal" class="hidden fixed inset-0 bg-black bg-opacity-70 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-8 w-full max-w-md">
        <h2 class="text-xl font-semibold text-[#800000] mb-4">Update Personal Details</h2>
        <form id="updateForm" method="POST" class="space-y-4">
            <input type="hidden" name="form_type" value="update_details">
            <input type="text" name="fullname" value="<?= htmlspecialchars($result['fullname'] ?? '')?>" class="border p-2 w-full rounded" required>
            <input type="email" name="email" value="<?= htmlspecialchars($result['email'] ?? '')?>" class="border p-2 w-full rounded" required>
            <input type="text" name="phone" value="<?= htmlspecialchars($result['phone'] ?? '')?>" class="border p-2 w-full rounded" required>
            <input type="text" name="program" value="<?= htmlspecialchars($result['program'] ?? '')?>" class="border p-2 w-full rounded" required>
            <input type="text" name="category" value="<?= htmlspecialchars($result['category'] ?? '')?>" class="border p-2 w-full rounded" required>
            <div class="flex justify-end gap-4 mt-4">
                <button type="button" id="cancelUpdate" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                <button type="submit" class="bg-[#800000] text-white px-4 py-2 rounded hover:bg-[#a30000]">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
lucide.createIcons();

const menuToggle = document.getElementById("menuToggle");
const mobileMenu = document.getElementById("mobileMenu");
menuToggle.addEventListener("click", () => mobileMenu.classList.toggle("hidden"));

const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("overlay");
const sidebarToggleMobile = document.getElementById("sidebarToggleMobile");
const sidebarToggleDesktop = document.getElementById("sidebarToggleDesktop");

function toggleSidebar() {
    sidebar.classList.toggle("-translate-x-full");
    overlay.classList.toggle("hidden");
}
sidebarToggleMobile.addEventListener("click", toggleSidebar);
sidebarToggleDesktop.addEventListener("click", toggleSidebar);
overlay.addEventListener("click", toggleSidebar);

function showSection(id) {
    document.querySelectorAll(".profile-section").forEach(s => s.classList.add("hidden"));
    document.getElementById(id).classList.remove("hidden");
    sidebar.classList.add("-translate-x-full");
    overlay.classList.add("hidden");
}

const editBtn = document.getElementById("editDetailsBtn");
const updateModal = document.getElementById("updateModal");
const cancelUpdate = document.getElementById("cancelUpdate");

editBtn.addEventListener("click", () => updateModal.classList.remove("hidden"));
cancelUpdate.addEventListener("click", () => updateModal.classList.add("hidden"));
</script>

<?php include_once __DIR__ . '/php/messageBox.php';?>

</body>
</html>
