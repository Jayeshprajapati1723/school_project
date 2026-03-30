/**
 * Show/Hide Password Toggle Logic
 * Author: JS Coder
 */
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#new_pass');

togglePassword.addEventListener('click', function (e) {
    // Check current type
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    
    // Icon change (Optional: Open/Closed eye)
    this.textContent = type === 'password' ? '👁️' : '🙈';
});
