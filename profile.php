<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/php/db_config.php';
include_once __DIR__ . '/php/auth_check.php'; 
include_once __DIR__ . '/php/user_pdProcess.php';
include_once __DIR__ . '/php/user_formProcess.php';

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header('Location: login.php');
    exit;
}

$stmt = $conn->prepare("SELECT id FROM users WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();

if ($user_result->num_rows === 0) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}
?>



<?php include_once __DIR__ . '/user/user_header.php';?>

<div id="overlay" class="hidden fixed inset-0 bg-black bg-opacity-60 z-40"></div>
<section class="pt-24 max-w-7xl mx-auto px-6 flex flex-col md:flex-row gap-8 relative">

    <aside id="sidebar" class="bg-[#800000] text-white w-64 md:w-1/4 p-6 space-y-6 shadow-lg fixed md:static top-20 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-500 z-50 rounded-lg">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2"><i data-lucide="grid" class="w-5 h-5"></i> My Dashboard</h2>
        <ul class="space-y-3">
            <li>
                <button onclick="showSection('overview')" id="overviewBtn" class="w-full text-left flex items-center gap-2 hover:text-yellow-300">
                    <i data-lucide="home" class="w-4 h-4"></i> Overview
                </button>
            </li>            
           <li> <button onclick="showSection('profilePic')" class="w-full text-left flex items-center gap-2 hover:text-yellow-300"><i data-lucide="image" class="w-4 h-4"></i> Profile Picture</button></li>
            <li><button onclick="showSection('personalDetails')" class="w-full text-left flex items-center gap-2 hover:text-yellow-300"><i data-lucide="user-check" class="w-4 h-4"></i> Personal Details</button></li>
            <li><button onclick="showSection('postBlog')" class="w-full text-left flex items-center gap-2 hover:text-yellow-300"><i data-lucide="edit" class="w-4 h-4"></i> Post on Blog</button></li>
            <li><button onclick="showSection('staffVerify')" class="w-full text-left flex items-center gap-2 hover:text-yellow-300"><i data-lucide="award" class="w-4 h-4"></i> Staff Verify</button></li>
            <li>
               <form action="logout.php" method="POST">
                   <button type="submit" class="px-3 py-2 bg-red-600 text-white rounded flex items-center gap-2"><i data-lucide="log-out" class="w-4 h-4"></i> Log out</button>
               </form>
            </li>
        </ul>
    </aside>

    <div class="bg-white w-full md:w-3/4 rounded-lg p-8 shadow-lg md:ml-auto">

        <div class="mb-6 border-b pb-4">
            <h1 class="text-3xl font-bold text-[#800000]">Welcome back, <span class="text-gray-800"><?= htmlspecialchars($userData['fullname'] ?? '')?> 👋</span></h1>
            <p class="text-gray-600 mt-2">Manage your profile, share your thoughts, or verify your staff status below.</p>
        </div>

        <?php
        include_once __DIR__ . '/user/user_overview.php';
        include_once __DIR__ . '/user/user_picture.php';
        include_once __DIR__ . '/user/user_personalDetails.php';
        include_once __DIR__ . '/user/user_blog.php';
        include_once __DIR__ . '/user/user_staffVerify.php';

        ?>

    </div>
</section>

<div id="updateModal" class="hidden fixed inset-0 bg-black bg-opacity-70 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-semibold text-[#800000] mb-4">Update Personal Details</h2>
        <form id="updateForm" method="POST" class="space-y-3">
            <input type="hidden" name="form_type" value="update_details">
            <input type="text" name="fullname" value="<?= htmlspecialchars($userData['fullname'] ?? '')?>" class="border p-2 w-full rounded" required>
            <input type="email" name="email" value="<?= htmlspecialchars($userData['email'] ?? '')?>" class="border p-2 w-full rounded" required>
            <input type="text" name="phone" value="<?= htmlspecialchars($userData['phone'] ?? '')?>" class="border p-2 w-full rounded" required>
            <input type="text" name="program" value="<?= htmlspecialchars($userData['program'] ?? '')?>" class="border p-2 w-full rounded" required>
            <input type="text" name="category" value="<?= htmlspecialchars($userData['category'] ?? '')?>" class="border p-2 w-full rounded" required>
            <div class="flex justify-end gap-4 mt-2">
                <button type="button" id="cancelUpdate" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                <button type="submit" class="bg-[#800000] text-white px-4 py-2 rounded hover:bg-[#a30000]">Save</button>
            </div>
        </form>
    </div>
</div>

<script src="js/user.js"></script>
<?php include_once __DIR__ . '/php/messageBox.php';?>

</body>
</html>