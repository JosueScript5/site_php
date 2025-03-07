document.getElementById('togglePassword').addEventListener('click', function () {
    let passwordInput = document.getElementById('password');
    let icon = this.querySelector('i');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
});

document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
    let confirmPasswordInput = document.getElementById('confirm_password');
    let icon = this.querySelector('i');
    if (confirmPasswordInput.type === 'password') {
        confirmPasswordInput.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        confirmPasswordInput.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
});

// Vérification en temps réel du mot de passe et de la confirmation
document.getElementById('confirm_password').addEventListener('input', function () {
    let password = document.getElementById('password').value;
    let confirmPassword = this.value;
    let errorMessage = document.getElementById('passwordError');
    let submitBtn = document.getElementById('submitBtn');

    if (password !== confirmPassword) {
        errorMessage.textContent = "Les mots de passe ne correspondent pas";
        submitBtn.disabled = true;
    } else {
        errorMessage.textContent = "";
        submitBtn.disabled = false;
    }
});
