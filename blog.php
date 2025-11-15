<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Univix University | Blog</title>
    <link rel="icon" type="image/png" href="img/univix_logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="font-sans text-gray-900 bg-gray-50">

    <?php include_once __DIR__ . '/php/header.php';?>

    <section class="bg-[#800000] text-white py-32 text-center mt-16">
        <h1 class="text-4xl font-bold mb-4">Univix University Blog</h1>
        <p class="text-gray-200 max-w-2xl mx-auto">Stay informed and inspired — read the latest stories, research
            updates, and student experiences from our vibrant university community.</p>
    </section>

    <?php
    include_once __DIR__ . '/php/db_config.php';
    $sql = "SELECT * FROM blog_posts WHERE status='approved' ORDER BY created_at DESC";
    $result = $conn->query($sql);
    ?>

    <section class="py-20">
    <div class="max-w-6xl mx-auto py-12 px-6 grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <?php if (!empty($row['image'])): ?>
                <img src="<?= htmlspecialchars($row['image']) ?>" alt="Post image" class="w-full h-48 object-cover">
            <?php endif; ?>
            <div class="p-4">
                <h3 class="font-bold text-xl text-[#800000] mb-2"><?= htmlspecialchars($row['topic']) ?></h3>
                <p class="text-gray-700"><?= htmlspecialchars($row['description']) ?></p>
                <p class="text-gray-600 text-sm mb-2"><?= htmlspecialchars($row['posted_by']) ?> | <?= htmlspecialchars($row['date_posted']) ?></p>
            </div>
        </div>
        <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center text-gray-600 col-span-3">No posts available.</p>
        <?php endif; ?>
        </div>
    </section>

            <!-- <article class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-xl transition">
                <img src="img/campusustainability.jpeg" class="h-56 w-full object-cover" alt="">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-2 text-[#800000]">Campus Sustainability Drive: Green Energy
                        Initiatives</h2>
                    <p class="text-gray-600 mb-4 text-sm">
                        Univix embarks on a mission to reduce carbon emissions by implementing solar power systems
                        across campus and promoting eco-friendly habits.
                    </p>
                    <div class="text-sm text-gray-500">
                        <p><span class="font-semibold">Posted:</span> June 30, 2025</p>
                        <p><span class="font-semibold">By:</span> Dr. Faith Ojo <span
                                class="text-gray-400">(Environmental Engineer)</span></p>
                    </div>
                </div>
            </article> -->

        </div> 
    </section>

    <?php include_once __DIR__ . '/php/footer.php';?>

    <!-- JS -->
    <script>
        lucide.createIcons();
    </script>
</body>

</html>