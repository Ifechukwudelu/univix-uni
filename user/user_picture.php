 <?php
 include_once __DIR__ . '/../php/db_config.php';
 
$profile_imagePath = null;

$imgQuery = $conn->prepare("SELECT user_image FROM user_image WHERE user_id = ? LIMIT 1");
$imgQuery->bind_param("i", $user_id);
$imgQuery->execute();
$imgQuery->bind_result($profile_imagePath);
$imgQuery->fetch();
$imgQuery->close();

 ?>
 <!-- PROFILE PICTURE -->
        <div id="profilePic" class="profile-section hidden">
            <form method="POST" enctype="multipart/form-data" class="max-w-md space-y-4">
            <input type="hidden" name="form_type" value="profile_picture">
            <h2 class="text-2xl font-semibold text-[#800000] mb-2 flex items-center gap-2"><i data-lucide="image" class="w-5 h-5"></i> Profile Picture</h2>
            <div class="flex flex-col items-center gap-4">
                <?php if (!empty($profile_imagePath)): ?>
                    <img src="<?= htmlspecialchars($profile_imagePath)?>" alt="Profile" class="w-32 h-32 rounded-full border-4 border-[#800000] object-cover">
                <?php else: ?>
                    <img src="img/default.jpeg" alt="Profile" class="w-32 h-32 rounded-full border-4 border-[#800000] object-cover">
                <?php endif; ?>
                <input type="file" name="user_image" class="border p-2 w-full">
                <button type="submit" class="bg-[#800000] text-white px-6 py-2 rounded hover:bg-[#a30000]">Upload</button>
            </div>
            </form>
        </div>