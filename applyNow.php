<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user_id = $_SESSION['user_id'] ?? null;

$message = "";

if (isset($_SESSION['register_message'])) {
    $message = $_SESSION['register_message'];
    unset($_SESSION['register_message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply Now | Univix University</title>
    <link rel="icon" type="image/png" href="img/univix_logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="font-sans text-gray-800">

<?php include_once __DIR__ . '/php/header.php';?>

    <section class="bg-[#800000] text-white py-20 text-center px-6">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold mb-4 pt-6">Apply to Join Univix University</h1>
            <p class="text-lg text-gray-100 mb-8">
                Take your first step towards a brighter future. Univix University offers you the platform to grow,
                learn, and lead with excellence.
            </p>
            <blockquote class="border-l-4 border-white italic text-gray-200 text-lg">
                "Education is not the learning of facts, but the training of the mind to think." — Albert Einstein
            </blockquote>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6 md:flex items-center gap-10">
            <div class="md:w-1/2 bg-white p-8 rounded-lg shadow-lg border border-gray-100">
                <h2 class="text-2xl font-bold text-[#800000] mb-6 text-center">Application Form</h2>

                <form method="POST" action="php/applyNowform.php" enctype="multipart/form-data" class="space-y-5">
                    <div>
                        <label for="fullname" class="block mb-2 font-semibold text-gray-700">Full Name</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Enter your full name"
                            class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#800000] rounded" required>
                    </div>

                    <div>
                        <label for="email" class="block mb-2 font-semibold text-gray-700">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="example@univix.edu"
                            class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#800000] rounded" required>
                    </div>

                    <div>
                        <label for="phone" class="block mb-2 font-semibold text-gray-700">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number"
                            class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#800000] rounded" required>
                    </div>

                    <div>
                        <label for="program" class="block mb-2 font-semibold text-gray-700">Program of Interest</label>
                        <select id="program" name="program"
                            class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#800000] rounded" required>
                            <option value="">-- Select a Program --</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Mass Communication">Mass Communication</option>
                            <option value="Business Administration">Business Administration</option>
                            <option value="Economics">Economics</option>
                            <option value="Engineering">Engineering</option>
                        </select>
                    </div>

                    <div>
                        <label for="category" class="block mb-2 font-semibold text-gray-700">Select category</label>
                        <select id="category" name="category"
                            class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#800000] rounded" required>
                            <option value="">-- Select category --</option>
                            <option value="Staff">Staff</option>
                            <option value="Student">Student</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block mb-2 font-semibold text-gray-700">Additional Message
                            (optional)</label>
                        <textarea id="message" name="message" rows="3" placeholder="Tell us why you chose Univix..."
                            class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#800000] rounded" required></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#800000] text-white font-semibold py-3 rounded hover:bg-[#a21d1d] transition">Submit
                        Application</button>
                </form>
            </div>

            <div class="md:w-1/2 mt-10 md:mt-0 text-center">
                <img src="img/campus.jpeg" alt="Students applying at Univix" class="rounded-lg shadow-lg mx-auto mb-6">
                <p class="text-gray-700 leading-relaxed max-w-md mx-auto">
                    At Univix, we believe education should empower, inspire, and open doors to limitless possibilities.
                    Our application process is simple — your journey to excellence starts right here.
                </p>
            </div>
        </div>
    </section>

   <?php include_once __DIR__ . '/php/footer.php';?>

    <script>
        lucide.createIcons();
    </script>

    <style>
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slideDown {
            animation: slideDown 0.3s ease forwards;
        }
    </style>
    <?php include_once __DIR__ . '/php/messageBox.php';?> 
</body>

</html>