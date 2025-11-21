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

<!-- OVERVIEW (default) -->
        <div id="overview" class="profile-section">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="col-span-1 bg-white rounded-lg p-4 shadow-sm flex flex-col items-center">
                    <?php if (!empty($profile_imagePath)): ?>
                        <img src="<?= htmlspecialchars($profile_imagePath)?>" alt="Profile" class="w-24 h-24 rounded-full border-4 border-[#800000] object-cover mb-3">
                    <?php else: ?>
                        <img src="img/default.jpeg" alt="Profile" class="w-24 h-24 rounded-full border-4 border-[#800000] object-cover mb-3">
                    <?php endif; ?>
                    <h3 class="font-semibold"><?= htmlspecialchars($userData['fullname'] ?? '')?></h3>
                    <p class="text-sm text-gray-500"><?= htmlspecialchars($userData['program'] ?? '')?></p>
                </div>

                <div class="col-span-2 bg-white rounded-lg p-4 shadow-sm">
                    <h3 class="text-lg font-semibold text-[#800000]">Quick Stats</h3>
                    <div class="grid grid-cols-3 gap-4 mt-4">
                        
                        <?php
                        $stmt = $conn->prepare("SELECT COUNT(*) FROM blog_posts WHERE user_id = ?");
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $stmt->bind_result($blog_count);
                        $stmt->fetch();
                        $stmt->close();

                        $stmt = $conn->prepare("SELECT COUNT(*) FROM staff_verification WHERE user_id = ?");
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $stmt->bind_result($staff_count);
                        $stmt->fetch();
                        $stmt->close();
                        ?>
                        <div class="p-3 border rounded text-center">
                            <div class="text-2xl font-bold"><?= intval($blog_count) ?></div>
                            <div class="text-sm text-gray-500">My Blog Posts</div>
                        </div>
                        <div class="p-3 border rounded text-center">
                            <div class="text-2xl font-bold"><?= intval($staff_count) ?></div>
                            <div class="text-sm text-gray-500">Staff Requests</div>
                        </div>
                        <div class="p-3 border rounded text-center">
                            <div class="text-2xl font-bold"><?= htmlspecialchars($userData['category'] ?? '-') ?></div>
                            <div class="text-sm text-gray-500">Category</div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h4 class="font-semibold">Recent Activity</h4>
                        <div class="mt-3 space-y-3 max-h-40 overflow-auto">
                            <?php
                            $stmt = $conn->prepare("SELECT topic, date_posted, status FROM blog_posts WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
                            $stmt->bind_param("i", $user_id);
                            $stmt->execute();
                            $res = $stmt->get_result();
                            if ($res->num_rows) {
                                while ($r = $res->fetch_assoc()) {
                                    echo "<div class='text-sm'><span class='font-semibold'>" . htmlspecialchars($r['topic']) . "</span> — <span class='text-gray-500'>{$r['date_posted']}</span> <span class='px-2 text-xs rounded bg-gray-100'>{$r['status']}</span></div>";
                                }
                            } else {
                                echo "<div class='text-sm text-gray-500'>No recent posts</div>";
                            }
                            $stmt->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>