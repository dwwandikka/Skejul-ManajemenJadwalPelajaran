  document.querySelectorAll('.type-btn').forEach(button => {
  button.addEventListener('click', function() {
    document.getElementById('typeAcc').value = this.dataset.role;
    document.querySelectorAll('.type-btn').forEach(btn => btn.classList.remove('active'));
    this.classList.add('active');
  });
});