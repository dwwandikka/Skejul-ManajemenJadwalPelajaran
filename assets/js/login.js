  document.querySelectorAll('.type-btn').forEach(button => {
  button.addEventListener('click', function() {
    document.getElementById('typeAcc').value = this.dataset.role;
    document.querySelectorAll('.type-btn').forEach(btn => btn.classList.remove('active'));
    this.classList.add('active');
  });
});

const passwordInput = document.querySelector('.password-input input');
const toggleIcon = document.querySelector('.password-check img');

  toggleIcon.addEventListener('click', function () {
    const isPassword = passwordInput.type === 'password';

    passwordInput.type = isPassword ? 'text' : 'password';
    toggleIcon.src = isPassword 
      ? 'assets/img/Eye-open.svg' 
      : 'assets/img/Eye-close.svg';
});
