<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
?>
<?php
include_once __DIR__ . '/dashboard_process.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard | Univix University</title>
    <link rel="icon" type="image/png" href="../img/univix_logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gray-100 font-sans">

    <nav class="bg-white shadow-md fixed w-full top-0 z-30 border-b">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-[#800000]">Univix <span class="text-gray-800">Admin Panel</span></h1>
            <button id="sidebarToggle" class="md:hidden text-gray-700">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </nav>

    <aside id="sidebar"
        class="bg-[#800000] text-white w-64 h-screen fixed top-0 left-0 pt-20 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-20 shadow-lg">
        <div class="p-6 space-y-4">
            <h2 class="text-lg font-semibold mb-4 border-b border-white/30 pb-2">Dashboard</h2>
            <ul class="space-y-3">
                <li><button onclick="showSection('posts')" class="w-full text-left hover:text-yellow-300">Posts</button></li>
                <li><button onclick="showSection('programs')" class="w-full text-left hover:text-yellow-300">Programs</button></li>
                <li><button onclick="showSection('staff')" class="w-full text-left hover:text-yellow-300">Staff</button></li>
                <li><button onclick="showSection('users')" class="w-full text-left hover:text-yellow-300">Users</button></li>
                <li><button onclick="showSection('contact')" class="w-full text-left hover:text-yellow-300">Contact</button></li>
                <li><a href="logout.php" class="text-blue-300 font-semibold">Logout</a></li>
            </ul>
        </div>
    </aside>

    <div id="overlay" class="hidden fixed inset-0 bg-black bg-opacity-40 z-10 md:hidden"></div>

    <main class="pt-24 md:pl-64 p-6 transition-all">
        <div class="max-w-6xl mx-auto bg-white rounded-lg p-8 shadow-md">

            <h1 class="text-3xl font-bold text-[#800000] mb-8">Welcome, Ife 👋</h1>

            <section id="posts" class="admin-section ">
                <h2 class="text-2xl font-semibold mb-4 text-[#800000]">Manage Blog Posts</h2>
                <div class="space-y-4">
                    <?php
                    $sql = "SELECT * FROM blog_posts WHERE status != 'deleted' ORDER BY created_at DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "
                            <div class='border p-4 rounded shadow-sm'>
                                <h3 class='font-bold text-lg'>{$row['topic']}</h3>
                                <p class='text-gray-700'>{$row['description']}</p>
                                <p class='text-gray-500 text-sm mb-2'>Posted by: {$row['posted_by']} | Date: {$row['date_posted']}</p>
                                <div class='mt-4 space-x-2'>
                                    <form method='POST' style='display:inline'>
                                        <input type='hidden' name='id' value='{$row['id']}'>
                                        <button name='action' value='approve' class='bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700'>Approve</button>
                                    </form>
                                    <form method='POST' style='display:inline'>
                                        <input type='hidden' name='id' value='{$row['id']}'>
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
                                    <img src='{$prog['image_url']}' alt='{$prog['title']}' class='w-32 h-20 object-cover rounded'>
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

            <section id="users" class="admin-section hidden">
                <div class="max-w-7xl mx-auto py-12 px-6 bg-gray-200">
                    <h1 class="text-3xl font-bold text-[#800000] mb-8">Applicants List</h1>
                    <?php
                        $query = "SELECT * FROM apply_now ORDER BY id DESC";
                        $result = $conn->query($query);
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
                                    <th class="py-3 px-4">Message</th>
                                    <th class="py-3 px-4 text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                if ($result->num_rows > 0):
                                    while ($row = $result->fetch_assoc()): 
                                ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4 font-semibold"><?php echo $row['id']; ?></td>
                                    <td class="py-3 px-4"><?php echo $row['fullname']; ?></td>
                                    <td class="py-3 px-4"><?php echo $row['email']; ?></td>
                                    <td class="py-3 px-4"><?php echo $row['phone']; ?></td>
                                    <td class="py-3 px-4"><?php echo $row['program']; ?></td>
                                    <td class="py-3 px-4"><?php echo $row['category']; ?></td>
                                    <td class="py-3 px-4 max-w-xs text-sm text-gray-700">
                                        <?php echo nl2br($row['message']); ?>
                                    </td>

                                    <td class="py-3 px-4 text-center">
                                        <form action="" method="POST" 
                                            onsubmit="return confirm('Are you sure you want to delete this applicant?');">
                                            <input type="hidden" name="applicants_id" value="<?php echo $row['id']; ?>">
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

            
            <section id="contact" class="admin-section hidden">
                <div class="max-w-7xl mx-auto py-12 px-6 bg-gray-200">
                    <h1 class="text-3xl font-bold text-[#800000] mb-8">Contact List</h1>
                    <?php
                        $conList = "SELECT * FROM `connect` ORDER BY id DESC";
                        $conResult = $conn->query($conList);
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
                                    <td class="py-3 px-4 font-semibold"><?php echo $connect['id']; ?></td>
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

        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
           
            lucide.createIcons();

        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('overlay');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        window.showSection = function (id) {
            document.querySelectorAll('.admin-section').forEach(sec => sec.classList.add('hidden'));
            document.getElementById(id).classList.remove('hidden');
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        };

        window.logout = function () {
            alert('Logging out...');
        };
        })
    </script>
    <?php include_once __DIR__ . '/../php/messageBox.php';?>

</body>
</html>
