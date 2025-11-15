<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Our Staff | Univix University</title>
    <link rel="icon" type="image/png" href="img/univix_logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="font-sans text-gray-900">

    <?php include_once __DIR__ . '/php/header.php';?>

    <section class="bg-[#800000] text-white py-32 text-center mt-16">
        <h1 class="text-4xl font-bold mb-4">Meet Our Esteemed Staff</h1>
        <p class="text-gray-200 max-w-2xl mx-auto">
            At Univix University, our leadership, academic, and administrative teams work together to create an
            environment of learning, innovation, and excellence.
        </p>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                include_once __DIR__ . '/php/db_config.php';
                $staffs = $conn->query("SELECT * FROM staff_verification WHERE status='approved' ORDER BY verified_at DESC");
                if ($staffs->num_rows > 0) {
                    while ($s = $staffs->fetch_assoc()) {
                        $img = htmlspecialchars($s['staff_image']);
                        $name = htmlspecialchars($s['staff_name']);
                        $post = htmlspecialchars($s['staff_post']);
                        $quote = htmlspecialchars($s['staff_quote']);
                        echo "
                        <div class='bg-white shadow-lg rounded-lg text-center p-6 hover:shadow-2xl transition'>
                            <img src='{$img}' alt='{$name}' class='w-32 h-32 object-cover rounded-full mx-auto mb-4'>
                            <h3 class='text-xl font-semibold text-[#800000]'>{$name}</h3>
                            <p class='text-gray-700 text-sm mb-2'>{$post}</p>
                            <p class='text-gray-500 text-sm italic'>\"{$quote}\"</p>
                        </div>";
                    }
                } else {
                    echo '<p class="text-gray-600 text-center col-span-full">No approved staff yet.</p>';
                }
                ?>
        </div>
    </section>

    <!-- <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-[#800000] mb-10">Academic Staff</h2>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <div class="bg-gray-50 shadow rounded-lg p-6 text-center hover:shadow-xl transition">
                    <img src="img/staff3.jpeg" alt="Staff" class="w-28 h-28 rounded-full object-cover mx-auto mb-3">
                    <h4 class="font-semibold text-[#800000]">Mr. Samuel Adeyemi</h4>
                    <p class="text-sm text-gray-600 mb-1">Head, Faculty of Engineering</p>
                    <p class="text-xs italic text-gray-500">"Innovating for a better tomorrow."</p>
                </div>

                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <div class="bg-white shadow rounded-lg p-6 text-center hover:shadow-xl transition">
                    <img src="img/non1.jpeg" alt="Staff" class="w-28 h-28 rounded-full object-cover mx-auto mb-3">
                    <h4 class="font-semibold text-[#800000]">Mr. James Nwosu</h4>
                    <p class="text-sm text-gray-600 mb-1">Registrar</p>
                    <p class="text-xs italic text-gray-500">"Ensuring smooth academic operations across all faculties."
                    </p>
                </div>

                <div class="bg-white shadow rounded-lg p-6 text-center hover:shadow-xl transition">
                    <img src="img/non3.jpeg" alt="Staff" class="w-28 h-28 rounded-full object-cover mx-auto mb-3">
                    <h4 class="font-semibold text-[#800000]">Mr. Peter Onyekachi</h4>
                    <p class="text-sm text-gray-600 mb-1">IT Support Officer</p>
                    <p class="text-xs italic text-gray-500">"Keeping Univix digitally connected and secure."</p>
                </div>
            </div>
        </div>
    </section> -->

    <?php include_once __DIR__ . '/php/footer.php';?>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>