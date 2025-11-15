<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Univix University</title>
  <link rel="icon" type="image/png" href="img/univix_logo.png">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Playfair+Display:wght@600;700&display=swap"
    rel="stylesheet">
  <style>
    body {
      font-family: "DM Sans", sans-serif;
    }

    h1,
    h2,
    h3,
    h4 {
      font-family: "Playfair Display", serif;
    }
  </style>
</head>

<body class="bg-white text-gray-800">

  <?php include_once __DIR__ . '/php/header.php'; ?>

  <section class="relative h-[90vh] bg-cover bg-center flex items-center justify-center" style="">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="text-center relative z-10 text-white px-6">
      <h1 class="text-4xl md:text-5xl font-bold mb-6">Academic Journey Begins at Univix</h1>
      <p class="max-w-2xl mx-auto mb-8 text-gray-200 text-lg">Empowering students through innovation, integrity, and
        excellence in education.</p>
      <a href="programs.php">
        <button class="bg-[#800000] text-white px-8 py-3 rounded hover:bg-[#660000] transition">View Our Programs</button>
      </a>
    </div>
  </section>

  <section class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-bold text-[#800000] mb-12">Our Programs</h2>
      <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-8">
        <div class="bg-white shadow hover:shadow-lg rounded-lg overflow-hidden transition">
          <img src="img/undergraduate.jpeg" class="h-48 w-full object-cover" alt="">
          <h3 class="py-4 font-semibold text-lg">Undergraduate</h3>
        </div>
        <div class="bg-white shadow hover:shadow-lg rounded-lg overflow-hidden transition">
          <img src="img/postgraduate.jpeg" class="h-48 w-full object-cover" alt="">
          <h3 class="py-4 font-semibold text-lg">Postgraduate</h3>
        </div>
        <div class="bg-white shadow hover:shadow-lg rounded-lg overflow-hidden transition">
          <img src="img/distantlearning.jpeg" class="h-48 w-full object-cover" alt="">
          <h3 class="py-4 font-semibold text-lg">Distance Learning</h3>
        </div>
        <div class="bg-white shadow hover:shadow-lg rounded-lg overflow-hidden transition">
          <img src="img/professionalstudies.jpeg" class="h-48 w-full object-cover" alt="">
          <h3 class="py-4 font-semibold text-lg">Professional Studies</h3>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-[#800000] text-white py-20">
    <div class="max-w-6xl mx-auto px-6 md:flex items-center gap-10">
      <div class="md:w-1/2 mb-10 md:mb-0">
        <h2 class="text-3xl font-bold mb-6">Embark on a Journey: Unveiling the Story of Univix University</h2>
        <p class="text-gray-200 mb-6">At Univix, we’re shaping minds for the future. Our commitment to quality
          education, research, and innovation drives us to empower students with the tools to succeed in a dynamic
          world.</p>
        <a href="about.php"><button
            class="bg-white text-[#800000] px-6 py-3 rounded hover:bg-gray-200 transition">Learn More</button></a>
      </div>
      <div class="md:w-1/2">
        <img src="img/aboutimg.jpeg" class="rounded-lg shadow-lg" alt="">
      </div>
    </div>
  </section>

  <section class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-bold text-[#800000] mb-12">Tuition Fees at Univix</h2>
      <div class="grid md:grid-cols-3 gap-8 text-left">
        <div class="bg-white shadow rounded-lg p-6">
          <h3 class="font-semibold text-lg mb-2">Undergraduate Programs</h3>
          <p class="text-gray-600 mb-4">Full-Time Tuition per semester: <b>$2,100</b></p>
          <p class="text-gray-600">Part-Time Tuition per semester: <b>$1,400</b></p>
        </div>
        <div class="bg-white shadow rounded-lg p-6">
          <h3 class="font-semibold text-lg mb-2">Graduate Programs</h3>
          <p class="text-gray-600 mb-4">Full-Time Tuition per semester: <b>$2,800</b></p>
          <p class="text-gray-600">Part-Time Tuition per semester: <b>$1,900</b></p>
        </div>
        <div class="bg-white shadow rounded-lg p-6">
          <h3 class="font-semibold text-lg mb-2">Additional Fees</h3>
          <p class="text-gray-600 mb-4">Registration Fee: <b>$150</b></p>
          <p class="text-gray-600">Library & Lab Fee: <b>$100</b></p>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-[#f8f8f8] py-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-bold text-[#800000] mb-12">Thriving Beyond Classes</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white shadow rounded-lg overflow-hidden">
          <img src="img/vibrantcampuslife.jpeg" class="h-48 w-full object-cover" alt="">
          <div class="p-6">
            <h3 class="font-semibold text-lg mb-2">Vibrant Campus Life</h3>
            <p class="text-gray-600">Experience a community that celebrates culture, innovation, and collaboration.</p>
          </div>
        </div>
        <div class="bg-white shadow rounded-lg overflow-hidden">
          <img src="img/globalexposure.jpeg" class="h-48 w-full object-cover" alt="">
          <div class="p-6">
            <h3 class="font-semibold text-lg mb-2">Global Exposure</h3>
            <p class="text-gray-600">Collaborate with students and professors from around the world.</p>
          </div>
        </div>
        <div class="bg-white shadow rounded-lg overflow-hidden">
          <img src="img/leadershipdevimg.jpeg" class="h-48 w-full object-cover" alt="">
          <div class="p-6">
            <h3 class="font-semibold text-lg mb-2">Leadership Development</h3>
            <p class="text-gray-600">Shape your leadership potential through mentorship and student organizations.</p>
          </div>
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