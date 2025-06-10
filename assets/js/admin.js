function toggleDropdown() {
    const menu = document.getElementById("dropdown-menu");
    menu.classList.toggle("show");
  }
  
  // Menutup dropdown saat klik di luar
  document.addEventListener("click", function (e) {
    const menu = document.getElementById("dropdown-menu");
    const button = document.querySelector(".dropdown-toggle");
  
    if (!menu || !button) return;
  
    if (!button.contains(e.target) && !menu.contains(e.target)) {
      menu.classList.remove("show");
    }
  });
  function toggleHariDropdown() {
    const dropdown = document.getElementById("hari-dropdown");
    dropdown.classList.toggle("show-hari");
  }
  
  // Optional: close dropdown if clicking outside
  document.addEventListener("click", function (e) {
    const button = document.querySelector(".dropdown-toggle-hari");
    const menu = document.getElementById("hari-dropdown");
    if (!button.contains(e.target) && !menu.contains(e.target)) {
      menu.classList.remove("show-hari");
    }
  });
    
  function showLogoutModal(e) {
  e.preventDefault();
  document.getElementById('logout-modal').style.display = 'flex';
}
function hideLogoutModal() {
  document.getElementById('logout-modal').style.display = 'none';
}
function confirmLogout() {
  window.location.href = 'login.php';
}