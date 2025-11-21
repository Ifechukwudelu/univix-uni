            <section id="users" class="admin-section hidden">
                <div class="max-w-7xl mx-auto py-12 px-6 bg-gray-200">
                    <h1 class="text-3xl font-bold text-[#800000] mb-8">Applicants List</h1>
                    <?php
                        $query = "SELECT * FROM users ORDER BY id";
                        $apply_result = $conn->query($query);
                        $customId = 1;
                    ?>
                    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-[#800000] text-white">
                                <tr>
                                    <th class="py-3 px-4">#</th>
                                    <th class="py-3 px-4">Full Name</th>
                                    <th class="py-3 px-4">Email</th>
                                    <th class="py-3 px-4">Phone</th>
                                    <th class="py-3 px-4">Program</th>
                                    <th class="py-3 px-4">Category</th>
                                    <th class="py-3 px-4 text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                if ($apply_result->num_rows > 0):
                                    while ($user_row = $apply_result->fetch_assoc()): 
                                ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4 font-semibold"><?php echo $customId++; ?></td>
                                    <td class="py-3 px-4"><?php echo $user_row['fullname']; ?></td>
                                    <td class="py-3 px-4"><?php echo $user_row['email']; ?></td>
                                    <td class="py-3 px-4"><?php echo $user_row['phone']; ?></td>
                                    <td class="py-3 px-4"><?php echo $user_row['program']; ?></td>
                                    <td class="py-3 px-4"><?php echo $user_row['category']; ?></td>

                                    <td class="py-3 px-4 text-center">
                                        <form action="" method="POST" 
                                            onsubmit="return confirm('Are you sure you want to delete this applicant?');">
                                            <input type="hidden" name="applicants_id" value="<?php echo $user_row['id']; ?>">
                                            <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php 
                                    endwhile; 
                                else: 
                                ?>
                                <tr>
                                    <td colspan="8" class="py-6 text-center text-gray-500">No applicants yet.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>