// const buttons = document.querySelectorAll('.type-btn');
// const tipeAkunInput = document.getElementById('typeAcc');

// buttons.forEach(button => {
//   button.addEventListener('click', () => {
//     buttons.forEach(btn => btn.classList.remove('active'));
//     button.classList.add('active');
//     tipeAkunInput.value = button.dataset.role;
//   });
// });
document.querySelectorAll('.type-btn').forEach(button => {
  button.addEventListener('click', function() {
    // Update hidden input
    document.getElementById('typeAcc').value = this.dataset.role;

    // Highlight tombol yg aktif
    document.querySelectorAll('.type-btn').forEach(btn => btn.classList.remove('active'));
    this.classList.add('active');
  });
});