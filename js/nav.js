const menuToggle = document.getElementById("menu-toggle");
const mobileMenu = document.getElementById("mobile-menu");

menuToggle.addEventListener("click", () => {
  mobileMenu.classList.toggle("opacity-0");
  mobileMenu.classList.toggle("translate-y-[-10px]");
  mobileMenu.classList.toggle("pointer-events-none");
});
