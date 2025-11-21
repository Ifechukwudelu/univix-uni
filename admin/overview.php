<?php 
include_once __DIR__ . '/../php/db_config.php';

$pendingPosts    = $conn->query("SELECT id FROM blog_posts WHERE status='pending'")->num_rows;
$approvedPosts   = $conn->query("SELECT id FROM blog_posts WHERE status='approved'")->num_rows;

$pendingStaff    = $conn->query("SELECT id FROM staff_verification WHERE status='pending'")->num_rows;
$approvedStaff   = $conn->query("SELECT id FROM staff_verification WHERE status='approved'")->num_rows;

$totalApplicants = $conn->query("SELECT id FROM users")->num_rows;
$totalContacts   = $conn->query("SELECT id FROM connect")->num_rows;
$totalPrograms   = $conn->query("SELECT id FROM programs")->num_rows;
?>

<section id="overview" class="admin-section">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Admin Overview
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-100 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-[#800000]">Blog Posts</h2>
                <i data-lucide="file-text" class="w-7 h-7 text-[#800000]"></i>
            </div>

            <div class="mt-5 space-y-1">
                <p class="text-gray-700 text-lg">Approved: 
                    <span class="font-bold"><?= $approvedPosts ?></span>
                </p>
                <p class="text-gray-700 text-lg">Pending: 
                    <span class="font-bold"><?= $pendingPosts ?></span>
                </p>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-100 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-[#800000]">Staff Verification</h2>
                <i data-lucide="badge-check" class="w-7 h-7 text-[#800000]"></i>
            </div>

            <div class="mt-5 space-y-1">
                <p class="text-gray-700 text-lg">Approved: 
                    <span class="font-bold"><?= $approvedStaff ?></span>
                </p>
                <p class="text-gray-700 text-lg">Pending: 
                    <span class="font-bold"><?= $pendingStaff ?></span>
                </p>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-100 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-[#800000]">Applicants</h2>
                <i data-lucide="users" class="w-7 h-7 text-[#800000]"></i>
            </div>

            <p class="mt-5 text-gray-700 text-lg">
                Total Applicants: <span class="font-bold"><?= $totalApplicants ?></span>
            </p>
        </div>

        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-100 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-[#800000]">Contact Messages</h2>
                <i data-lucide="inbox" class="w-7 h-7 text-[#800000]"></i>
            </div>

            <p class="mt-5 text-gray-700 text-lg">
                Total Messages: <span class="font-bold"><?= $totalContacts ?></span>
            </p>
        </div>

        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-100 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-[#800000]">Programs</h2>
                <i data-lucide="book-open" class="w-7 h-7 text-[#800000]"></i>
            </div>

            <p class="mt-5 text-gray-700 text-lg">
                Total Programs: <span class="font-bold"><?= $totalPrograms ?></span>
            </p>
        </div>

    </div>
</section>

<script>
    lucide.createIcons();
</script>
