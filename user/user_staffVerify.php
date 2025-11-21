       <?php include_once __DIR__ . '/../php/user_pdProcess.php';?>
       <!-- STAFF VERIFY -->
        <div id="staffVerify" class="profile-section hidden">
            <div class="grid md:grid-cols-2 gap-6">
              
                <div class="bg-white border rounded-lg p-4 max-w-md">
                    <h2 class="text-xl font-semibold text-[#800000] mb-3 flex items-center gap-2"><i data-lucide="award" class="w-5 h-5"></i> Staff Verification</h2>
                    <form method="POST" enctype="multipart/form-data" class="space-y-3">
                        <input type="hidden" name="form_type" value="staff_verify">
                        <input type="file" class="border p-2 w-full" name="staff_file" required>
                        <input type="text" placeholder="Full Name" class="border p-2 w-full" name="staff_name" value="<?= htmlspecialchars($userData['fullname'] ?? '') ?> (<?= htmlspecialchars($userData['category'] ?? '')?>)" readonly>
                        <input type="text" placeholder="Position" class="border p-2 w-full" name="staff_position" required>
                        <textarea placeholder="Quote" class="border p-2 w-full h-24" name="staff_quote" required></textarea>
                        <select class="border p-2 w-full" name="staff_type" required>
                            <option value="">Select Staff Type</option>
                            <option value="University Leadership">University Leadership</option>
                            <option value="Academic Staff">Academic Staff</option>
                            <option value="Non-Academic Staff">Non-Academic Staff</option>
                        </select>
                        <button type="submit" class="bg-[#800000] text-white px-6 py-2 rounded hover:bg-[#a30000]">Verify</button>
                    </form>
                </div>

                <!-- previous staff verify entries -->
                <div class="bg-white border rounded-lg p-4 overflow-auto max-h-96">
                    <h3 class="font-semibold text-[#800000] mb-2 flex items-center gap-2"><i data-lucide="file-text" class="w-4 h-4"></i> My Staff Requests</h3>
                    <?php
                    $stmt = $conn->prepare("SELECT staff_image, staff_name, staff_post, staff_quote, staff_category, status, verified_at FROM staff_verification WHERE user_id = ? ORDER BY verified_at DESC");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    if ($res->num_rows > 0) {
                        while ($s = $res->fetch_assoc()) {
                            $img = htmlspecialchars($s['staff_image']);
                            $name = htmlspecialchars($s['staff_name']);
                            $post = htmlspecialchars($s['staff_post']);
                            $quote = htmlspecialchars($s['staff_quote']);
                            $cat = htmlspecialchars($s['staff_category']);
                            $status = htmlspecialchars($s['status']);
                            $created = htmlspecialchars($s['verified_at']);

                            echo "<div class='border-b py-3 flex gap-3'>
                                    <img src='{$img}' alt='{$name}' class='w-16 h-16 object-cover rounded'>
                                    <div class='flex-1'>
                                        <div class='flex justify-between items-start'>
                                            <div>
                                                <h4 class='font-semibold text-[#800000]'>{$name} <span class='text-xs text-gray-500'>({$post})</span></h4>
                                                <p class='text-sm text-gray-700 truncate'>{$quote}</p>
                                                <div class='text-xs text-gray-500 mt-1'>Category: {$cat}</div>
                                            </div>
                                            <span class='text-xs text-gray-500'>{$created}</span>
                                        </div>
                                        <div class='mt-2 text-xs'>Status: <span class='font-semibold'>{$status}</span></div>
                                    </div>
                                </div>";
                        }
                    } else {
                        echo "<p class='text-gray-500'>No verification requests yet.</p>";
                    }
                    $stmt->close();
                    ?>
                </div>
            </div>
        </div>