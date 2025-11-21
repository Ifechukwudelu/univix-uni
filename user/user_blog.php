        <?php include_once __DIR__ . '/../php/user_pdProcess.php';?>

        <!-- POST BLOG -->
        <div id="postBlog" class="profile-section hidden">
            <div class="grid md:grid-cols-2 gap-6">
               
                <div class="bg-white border rounded-lg p-4 max-w-md">
                    <h2 class="text-xl font-semibold text-[#800000] mb-3 flex items-center gap-2"><i data-lucide="edit-2" class="w-5 h-5"></i> Post on Blog</h2>
                    <form method="POST" enctype="multipart/form-data" class="space-y-3">
                        <input type="hidden" name="form_type" value="blog_post">
                        <input type="file" name="image" class="border p-2 w-full" required>
                        <input type="text" name="topic" placeholder="Topic" class="border p-2 w-full" required>
                        <textarea name="description" placeholder="Description" class="border p-2 w-full h-28" required></textarea>
                        <input type="text" name="date_posted" class="border p-2 w-full" value="<?= date('Y-m-d H:i:s') ?>" readonly>
                        <input type="text" name="posted_by" class="border p-2 w-full" value="<?= htmlspecialchars($userData['fullname'] ?? '')?> (<?= htmlspecialchars($userData['category'] ?? '')?>)" readonly> 
                    
                        <button type="submit" class="bg-[#800000] text-white px-6 py-2 rounded hover:bg-[#a30000]">Post</button>
                    </form>
                </div>

                <!-- previous blogs -->
                <div class="bg-white border rounded-lg p-4 overflow-auto max-h-96">
                    <h3 class="font-semibold text-[#800000] mb-2 flex items-center gap-2"><i data-lucide="clock" class="w-4 h-4"></i> My Previous Blogs</h3>
                    <?php
                    $stmt = $conn->prepare("SELECT image, topic, description, date_posted, status, created_at FROM blog_posts WHERE user_id = ? ORDER BY created_at DESC");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    if ($res->num_rows > 0) {
                        while ($b = $res->fetch_assoc()) {
                            $blog_img = htmlspecialchars($b['image']);
                            $blog_topic = htmlspecialchars($b['topic']);
                            $blog_desc = htmlspecialchars($b['description']);
                            $date = htmlspecialchars($b['date_posted']);
                            $blog_stats = htmlspecialchars($b['status']);

                            echo "<div class='border-b py-3 flex gap-3'>
                                    <img src='{$blog_img}' alt='{$blog_topic}' class='w-16 h-16 object-cover rounded'>
                                    <div class='flex-1'>
                                        <div class='flex justify-between items-start'>
                                            <div>
                                                <h4 class='font-semibold text-[#800000]'>{$blog_topic}</h4>
                                                <p class='text-sm text-gray-700 text-wrap'>{$blog_desc}</p>
                                            </div>
                                            <span class='text-xs text-gray-500'>{$date}</span>
                                        </div>
                                        <div class='mt-2 text-xs'>Status: <span class='font-semibold'>{$blog_stats}</span></div>
                                    </div>
                                </div>";
                        }
                    } else {
                        echo "<p class='text-gray-500'>You haven't posted any blogs yet.</p>";
                    }
                    $stmt->close();
                    ?>
                </div>
            </div>
        </div>