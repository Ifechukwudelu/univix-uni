  <nav class="fixed top-0 w-full bg-white shadow z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <a href="index.php" class="text-2xl font-bold text-[#800000]">Univix University</a>

      <ul class="hidden lg:flex space-x-8 font-medium">
        <li><a href="index.php" class="hover:text-[#800000] transition">Home</a></li>
        <li><a href="about.php" class="hover:text-[#800000] transition">About</a></li>
        <li><a href="programs.php" class="hover:text-[#800000] transition">Programs</a></li>
        <li><a href="workers.php" class="hover:text-[#800000] transition">Our Staffs</a></li>
        <li><a href="blog.php" class="hover:text-[#800000] transition">Blog</a></li>
        <li><a href="connect.php" class="hover:text-[#800000] transition">Contact</a></li>
      </ul>

      <div class="space-x-3 hidden lg:flex">
        <a href="login.php">
          <button
            class="border border-[#800000] text-[#800000] px-4 py-2 rounded hover:bg-[#800000] hover:text-white transition">Login
          </button>
        </a>
        <a href="applyNow.php">
          <button class="bg-[#800000] text-white px-4 py-2 rounded hover:bg-[#660000] transition">Apply Now</button>
        </a>
      </div>
      <a href="profile.php"> 
        <i data-lucide="circle-user-round" class="text-[#800000] w-6 h-6"></i>
      </a>

      <button id="menu-toggle" class="lg:hidden focus:outline-none">
        <i data-lucide="menu" class="w-6 h-6 text-[#800000]"></i>
      </button>
    </div>

    <div id="mobile-menu" class="absolute top-full left-0 w-full bg-white shadow-md opacity-0 translate-y-[-10px] 
         pointer-events-none transition-all duration-300 ease-in-out lg:hidden">
      <ul class="flex flex-col px-6 py-4 space-y-3 text-center font-medium">
        <li><a href="index.php" class="block hover:text-[#800000] transition">Home</a></li>
        <li><a href="about.php" class="block hover:text-[#800000] transition">About</a></li>
        <li><a href="programs.php" class="block hover:text-[#800000] transition">Programs</a></li>
        <li><a href="workers.php" class="block hover:text-[#800000] transition">Our Staffs</a></li>
        <li><a href="blog.php" class="block hover:text-[#800000] transition">Blog</a></li>
        <li><a href="connect.php" class="block hover:text-[#800000] transition">Contact</a></li>
        <div class="flex justify-center gap-4 pt-3">
          <a href="login.php">
            <button
              class="border border-[#800000] text-[#800000] px-4 py-2 rounded hover:bg-[#800000] hover:text-white transition">Login</button>
          </a>
          <a href="applyNow.php">
          <button class="bg-[#800000] text-white px-4 py-2 rounded hover:bg-[#660000] transition">Apply</button>
          </a>
        </div>
      </ul>
    </div>
  </nav>

  <script src="js/nav.js"></script>