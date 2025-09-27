// assets/js/script.js
document.addEventListener('DOMContentLoaded', function () {
  const pwd = document.getElementById('password');
  const eyeIcon = document.getElementById('eyeIcon');
  const toggleBtn = document.querySelector('.toggle-password');

  function togglePassword(e) {
    e && e.preventDefault();
    if (!pwd || !eyeIcon) return;
    if (pwd.type === 'password') {
      pwd.type = 'text';
      eyeIcon.classList.remove('fa-eye-slash');
      eyeIcon.classList.add('fa-eye');
      toggleBtn.setAttribute('aria-label', 'Hide password');
      toggleBtn.title = 'Hide password';
    } else {
      pwd.type = 'password';
      eyeIcon.classList.remove('fa-eye');
      eyeIcon.classList.add('fa-eye-slash');
      toggleBtn.setAttribute('aria-label', 'Show password');
      toggleBtn.title = 'Show password';
    }
  }

  if (toggleBtn) {
    toggleBtn.addEventListener('click', togglePassword);
  }
});
