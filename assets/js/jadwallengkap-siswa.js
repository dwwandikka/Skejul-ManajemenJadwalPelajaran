document.addEventListener('DOMContentLoaded', function() {
  const jadwalLink = document.querySelector('.jadwal');
  const dropdownList = document.querySelector('.dropdown-list');
  const icon = document.querySelector('.jadwal-icon');
  const arrow = document.querySelector('.arrow-icon');
  const beranda = document.querySelector('.beranda'); 
  const home = document.querySelector('.home-icon');
  const textBeranda = document.querySelector('.text-beranda');
  const jadwalHariini = document.querySelector('.jadwal-hariini');
  const jadwalLengkap = document.querySelector('.jadwal-lengkap')

  if (jadwalLink && dropdownList) {
    jadwalLink.addEventListener('click', function(event) {
      event.preventDefault();
      dropdownList.classList.toggle('show');
      jadwalLink.classList.toggle('active');
      if (jadwalLink.classList.contains('active')) {
        icon.src = 'assets/img/jadwal-icon-blue.svg'; 
        arrow.src = 'assets/img/arrow-black.svg'; 
        home.src = 'assets/img/home-fill.svg';
        beranda.style.backgroundColor = 'transparent';
        textBeranda.style.color = "#fff";
      } else {
        icon.src = 'assets/img/jadwal-icon-white.svg'; 
        arrow.src = 'assets/img/arrow-white.svg'; 
        home.src = 'assets/img/home-blue';
        beranda.style.backgroundColor = '';
      }
    });

    document.addEventListener('click', function(event) {
      if (!event.target.closest('.dropdown')) {
        dropdownList.classList.remove('show');
      }
    });
  } else {
    console.log("Dropdown elements not found!");
  }
});

// document.querySelector('.jadwal-hariini').addEventListener('mouseenter', function() {
//   document.querySelector('.jadwal-lengkap').style.backgroundColor = 'white';
//   document.querySelector('.jadwal-lengkap').style.color = 'black';
// });

// document.querySelector('.jadwal-hariini').addEventListener('mouseleave', function() {
//   document.querySelector('.jadwal-lengkap').style.backgroundColor = '';  // Kembali ke default
//   document.querySelector('.jadwal-lengkap').style.color = 'white';  // Kembali ke default
// });

document.addEventListener('DOMContentLoaded', function() {
  const wrapper = document.querySelector('.dropdown-hari-wrapper');
  const selected = document.getElementById('dropdownHariSelected');
  const list = document.getElementById('dropdownHariList');
  const input = document.getElementById('jadwalHari');

  if (wrapper && list) {
    wrapper.addEventListener('click', function(e) {
      e.stopPropagation();
      wrapper.classList.toggle('active');
    });

    // Close dropdown if click outside
    document.addEventListener('click', function(e) {
      if (!wrapper.contains(e.target)) {
        wrapper.classList.remove('active');
      }
    });
  } else {
    console.log("Dropdown hari elements not found!");
  }
});

document.addEventListener('DOMContentLoaded', function() {
  const wrapper = document.querySelector('.dropdown-hari-wrapper');
  const selected = document.getElementById('dropdownHariSelected');
  const list = document.getElementById('dropdownHariList');
  const input = document.getElementById('jadwalHari');

  selected.addEventListener('click', function(e) {
    wrapper.classList.toggle('open');
  });

  list.querySelectorAll('li').forEach(function(item) {
    item.addEventListener('click', function(e) {
      // Hapus .selected dari semua li
      list.querySelectorAll('li').forEach(li => li.classList.remove('selected'));
      // Tambahkan .selected ke li yang diklik
      item.classList.add('selected');
      // Update teks di dropdown
      selected.querySelector('.dropdown-hari-text').textContent = item.textContent;
      // Update value input hidden
      input.value = item.getAttribute('data-value');
      // Tutup dropdown
      wrapper.classList.remove('open');
    });

      item.addEventListener('click', function() {
  // ...
  input.value = item.getAttribute('data-value'); // Sudah benar
  // ...
  fetch('jadwallengkap-siswa.php?hari=' + encodeURIComponent(input.value))
    .then(response => response.text())
    .then(html => {
      document.querySelector('tbody').innerHTML = html;
    });
  // ...
});
  });

  // Tutup dropdown jika klik di luar
  document.addEventListener('click', function(e) {
    if (!wrapper.contains(e.target)) {
      wrapper.classList.remove('open');
    }
  });
});

document.addEventListener('DOMContentLoaded', function() {
  const table = document.getElementById('jadwalTabel');
  const selected = document.getElementById('dropdownHariSelected');
  const hariText = selected.querySelector('.dropdown-hari-text');
  const list = document.getElementById('dropdownHariList');

  // Sembunyikan tabel jika text masih "Hari"
  if (hariText.textContent === 'Hari') {
    table.classList.add('hide-table');
  }

  list.querySelectorAll('li').forEach(function(item) {
    item.addEventListener('click', function() {
      hariText.textContent = item.textContent;
      table.classList.remove('hide-table');
    });
  });
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