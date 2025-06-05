// Tambahkan script ini di dalam tag <script> di file PHP Anda

function toggleKelasDropdown() {
  const peran = document.getElementById("kategori").value;
  const kelasDropdown = document.getElementById("kelas-dropdown");

  if (peran === "murid") {
    kelasDropdown.style.display = "block";
    document.getElementById("kelas_id").required = true;
  } else {
    kelasDropdown.style.display = "none";
    document.getElementById("kelas_id").required = false;
    document.getElementById("kelas_id").value = "";
  }
}

// Fungsi untuk toggle password visibility
function togglePassword(inputId, iconElement) {
  const passwordInput = document.getElementById(inputId);

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    iconElement.src = "assets/img/Eye-open.svg"; // Ganti dengan path icon mata terbuka
    iconElement.alt = "Hide password";
  } else {
    passwordInput.type = "password";
    iconElement.src = "assets/img/Eye-close.svg";
    iconElement.alt = "Show password";
  }
}

// Show kelas dropdown on page load if murid is selected
window.onload = function () {
  toggleKelasDropdown();

  // Tambahkan event listener untuk password toggle
  const passwordToggle = document.querySelector(
    "#password + .password-check img"
  );
  const konfirmPasswordToggle = document.querySelector(
    "#konfirm_password + .password-check img"
  );

  if (passwordToggle) {
    passwordToggle.parentElement.addEventListener("click", function () {
      togglePassword("password", passwordToggle);
    });
  }

  if (konfirmPasswordToggle) {
    konfirmPasswordToggle.parentElement.addEventListener("click", function () {
      togglePassword("konfirm_password", konfirmPasswordToggle);
    });
  }
};
