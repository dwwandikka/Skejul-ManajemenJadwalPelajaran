document.addEventListener('DOMContentLoaded', function() {
  const jadwalLink = document.querySelector('.jadwal');
  const dropdownList = document.querySelector('.dropdown-list');
  const icon = document.querySelector('.jadwal-icon');
  const arrow = document.querySelector('.arrow-icon');
  const beranda = document.querySelector('.beranda'); 
  const home = document.querySelector('.home-icon');
  const textBeranda = document.querySelector('.text-beranda')

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
        textBeranda.style.color = "#fff"
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
