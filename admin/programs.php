<section id="programs" class="admin-section hidden">
                <h2 class="text-2xl font-semibold mb-4 text-[#800000]">Manage Programs</h2>

                <form method="POST" enctype="multipart/form-data" class="bg-gray-50 p-6 rounded-lg mb-8 shadow">
                    <input type="hidden" name="form_type" value="add_program">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        <input type="text" name="title" placeholder="Program Title" required class="border-b border-gray-400 p-2 focus:outline-none">
                        <input type="file" name="image" placeholder="Image URL" required class="border-b border-gray-400 p-2 focus:outline-none">
                    </div>
                    <textarea name="description" placeholder="Program Description" required class="border border-gray-300 w-full rounded p-3 mb-4 h-32 focus:outline-none"></textarea>
                    <button type="submit" class="bg-[#800000] text-white py-2 px-6 rounded hover:bg-[#a30000]">Add Program</button>
                </form>

                <div class="space-y-4">
                    <?php
                    $programs = $conn->query("SELECT * FROM programs ORDER BY created_at DESC");
                    if ($programs->num_rows > 0) {
                        while ($prog = $programs->fetch_assoc()) {
                            echo "
                            <div class='border p-4 rounded shadow-sm flex justify-between items-center'>
                                <div>
                                    <h3 class='font-bold text-lg text-[#800000]'>{$prog['title']}</h3>
                                    <p class='text-gray-700 text-sm mb-2'>{$prog['description']}</p>
                                    <img src='../{$prog['image_url']}' alt='{$prog['title']}' class='w-32 h-20 object-cover rounded'>
                                </div>
                                <form method='POST' onsubmit=\"return confirm('Delete this program?');\">
                                    <button name='delete_program' value='{$prog['id']}' class='bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700'>Delete</button>
                                </form>
                            </div>";
                        }
                    } else {
                        echo "<p class='text-gray-600'>No programs added yet.</p>";
                    }
                    ?>
                </div>
            </section>