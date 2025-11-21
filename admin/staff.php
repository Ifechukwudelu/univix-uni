<section id="staff" class="admin-section hidden">
                <h2 class="text-2xl font-semibold mb-4 text-[#800000]">Staff Verification Requests</h2>

                <div class="space-y-4">
                    <?php
                    $staffs = $conn->query("SELECT * FROM staff_verification ORDER BY verified_at DESC");
                    if ($staffs->num_rows > 0) {
                        while ($s = $staffs->fetch_assoc()) {
                            $img = htmlspecialchars($s['staff_image']);
                            $name = htmlspecialchars($s['staff_name']);
                            $post = htmlspecialchars($s['staff_post']);
                            $quote = htmlspecialchars($s['staff_quote']);
                            $type = htmlspecialchars($s['staff_category']);
                            $status = htmlspecialchars($s['status']);

                            echo "
                            <div class='border p-4 rounded shadow-sm flex flex-col md:flex-row md:items-center md:justify-between'>
                                <div class='flex items-center space-x-4'>
                                    <img src='../{$img}' alt='{$name}' class='w-20 h-20 object-cover rounded-full border'>
                                    <div>
                                        <h3 class='font-bold text-lg text-[#800000]'>{$name}</h3>
                                        <p class='text-gray-700 text-sm'>{$post}</p>
                                        <p class='italic text-gray-600 text-sm'>\"{$quote}\"</p>
                                        <p class='text-gray-500 text-xs mt-1'>Category: {$type} | Status: <span class='font-semibold'>{$status}</span></p>
                                    </div>
                                </div>
                                <div class='mt-4 md:mt-0 space-x-2'>
                                    <form method='POST' style='display:inline'>
                                        <input type='hidden' name='staff_id' value='{$s['id']}'>
                                        <button name='staff_action' value='approve' class='bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700'>Approve</button>
                                    </form>
                                    <form method='POST' style='display:inline' onsubmit=\"return confirm('Delete this staff record?');\">
                                        <input type='hidden' name='staff_id' value='{$s['id']}'>
                                        <button name='staff_action' value='delete' class='bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700'>Delete</button>
                                    </form>
                                </div>
                            </div>";
                        }
                    } else {
                        echo "<p class='text-gray-600'>No staff verification requests yet.</p>";
                    }
                    ?>
                </div>
            </section>