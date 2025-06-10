document.addEventListener('DOMContentLoaded', function() {
  // Sidebar dropdown functionality
  const jadwalLink = document.querySelector('.jadwal');
  const dropdownList = document.querySelector('.dropdown-list');
  const icon = document.querySelector('.jadwal-icon');
  const arrow = document.querySelector('.arrow-icon');
  const beranda = document.querySelector('.beranda'); 
  const home = document.querySelector('.home-icon');
  const textBeranda = document.querySelector('.text-beranda');

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
        home.src = 'assets/img/home-blue.svg';
        beranda.style.backgroundColor = '';
      }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
      if (!event.target.closest('.dropdown')) {
        dropdownList.classList.remove('show');
        jadwalLink.classList.remove('active');
        // Reset icons when closing
        icon.src = 'assets/img/jadwal-icon-white.svg'; 
        arrow.src = 'assets/img/arrow-white.svg';
      }
    });
  }

  // Day dropdown functionality
  const wrapper = document.querySelector('.dropdown-hari-wrapper');
  const selected = document.getElementById('dropdownHariSelected');
  const list = document.getElementById('dropdownHariList');
  const input = document.getElementById('jadwalHari');
  const table = document.getElementById('jadwalTabel');
  const hariText = selected ? selected.querySelector('.dropdown-hari-text') : null;
  const tbody = document.querySelector('#jadwalTabel tbody');

  if (wrapper && selected && list && hariText && tbody) {
    // Initially hide table if no day is selected
    if (hariText.textContent === 'Hari') {
      table.style.display = 'none';
    }

    // Toggle dropdown when clicking on selected area
    selected.addEventListener('click', function(e) {
      e.stopPropagation();
      wrapper.classList.toggle('open');
    });

    // Handle day selection
    list.querySelectorAll('li').forEach(function(item) {
      item.addEventListener('click', function(e) {
        e.stopPropagation();
        
        // Remove selected class from all items
        list.querySelectorAll('li').forEach(li => li.classList.remove('selected'));
        
        // Add selected class to clicked item
        item.classList.add('selected');
        
        // Update dropdown text
        const selectedDay = item.getAttribute('data-value');
        hariText.textContent = selectedDay;
        
        // Update hidden input value
        input.value = selectedDay;
        
        // Show table
        table.style.display = 'table';
        table.classList.remove('hide-table');
        
        // Close dropdown
        wrapper.classList.remove('open');
        
        // Fetch schedule data
        fetchJadwalData(selectedDay);
      });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
      if (!wrapper.contains(e.target)) {
        wrapper.classList.remove('open');
      }
    });
  }

  // Function to fetch schedule data via AJAX
  function fetchJadwalData(hari) {
  // Show loading state
  if (tbody) {
    tbody.innerHTML = '<tr><td colspan="5" class="null-table">Loading...</td></tr>';
  }

  fetch('guru-jadwallengkap.php?hari=' + encodeURIComponent(hari))
    .then(response => {
      console.log("Response status:", response.status); // Debug status
      return response.text();
    })
    .then(html => {
      console.log("HTML Response:", html); // Debug HTML respons
      if (tbody) {
        tbody.innerHTML = html;
      }
    })
    .catch(error => {
      console.error('Error fetching schedule data:', error);
      if (tbody) {
        tbody.innerHTML = '<tr><td colspan="5" class="null-table">Error loading schedule data</td></tr>';
      }
    });
}})

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