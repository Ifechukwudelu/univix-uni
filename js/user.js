lucide.createIcons();


const menuToggle = document.getElementById("menuToggle");
const mobileMenu = document.getElementById("mobileMenu");

menuToggle?.addEventListener("click", () => {
    mobileMenu.classList.toggle("max-h-0");
    mobileMenu.classList.toggle("opacity-0");
    mobileMenu.classList.toggle("pointer-events-none");
    mobileMenu.classList.toggle("max-h-96");
});


const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("overlay");
const sidebarToggleMobile = document.getElementById("sidebarToggleMobile");
const sidebarToggleDesktop = document.getElementById("sidebarToggleDesktop");

function showSection(id) {
            document.querySelectorAll(".profile-section").forEach(s => s.classList.add("hidden"));
            const el = document.getElementById(id);
            if (el) el.classList.remove("hidden");

            sidebar.classList.add("-translate-x-full");
            overlay.classList.add("hidden");
        }

function toggleSidebar() {
    sidebar.classList.toggle("-translate-x-full");
    overlay.classList.toggle("hidden");
}
sidebarToggleMobile?.addEventListener("click", toggleSidebar);
sidebarToggleDesktop?.addEventListener("click", toggleSidebar);
overlay?.addEventListener("click", toggleSidebar);

// edit
const editBtn = document.getElementById("editDetailsBtn");
const updateModal = document.getElementById("updateModal");
const cancelUpdate = document.getElementById("cancelUpdate");

editBtn?.addEventListener("click", () => updateModal.classList.remove("hidden"));
cancelUpdate?.addEventListener("click", () => updateModal.classList.add("hidden"));