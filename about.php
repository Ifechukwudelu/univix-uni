<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About | Univix University</title>
  <link rel="icon" type="image/png" href="img/univix_logo.png">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;600&family=Oswald:wght@500;700&display=swap"
    rel="stylesheet">
  <style>
    body {
      font-family: "DM Sans", sans-serif;
    }

    h1,
    h2,
    h3 {
      font-family: "Oswald", sans-serif;
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-800">

  <?php include_once __DIR__ . '/php/header.php'; ?>


  <section class="h-[60vh] flex items-center justify-center bg-cover bg-center relative"
    style="background-image: url('img/aboutimg.jpeg'); margin-top: 64px;">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <h1 class="text-4xl sm:text-5xl font-bold text-white relative z-10">About Univix University</h1>
  </section>

  <section class="bg-white text-gray-800 py-20">
    <div class="max-w-6xl mx-auto px-6 md:flex items-center gap-10">
      <div class="md:w-1/2 mb-10 md:mb-0">
        <h2 class="text-3xl font-bold mb-6 text-[#800000]">Embark on a Journey: Unveiling the Story of Univix
          University</h2>
        <p class="text-gray-600 mb-6 leading-relaxed">
          At Univix University, we are dedicated to nurturing future leaders, innovators, and thinkers. Since our
          establishment, we’ve remained committed to offering a learning environment that blends academic rigor with
          creativity and innovation.
        </p>
        <p class="text-gray-600 mb-6 leading-relaxed">
          Our university stands as a beacon of excellence, recognized for its vibrant academic culture and
          forward-thinking approach to education. With a diverse community of scholars, researchers, and industry
          professionals, Univix prepares students to shape the world around them.
        </p>
        <p class="text-gray-600 mb-6 leading-relaxed">
          From Engineering and Sciences to Arts and Humanities, every faculty thrives on collaboration, technology, and
          purpose-driven education.
        </p>
      </div>
      <div class="md:w-1/2">
        <img src="img/aboutimg.jpeg" class="rounded-lg shadow-lg w-full object-cover" alt="About Univix University">
      </div>
    </div>
  </section>

  <section class="bg-[#800000] text-white py-16">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10">
      <div>
        <h3 class="text-2xl font-semibold mb-4">Our Vision</h3>
        <p class="text-gray-200 leading-relaxed">
          To be a world-class institution renowned for academic excellence, innovation, and social impact — inspiring a
          generation of leaders dedicated to transforming the future.
        </p>
      </div>
      <div>
        <h3 class="text-2xl font-semibold mb-4">Our Mission</h3>
        <p class="text-gray-200 leading-relaxed">
          To provide accessible, high-quality education that fosters intellectual curiosity, critical thinking, and
          sustainable development — empowering students to lead, serve, and make a difference.
        </p>
      </div>
    </div>
  </section>

  <section class="py-16 bg-gray-100 text-center">
    <div class="max-w-5xl mx-auto px-6">
      <h2 class="text-3xl font-bold text-[#800000] mb-10">Our Core Values</h2>
      <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8">
        <div class="bg-white shadow rounded-xl p-6 hover:shadow-lg">
          <i data-lucide="heart" class="w-10 h-10 text-[#800000] mx-auto mb-4"></i>
          <h4 class="font-semibold mb-2">Integrity</h4>
          <p class="text-gray-600 text-sm">We uphold honesty, transparency, and ethical conduct in all our endeavors.
          </p>
        </div>
        <div class="bg-white shadow rounded-xl p-6 hover:shadow-lg">
          <i data-lucide="users" class="w-10 h-10 text-[#800000] mx-auto mb-4"></i>
          <h4 class="font-semibold mb-2">Community</h4>
          <p class="text-gray-600 text-sm">Our strength lies in unity — fostering collaboration and mutual growth.</p>
        </div>
        <div class="bg-white shadow rounded-xl p-6 hover:shadow-lg">
          <i data-lucide="lightbulb" class="w-10 h-10 text-[#800000] mx-auto mb-4"></i>
          <h4 class="font-semibold mb-2">Innovation</h4>
          <p class="text-gray-600 text-sm">We champion creativity and encourage ideas that redefine the norm.</p>
        </div>
      </div>
    </div>
  </section>

  <?php include_once __DIR__ . '/php/footer.php'; ?>

  <script>
    lucide.createIcons();
  </script>

</body>

</html>
