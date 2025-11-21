<section id="contact" class="admin-section hidden">
                <div class="max-w-7xl mx-auto py-12 px-6 bg-gray-200">
                    <h1 class="text-3xl font-bold text-[#800000] mb-8">Contact List</h1>
                    <?php
                        $conList = "SELECT * FROM `connect` ORDER BY id";
                        $conResult = $conn->query($conList);
                        $customId = 1;
                    ?>
                    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-[#800000] text-white">
                                <tr>
                                    <th class="py-3 px-4">#</th>
                                    <th class="py-3 px-4">Full Name</th>
                                    <th class="py-3 px-4">Email</th>
                                    <th class="py-3 px-4">subject</th>
                                    <th class="py-3 px-4">Message</th>
                                    <th class="py-3 px-4 text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                if ($conResult->num_rows > 0):
                                    while ($connect = $conResult->fetch_assoc()): 
                                ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4 font-semibold"><?php echo $customId++; ?></td>
                                    <td class="py-3 px-4"><?php echo $connect['name']; ?></td>
                                    <td class="py-3 px-4"><?php echo $connect['email']; ?></td>
                                    <td class="py-3 px-4"><?php echo $connect['subject']; ?></td>
                                    <td class="py-3 px-4 max-w-xs text-sm text-gray-700">
                                        <?php echo nl2br($connect['message']); ?>
                                    </td>

                                    <td class="py-3 px-4 text-center">
                                        <form action="" method="POST" 
                                            onsubmit="return confirm('Are you sure you want to delete this row?');">
                                            <input type="hidden" name="contact_id" value="<?php echo $connect['id']; ?>">
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
                                    <td colspan="8" class="py-6 text-center text-gray-500">No list on contact yet.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>