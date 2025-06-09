document.addEventListener('DOMContentLoaded', function() {
  // Desktop dropdown functionality
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
      
      // Toggle dropdown visibility
      dropdownList.classList.toggle('show');
      jadwalLink.classList.toggle('active');
      
      // Change icons based on active state
      if (jadwalLink.classList.contains('active')) {
        if (icon) icon.src = 'assets/img/jadwal-icon-blue.svg'; 
        if (arrow) arrow.src = 'assets/img/arrow-black.svg'; 
        if (home) home.src = 'assets/img/home-fill.svg';
        if (beranda) beranda.style.backgroundColor = 'transparent';
        if (textBeranda) textBeranda.style.color = "#fff";
      } else {
        if (icon) icon.src = 'assets/img/jadwal-icon-white.svg'; 
        if (arrow) arrow.src = 'assets/img/arrow-white.svg'; 
        if (home) home.src = 'assets/img/home-fill.svg'; // Fixed: was missing .svg extension
        if (beranda) beranda.style.backgroundColor = '';
        if (textBeranda) textBeranda.style.color = "";
      }
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
      if (!event.target.closest('.dropdown')) {
        dropdownList.classList.remove('show');
        jadwalLink.classList.remove('active');
        
        // Reset icons when closing
        if (icon) icon.src = 'assets/img/jadwal-icon-white.svg'; 
        if (arrow) arrow.src = 'assets/img/arrow-white.svg'; 
        if (beranda) beranda.style.backgroundColor = '';
        if (textBeranda) textBeranda.style.color = "";
      }
    });
  } else {
    console.log("Dropdown elements not found!");
  }
});

// Mobile Navigation JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const mobileHamburger = document.getElementById('mobileHamburger');
    let mobileSidebar = document.querySelector('.mobile-sidebar');
    let mobileSidebarOverlay = document.querySelector('.mobile-sidebar-overlay');

    // Create mobile sidebar if it doesn't exist and we're on mobile
    if (!mobileSidebar && window.innerWidth <= 768) {
        createMobileSidebar();
        mobileSidebar = document.querySelector('.mobile-sidebar');
        mobileSidebarOverlay = document.querySelector('.mobile-sidebar-overlay');
    }

    // Mobile hamburger menu toggle
    if (mobileHamburger) {
        mobileHamburger.addEventListener('click', function() {
            if (mobileSidebar) {
                mobileSidebar.classList.toggle('show');
            }
            if (mobileSidebarOverlay) {
                mobileSidebarOverlay.classList.toggle('show');
            }
        });
    }

    // Close sidebar when clicking overlay
    if (mobileSidebarOverlay) {
        mobileSidebarOverlay.addEventListener('click', function() {
            if (mobileSidebar) {
                mobileSidebar.classList.remove('show');
            }
            if (mobileSidebarOverlay) {
                mobileSidebarOverlay.classList.remove('show');
            }
        });
    }

    // Handle mobile dropdown in sidebar
    function setupMobileDropdown() {
        const mobileJadwalLink = mobileSidebar ? mobileSidebar.querySelector('.jadwal') : null;
        const mobileDropdownList = mobileSidebar ? mobileSidebar.querySelector('.dropdown-list') : null;
        
        if (mobileJadwalLink && mobileDropdownList) {
            mobileJadwalLink.addEventListener('click', function(e) {
                e.preventDefault();
                
                this.classList.toggle('active');
                mobileDropdownList.classList.toggle('show');
            });
        }
    }

    // Setup mobile dropdown if sidebar exists
    if (mobileSidebar) {
        setupMobileDropdown();
    }

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            // Hide mobile sidebar on desktop
            if (mobileSidebar) {
                mobileSidebar.classList.remove('show');
            }
            if (mobileSidebarOverlay) {
                mobileSidebarOverlay.classList.remove('show');
            }
        } else if (window.innerWidth <= 768 && !document.querySelector('.mobile-sidebar')) {
            // Create mobile sidebar if it doesn't exist on mobile
            createMobileSidebar();
            mobileSidebar = document.querySelector('.mobile-sidebar');
            mobileSidebarOverlay = document.querySelector('.mobile-sidebar-overlay');
            setupMobileDropdown();
        }
    });
});

// Function to create mobile sidebar dynamically
function createMobileSidebar() {
    // Create overlay
    const overlay = document.createElement('div');
    overlay.className = 'mobile-sidebar-overlay';
    document.body.appendChild(overlay);

    // Get existing sidebar content
    const desktopSidebar = document.querySelector('aside');
    if (!desktopSidebar) return;

    // Create mobile sidebar
    const mobileSidebar = document.createElement('div');
    mobileSidebar.className = 'mobile-sidebar';
    mobileSidebar.innerHTML = desktopSidebar.innerHTML;

    // Insert mobile sidebar
    document.body.appendChild(mobileSidebar);

    // Add event listeners for overlay
    overlay.addEventListener('click', function() {
        mobileSidebar.classList.remove('show');
        overlay.classList.remove('show');
    });
}