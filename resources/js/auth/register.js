const termsCheck = document.getElementById('terms_check');
const privacyCheck = document.getElementById('privacy_check');
const registerBtn = document.getElementById('register_btn');

function check() {
    if (termsCheck.checked && privacyCheck.checked) {
        registerBtn.disabled = false;
        registerBtn.classList.remove('disabled');
    } else {
        registerBtn.disabled = true;
        registerBtn.classList.add('disabled');
    }
}

termsCheck.addEventListener('change', check);
privacyCheck.addEventListener('change', check);
