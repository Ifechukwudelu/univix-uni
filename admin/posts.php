<section id="posts" class="admin-section hidden">
                <h2 class="text-2xl font-semibold mb-4 text-[#800000]">Manage Blog Posts</h2>
                <div class="space-y-4">
                    <?php
                    $sql = "SELECT * FROM blog_posts WHERE status != 'deleted' ORDER BY created_at DESC";
                    $post_result = $conn->query($sql);

                    if ($post_result->num_rows > 0) {
                        while ($blog_row = $post_result->fetch_assoc()) {
                            echo " 
                            <div class='border p-4 rounded shadow-sm'>
                                <h3 class='font-bold text-lg'>{$blog_row['topic']}</h3>
                                <p class='text-gray-700'>{$blog_row['description']}</p>
                                <p class='text-gray-500 text-sm mb-2'>Posted by: {$blog_row['posted_by']} | Date: {$blog_row['date_posted']}</p>
                                <div class='mt-4 space-x-2'>
                                    <form method='POST' style='display:inline'>
                                        <input type='hidden' name='id' value='{$blog_row['id']}'>
                                        <button name='action' value='approve' class='bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700'>Approve</button>
                                    </form>
                                    <form method='POST' style='display:inline'>
                                        <input type='hidden' name='id' value='{$blog_row['id']}'>
                                        <button name='action' value='delete' class='bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700'>Delete</button>
                                    </form>
                                </div>
                            </div>";
                        }
                    } else {
                        echo "<p class='text-gray-600'>No posts found.</p>";
                    }
                    ?>
                </div>
            </section>