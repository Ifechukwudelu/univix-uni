<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Programs | Univix University</title>
    <link rel="icon" type="image/png" href="img/univix_logo.png">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans text-gray-900">

    <?php include_once __DIR__ . '/php/header.php';?>

    <section class="bg-[#800000] text-white py-32 text-center mt-16">
        <h1 class="text-4xl font-bold mb-4">Available Study Programs</h1>
        <p class="text-gray-200 max-w-2xl mx-auto">
            Explore our wide range of academic programs designed to help you build a successful career and make
            meaningful impact in your chosen field.
        </p>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 lg:grid-cols-3 gap-10">
 
            <?php
            include_once __DIR__ . '/php/db_config.php';
            $program_result = $conn->query("SELECT * FROM programs ORDER BY created_at DESC");
            if ($program_result->num_rows > 0) {
                while ($prog = $program_result->fetch_assoc()) {
                    echo "
                    <div class='bg-white shadow-lg rounded-lg p-6 hover:shadow-2xl transition'>
                        <img src='{$prog['image_url']}' alt='{$prog['title']}' class='rounded-md mb-4 h-[350px] w-full object-cover'>
                        <h3 class='text-2xl font-semibold mb-2 text-[#800000]'>{$prog['title']}</h3>
                        <p class='text-gray-700 text-sm'>{$prog['description']}</p>
                    </div>";
                }
            } else {
                echo "<p class='text-center text-gray-600 col-span-3'>No programs available yet.</p>";
            }
            ?>

        </div>
    </section>

    <?php include_once __DIR__ . '/php/footer.php';?>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>