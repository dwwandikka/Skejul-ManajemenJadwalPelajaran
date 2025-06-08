function toggleKelasDropdown() {
  const peran = document.getElementById("kategori").value;
  const kelasDropdown = document.getElementById("kelas-dropdown");

  if (peran === "siswa") {  // Ganti dari "murid" ke "siswa" agar sesuai dengan HTML
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

// Show kelas dropdown on page load if siswa is selected
window.onload = function () {
  toggleKelasDropdown();
  
  // Add event listeners untuk password toggle
  const passwordChecks = document.querySelectorAll('.password-check');
  passwordChecks.forEach((check, index) => {
    check.addEventListener('click', function() {
      const inputId = index === 0 ? 'password' : 'konfirm_password';
      const iconElement = this.querySelector('img');
      togglePassword(inputId, iconElement);
    });
  });
};