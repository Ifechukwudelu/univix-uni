        <!-- PERSONAL DETAILS -->
        <div id="personalDetails" class="profile-section hidden">
            <h2 class="text-2xl font-semibold text-[#800000] mb-4 flex justify-between items-center">
                <span class="flex items-center gap-2"><i data-lucide="user" class="w-5 h-5"></i> Personal Details</span>
                <button id="editDetailsBtn" class="bg-yellow-500 text-white px-4 py-1 rounded hover:bg-yellow-600">Update</button>
            </h2>
            <div class="grid grid-cols-1 gap-4 md:w-3/4">
                <input type="text" value="<?= htmlspecialchars($userData['fullname'] ?? '')?>" class="border p-2 rounded w-full bg-gray-100" readonly>
                <input type="email" value="<?= htmlspecialchars($userData['email'] ?? '')?>" class="border p-2 rounded w-full bg-gray-100" readonly>
                <input type="text" value="<?= htmlspecialchars($userData['phone'] ?? '')?>" class="border p-2 rounded w-full bg-gray-100" readonly>
                <input type="text" value="<?= htmlspecialchars($userData['program'] ?? '')?>" class="border p-2 rounded w-full bg-gray-100" readonly>
                <input type="text" value="<?= htmlspecialchars($userData['category'] ?? '')?>" class="border p-2 rounded w-full bg-gray-100" readonly>
            </div>
        </div>